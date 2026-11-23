# SDmarketing

The website of SDmarketing ([sdmarketing.co.il](https://sdmarketing.co.il)): automations and WhatsApp chatbots, websites and online stores, PWA apps, and digital marketing for businesses. Hebrew, right-to-left.

Plain PHP + CSS + JS, no build step. Runs on any PHP 8 host (Hostinger) or locally with XAMPP.

## Run locally

```bash
php -S localhost:8765
```

Then open http://localhost:8765.

## Structure

| Path | What |
| --- | --- |
| `index.php`, `services.php`, `projects.php`, `about.php`, `contact.php` | Main pages |
| `terms.php`, `privacy.php`, `accessibility.php`, `404.php` | Legal pages and the not-found page |
| `includes/config.php` | Contact details, WhatsApp number, legal business details |
| `includes/services-data.php`, `includes/projects-data.php` | Service and project content |
| `includes/header.php`, `includes/footer.php`, `includes/cta.php` | Shared layout |
| `assets/` | CSS, JS, images. Project screenshots go in `assets/img/projects/<slug>.jpg` |
| `e2e/` | Playwright tests (not part of the deployed site) |

## Tests

```bash
cd e2e
npm install
npx playwright install chromium
npm test
```

## Deploys (GitHub Actions)

[.github/workflows/deploy.yml](.github/workflows/deploy.yml): every push runs the Playwright tests and, only if they pass, uploads the site over SSH (rsync):

| Branch | Goes to |
| --- | --- |
| `development` | https://dev.sdmarketing.co.il (hidden from search engines, "סביבת פיתוח" badge, contact emails tagged `[DEV]`) |
| `main` | https://sdmarketing.co.il (live) |

A manual run (Actions > Deploy to Hostinger > Run workflow) can pick dev or live; live only from `main`.

Repository secrets: `SSH_HOST`, `SSH_USER`, `SSH_PORT`, `SSH_KEY`, `DEV_PATH`, `LIVE_PATH`. Missing secrets skip the deploy with a warning.

## Manual deploy (production, without Actions)

Upload everything except `e2e/`, `README.md`, `PRODUCT.md` and `skills-lock.json` to `public_html` on Hostinger. Then:

1. Fill in the business type, business ID and city in `includes/config.php` (shown on the legal pages).
2. Turn on SSL in Hostinger and uncomment the HTTPS rule in `.htaccess`.
3. Send one test message through the contact form.
