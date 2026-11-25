#!/usr/bin/env python3
"""Turn content/articles/NN-*.md into includes/articles-data.php.

Run from the repo root:  python3 content/build-articles.py
Only the Markdown the articles use is supported: ## headings, paragraphs, **bold**,
[links](url), "- " and "1. " lists, | tables |, a "## שאלות נפוצות" block of
**question?** / answer pairs, and a closing call to action after the last "---".
Links to another article's slug (e.g. "whatsapp-chatbot") become /articles/<slug>.

English articles live in content/articles/en/NN-*.md and build into includes/en/articles-data.php
(FAQ heading "Frequently asked questions", links go to /en/...). An English article with the same
slug as a Hebrew one is its translation: both get hreflang alternates and the language switcher links them.
"""
import glob, html, json, os, re

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
SRC = os.path.join(ROOT, 'content', 'articles')
OUT = os.path.join(ROOT, 'includes', 'articles-data.php')
LANGS = {
    'he': {'src': SRC, 'out': OUT, 'faq': 'שאלות נפוצות', 'wpm': 170, 'prefix': '', 'img': 'assets/img/articles/'},
    'en': {'src': os.path.join(SRC, 'en'), 'out': os.path.join(ROOT, 'includes', 'en', 'articles-data.php'),
           'faq': 'Frequently asked questions', 'wpm': 230, 'prefix': 'en/', 'img': 'assets/img/articles/en/'},
}


def inline(text, slugs, prefix=''):
    out = html.escape(text, quote=False)

    def link(m):
        label, url = m.group(1), m.group(2)
        # Internal links become clean, root-relative URLs. {BASE} is replaced with the site root at render time.
        if url in slugs:
            url = '{BASE}' + prefix + 'articles/' + url
        elif not url.startswith(('http', '#', 'mailto:', 'tel:')):
            url = '{BASE}' + prefix + re.sub(r'^index\.php', '', re.sub(r'\.php(?=#|$)', '', url))
        ext = url.startswith('http')
        attrs = ' target="_blank" rel="noopener"' if ext else ''
        return f'<a href="{html.escape(url)}"{attrs}>{label}</a>'

    out = re.sub(r'\[([^\]]+)\]\(([^)\s]+)\)', link, out)
    out = re.sub(r'\*\*(.+?)\*\*', r'<strong>\1</strong>', out)
    return out


def blocks_to_html(lines, slugs, toc=None, prefix=''):
    """Render body lines (no front matter, no H1, no FAQ, no CTA) to HTML.
    Each ## heading gets an id (part-1, part-2, ...) and, when toc is a list, is appended to it."""
    out, i = [], 0
    while i < len(lines):
        line = lines[i].rstrip()
        if not line.strip():
            i += 1
            continue
        if line.startswith('## '):
            text = line[3:].strip()
            hid = f'part-{len(toc) + 1}' if toc is not None else ''
            if toc is not None:
                toc.append({'id': hid, 'text': re.sub(r'\*\*|\[([^\]]+)\]\([^)]+\)', r'\1', text)})
            out.append(f'<h2 id="{hid}">{inline(text, slugs, prefix)}</h2>' if hid else f'<h2>{inline(text, slugs, prefix)}</h2>')
            i += 1
        elif line.startswith('|'):
            rows = []
            while i < len(lines) and lines[i].startswith('|'):
                cells = [c.strip() for c in lines[i].strip().strip('|').split('|')]
                if not all(re.fullmatch(r':?-{2,}:?', c) for c in cells):
                    rows.append(cells)
                i += 1
            head, *body = rows
            t = ['<div class="post-table"><table><thead><tr>'] + [f'<th scope="col">{inline(c, slugs, prefix)}</th>' for c in head] + ['</tr></thead><tbody>']
            for r in body:
                t.append('<tr>' + ''.join((f'<th scope="row">{inline(c, slugs, prefix)}</th>' if j == 0 else f'<td>{inline(c, slugs, prefix)}</td>') for j, c in enumerate(r)) + '</tr>')
            t.append('</tbody></table></div>')
            out.append(''.join(t))
        elif re.match(r'^- ', line) or re.match(r'^\d+\. ', line):
            ordered = bool(re.match(r'^\d+\. ', line))
            items = []
            while i < len(lines) and (re.match(r'^\d+\. ', lines[i]) if ordered else lines[i].startswith('- ')):
                items.append(re.sub(r'^(\d+\. |- )', '', lines[i].rstrip()))
                i += 1
            tag = 'ol' if ordered else 'ul'
            out.append(f'<{tag}>' + ''.join(f'<li>{inline(x, slugs, prefix)}</li>' for x in items) + f'</{tag}>')
        else:
            para = []
            while i < len(lines) and lines[i].strip() and not lines[i].startswith(('## ', '|', '- ')) and not re.match(r'^\d+\. ', lines[i]):
                para.append(lines[i].strip())
                i += 1
            out.append(f'<p>{inline(" ".join(para), slugs, prefix)}</p>')
    return '\n'.join(out)


def front_matter(fm):
    meta = {}
    for line in fm.strip().split('\n'):
        if ':' in line:
            k, v = line.split(':', 1)
            meta[k.strip()] = v.strip()
    return meta


def parse(path, slugs, cfg, other_slugs):
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
    if f'## {cfg["faq"]}' in lines:
        k = lines.index(f'## {cfg["faq"]}')
        faq_lines = [l for l in lines[k + 1:] if l.strip()]
        lines = lines[:k]
        for j in range(0, len(faq_lines) - 1, 2):
            q = faq_lines[j].strip().strip('*').strip()
            a = faq_lines[j + 1].strip()
            faq.append({'q': q, 'a_html': inline(a, slugs, cfg['prefix']), 'a_text': re.sub(r'\[([^\]]+)\]\([^)]+\)', r'\1', a).replace('**', '')})
    words = len(re.findall(r'\S+', body))
    toc = []
    return {
        'slug': meta['slug'],
        'title': h1,
        'meta_title': meta['title'],
        'description': meta['meta_description'],
        'keyword': meta['primary_keyword'],
        'type': meta.get('type', ''),
        'service': re.sub(r'\.php(?=#|$)', '', meta.get('service_link', '')),
        'topic': meta.get('topic', ''),
        'published': meta.get('published', ''),
        'updated': meta.get('updated', meta.get('published', '')),
        'image': f"{cfg['img']}{meta['slug']}.webp",
        'image_alt': meta.get('image_alt', ''),
        'minutes': max(2, round(words / cfg['wpm'])),   # reading speed differs by language
        'html': blocks_to_html(lines, slugs, toc, cfg['prefix']),
        'toc': toc,
        'faq': faq,
        'cta_html': inline(cta, slugs, cfg['prefix']),
        'translated': meta['slug'] in other_slugs,
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


def article_files(src):
    return sorted(f for f in glob.glob(os.path.join(src, '[0-9][0-9]-*.md')) if not os.path.basename(f).startswith('00-'))


def write_data(out, arts):
    with open(out, 'w', encoding='utf-8') as fh:
        fh.write('<?php\n// Generated by content/build-articles.py from content/articles/*.md. Do not edit by hand.\n')
        fh.write('$articles = ' + php_val(arts, 0) + ';\n')
        fh.write('$articles_by_slug = array_column($articles, null, \'slug\');\n')
    print(f'wrote {out}: {len(arts)} articles: ' + ', '.join(a["slug"] for a in arts))


def main():
    files = {l: article_files(c['src']) for l, c in LANGS.items()}
    slug_sets = {l: {front_matter(open(f, encoding='utf-8').read().split('---', 2)[1])['slug'] for f in fs} for l, fs in files.items()}
    all_arts = {}
    for l, c in LANGS.items():
        other = slug_sets['en' if l == 'he' else 'he']
        all_arts[l] = [parse(f, slug_sets[l], c, other) for f in files[l]]
        write_data(c['out'], all_arts[l])
    arts = all_arts['he']
    # sitemap.xml: the site's pages plus every article, clean URLs, with last-modified dates
    import datetime
    today = datetime.date.today().isoformat()
    site = 'https://sdmarketing.co.il/'
    pages = ['', 'services', 'projects', 'articles', 'about', 'contact', 'terms', 'privacy', 'accessibility']
    # Pages that also exist in English under /en/ (en/<page>.php). Each pair lists both languages as alternates.
    english = [p for p in pages if os.path.exists(os.path.join(ROOT, 'en', (p or 'index') + '.php'))]
    newest = max((a['updated'] or a['published'] or today) for a in arts)
    entries = [(site + p, newest if p == 'articles' else today, p in english and p) for p in pages]
    entries += [(site + 'en/' + p, today, p) for p in english]
    entries += [(f'{site}articles/{a["slug"]}', a['updated'] or a['published'] or today, a['translated'] and f'articles/{a["slug"]}') for a in arts]
    entries += [(f'{site}en/articles/{a["slug"]}', a['updated'] or a['published'] or today, a['translated'] and f'articles/{a["slug"]}') for a in all_arts['en']]
    with open(os.path.join(ROOT, 'sitemap.xml'), 'w', encoding='utf-8') as fh:
        fh.write('<?xml version="1.0" encoding="UTF-8"?>\n<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">\n')
        for u, mod, pair in entries:
            alt = ''
            if pair is not False:
                alt = ''.join(f'<xhtml:link rel="alternate" hreflang="{l}" href="{html.escape(h)}"/>'
                              for l, h in (('he', site + pair), ('en', site + 'en/' + pair), ('x-default', site + pair)))
            fh.write(f'  <url><loc>{html.escape(u)}</loc><lastmod>{mod}</lastmod>{alt}</url>\n')
        fh.write('</urlset>\n')
    print(f'wrote sitemap.xml: {len(entries)} urls')


if __name__ == '__main__':
    main()
