#!/usr/bin/env python3
"""Turn content/articles/NN-*.md into includes/articles-data.php.

Run from the repo root:  python3 content/build-articles.py
Only the Markdown the articles use is supported: ## headings, paragraphs, **bold**,
[links](url), "- " and "1. " lists, | tables |, a "## שאלות נפוצות" block of
**question?** / answer pairs, and a closing call to action after the last "---".
Links to another article's slug (e.g. "whatsapp-chatbot") become article.php?slug=...
"""
import glob, html, json, os, re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SRC = os.path.join(ROOT, 'content', 'articles')
OUT = os.path.join(ROOT, 'includes', 'articles-data.php')
FAQ_HEADING = 'שאלות נפוצות'


def inline(text, slugs):
    out = html.escape(text, quote=False)

    def link(m):
        label, url = m.group(1), m.group(2)
        if url in slugs:
            url = 'article.php?slug=' + url
        ext = url.startswith('http')
        attrs = ' target="_blank" rel="noopener"' if ext else ''
        return f'<a href="{html.escape(url)}"{attrs}>{label}</a>'

    out = re.sub(r'\[([^\]]+)\]\(([^)\s]+)\)', link, out)
    out = re.sub(r'\*\*(.+?)\*\*', r'<strong>\1</strong>', out)
    return out


def blocks_to_html(lines, slugs):
    """Render body lines (no front matter, no H1, no FAQ, no CTA) to HTML."""
    out, i = [], 0
    while i < len(lines):
        line = lines[i].rstrip()
        if not line.strip():
            i += 1
            continue
        if line.startswith('## '):
            text = line[3:].strip()
            out.append(f'<h2>{inline(text, slugs)}</h2>')
            i += 1
        elif line.startswith('|'):
            rows = []
            while i < len(lines) and lines[i].startswith('|'):
                cells = [c.strip() for c in lines[i].strip().strip('|').split('|')]
                if not all(re.fullmatch(r':?-{2,}:?', c) for c in cells):
                    rows.append(cells)
                i += 1
            head, *body = rows
            t = ['<div class="post-table"><table><thead><tr>'] + [f'<th scope="col">{inline(c, slugs)}</th>' for c in head] + ['</tr></thead><tbody>']
            for r in body:
                t.append('<tr>' + ''.join((f'<th scope="row">{inline(c, slugs)}</th>' if j == 0 else f'<td>{inline(c, slugs)}</td>') for j, c in enumerate(r)) + '</tr>')
            t.append('</tbody></table></div>')
            out.append(''.join(t))
        elif re.match(r'^- ', line) or re.match(r'^\d+\. ', line):
            ordered = bool(re.match(r'^\d+\. ', line))
            items = []
            while i < len(lines) and (re.match(r'^\d+\. ', lines[i]) if ordered else lines[i].startswith('- ')):
                items.append(re.sub(r'^(\d+\. |- )', '', lines[i].rstrip()))
                i += 1
            tag = 'ol' if ordered else 'ul'
            out.append(f'<{tag}>' + ''.join(f'<li>{inline(x, slugs)}</li>' for x in items) + f'</{tag}>')
        else:
            para = []
            while i < len(lines) and lines[i].strip() and not lines[i].startswith(('## ', '|', '- ')) and not re.match(r'^\d+\. ', lines[i]):
                para.append(lines[i].strip())
                i += 1
            out.append(f'<p>{inline(" ".join(para), slugs)}</p>')
    return '\n'.join(out)


def front_matter(fm):
    meta = {}
    for line in fm.strip().split('\n'):
        if ':' in line:
            k, v = line.split(':', 1)
            meta[k.strip()] = v.strip()
    return meta


def parse(path, slugs):
    raw = open(path, encoding='utf-8').read()
    _, fm, body = raw.split('---', 2)
    meta = front_matter(fm)
    lines = body.strip('\n').split('\n')
    h1 = next(l[2:].strip() for l in lines if l.startswith('# '))
    lines = [l for l in lines if not l.startswith('# ')]
    # closing call to action: everything after the last '---' line
    cta = ''
    if '---' in [l.strip() for l in lines]:
        last = max(k for k, l in enumerate(lines) if l.strip() == '---')
        cta = ' '.join(l.strip() for l in lines[last + 1:] if l.strip())
        lines = lines[:last]
    # FAQ block
    faq = []
    if f'## {FAQ_HEADING}' in lines:
        k = lines.index(f'## {FAQ_HEADING}')
        faq_lines = [l for l in lines[k + 1:] if l.strip()]
        lines = lines[:k]
        for j in range(0, len(faq_lines) - 1, 2):
            q = faq_lines[j].strip().strip('*').strip()
            a = faq_lines[j + 1].strip()
            faq.append({'q': q, 'a_html': inline(a, slugs), 'a_text': re.sub(r'\[([^\]]+)\]\([^)]+\)', r'\1', a).replace('**', '')})
    words = len(re.findall(r'\S+', body))
    return {
        'slug': meta['slug'],
        'title': h1,
        'meta_title': meta['title'],
        'description': meta['meta_description'],
        'keyword': meta['primary_keyword'],
        'type': meta.get('type', ''),
        'service': meta.get('service_link', ''),
        'minutes': max(2, round(words / 170)),
        'html': blocks_to_html(lines, slugs),
        'faq': faq,
        'cta_html': inline(cta, slugs),
    }


def php_str(s):
    return "'" + s.replace('\\', '\\\\').replace("'", "\\'") + "'"


def php_val(v, ind=1):
    pad = '    ' * ind
    if isinstance(v, str):
        return php_str(v)
    if isinstance(v, int):
        return str(v)
    if isinstance(v, list):
        return '[\n' + ''.join(f'{pad}    {php_val(x, ind + 1)},\n' for x in v) + f'{pad}]'
    if isinstance(v, dict):
        return '[\n' + ''.join(f'{pad}    {php_str(k)} => {php_val(x, ind + 1)},\n' for k, x in v.items()) + f'{pad}]'
    raise TypeError(type(v))


def main():
    files = sorted(f for f in glob.glob(os.path.join(SRC, '[0-9][0-9]-*.md')) if not os.path.basename(f).startswith('00-'))
    slugs = {front_matter(open(f, encoding='utf-8').read().split('---', 2)[1])['slug'] for f in files}
    arts = [parse(f, slugs) for f in files]
    with open(OUT, 'w', encoding='utf-8') as fh:
        fh.write('<?php\n// Generated by content/build-articles.py from content/articles/*.md. Do not edit by hand.\n')
        fh.write('$articles = ' + php_val(arts, 0) + ';\n')
        fh.write('$articles_by_slug = array_column($articles, null, \'slug\');\n')
    print(f'wrote {OUT}: {len(arts)} articles: ' + ', '.join(a["slug"] for a in arts))


if __name__ == '__main__':
    main()
