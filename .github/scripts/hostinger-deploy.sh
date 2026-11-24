#!/usr/bin/env bash
# Upload the site to Hostinger through the Hostinger API (no SSH needed).
#
#   HOSTINGER_API_TOKEN=... HOSTINGER_USER=u654862842 .github/scripts/hostinger-deploy.sh <domain> <dev|live>
#
# Uploads every tracked site file, overwriting what is there. Nothing on the server is deleted,
# so live keeps its dev/ folder and anything else that is not in the repo.
# Then clears the Hostinger cache and purges the CDN so the new files show up at once.
set -uo pipefail

DOMAIN=$1
TARGET=$2
API=https://developers.hostinger.com/api/hosting/v1
AUTH=(-H "Authorization: Bearer ${HOSTINGER_API_TOKEN}")
: "${HOSTINGER_USER:?HOSTINGER_USER is not set}"

# Only the site's own files are sent. Tooling, tests and notes stay in the repo.
git ls-files \
  | grep -vE '^(e2e/|content/|\.github/|\.claude/|\.well-known/|dev/|README\.md$|PRODUCT\.md$|skills-lock\.json$|\.gitignore$|\.gitattributes$|robots\.txt$)' \
  > /tmp/deploy-files.txt
if [ "$TARGET" = "dev" ]; then
  printf 'User-agent: *\nDisallow: /\n' > robots.txt   # keep search engines off dev
  echo robots.txt >> /tmp/deploy-files.txt
fi
echo "Uploading $(wc -l < /tmp/deploy-files.txt) files to $DOMAIN"

creds=$(curl -sS --fail-with-body --retry 3 -X POST "$API/files/upload-urls" "${AUTH[@]}" \
  -H 'Content-Type: application/json' \
  -d "{\"username\":\"$HOSTINGER_USER\",\"domain\":\"$DOMAIN\"}") \
  || { echo "::error::Could not get an upload URL from Hostinger: $creds"; exit 1; }
URL=$(jq -r .url <<<"$creds")
AK=$(jq -r .auth_key <<<"$creds")
RK=$(jq -r .rest_auth_key <<<"$creds")
TUS=(-H "X-Auth: $AK" -H "X-Auth-Rest: $RK" -H "Tus-Resumable: 1.0.0")

upload() {
  local f=$1 size c1 c2
  size=$(stat -c%s "$f")
  c1=$(curl -sS -o /dev/null -w '%{http_code}' -X POST "$URL/$f?override=true" "${TUS[@]}" \
       -H "Upload-Length: $size" -H "Upload-Offset: 0")
  c2=$(curl -sS -o /dev/null -w '%{http_code}' -X PATCH "$URL/$f?override=true" "${TUS[@]}" \
       -H "Content-Type: application/offset+octet-stream" -H "Upload-Offset: 0" --data-binary "@$f")
  echo "$c1 $c2 $f"
  [ "$c1" = 201 ] && [ "$c2" = 204 ]
}

failed=0
while read -r f; do
  upload "$f" || { sleep 3; upload "$f"; } || { echo "::error::Upload failed: $f"; failed=1; }
done < /tmp/deploy-files.txt
[ "$failed" = 0 ] || exit 1

curl -sS -X DELETE "$API/accounts/$HOSTINGER_USER/websites/$DOMAIN/cache/clear" "${AUTH[@]}" || true
echo
curl -sS -X DELETE "$API/accounts/$HOSTINGER_USER/websites/$DOMAIN/cdn/purge" "${AUTH[@]}" || true
echo
echo "Uploaded to $DOMAIN"
