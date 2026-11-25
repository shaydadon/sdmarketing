<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . ($is_en ? '/includes/en/articles-data.php' : '/includes/articles-data.php');
require __DIR__ . '/includes/articles-meta.php';

$slug    = (string) ($_GET['slug'] ?? '');
$article = $articles_by_slug[$slug] ?? null;
if (!$article) {
    require __DIR__ . '/404.php';
    return;
}

$page_id        = 'articles';
$translated     = $article['translated'];   // true when the other language has an article with the same slug
$page_title     = $article['meta_title'] . ' | SDmarketing';
$page_desc      = $article['description'];
$canonical_path = 'articles/' . rawurlencode($article['slug']);
$og_type        = 'article';
$og_image       = $article['image'];
require __DIR__ . '/includes/header.php';

$url = 'https://' . $site['domain'] . '/' . $canonical_path;
$ld  = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $article['title'],
        'description' => $article['description'],
        'inLanguage' => $is_en ? 'en' : 'he',
        'mainEntityOfPage' => $url,
        'author' => ['@type' => 'Person', 'name' => $author['name'], 'jobTitle' => $author['job_title'], 'url' => 'https://' . $site['domain'] . '/' . $author['url'], 'image' => 'https://' . $site['domain'] . '/' . $author['photo']],
        'datePublished' => $article['published'],
        'dateModified' => $article['updated'],
        'publisher' => ['@type' => 'Organization', 'name' => 'SDmarketing', 'url' => 'https://' . $site['domain'] . '/'],
        'keywords' => $article['keyword'],
        'image' => 'https://' . $site['domain'] . '/' . $article['image'],
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => tr('בית', 'Home'), 'item' => 'https://' . $site['domain'] . '/' . tr('', 'en/')],
            ['@type' => 'ListItem', 'position' => 2, 'name' => tr('מאמרים', 'Articles'), 'item' => 'https://' . $site['domain'] . '/' . tr('articles', 'en/articles')],
            ['@type' => 'ListItem', 'position' => 3, 'name' => $article['title'], 'item' => $url],
        ],
    ],
];
if ($article['faq']) {
    $ld[] = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn($f) => [
            '@type' => 'Question',
            'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a_text']],
        ], $article['faq']),
    ];
}
$others = array_values(array_filter($articles, fn($a) => $a['slug'] !== $article['slug']));
$i      = array_search($article['slug'], array_column($articles, 'slug'), true);
$related = [];
foreach ([0, 1] as $k) {
    if (count($others) > $k) {
        $related[] = $others[($i + $k) % count($others)];
    }
}
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm post-hero">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <a href="<?= lurl('articles') ?>"><?= tr('מאמרים', 'Articles') ?></a> / <b><?= e($article['type']) ?></b></nav>
    <h1 id="page-title"><?= e($article['title']) ?></h1>
    <div class="byline">
      <span class="by-photo"><img src="<?= e(url($author['photo'])) ?>" alt="" width="1024" height="1024" decoding="async"></span>
      <div>
        <a class="by-name" href="<?= e(url($author['url'])) ?>"><?= e($author['name']) ?></a>
        <span class="by-role"><?= e($author['role']) ?></span>
        <span class="by-meta"><time datetime="<?= e($article['published']) ?>"><?= tr('פורסם ב-', 'Published ') ?><?= e(article_date($article['published'])) ?></time><?php if ($article['updated'] !== $article['published']): ?> · <time datetime="<?= e($article['updated']) ?>"><?= tr('עודכן ב-', 'Updated ') ?><?= e(article_date($article['updated'])) ?></time><?php endif; ?> · <?= (int) $article['minutes'] ?> <?= tr('דקות קריאה', 'min read') ?></span>
      </div>
    </div>
  </div>
</section>

<article class="post" aria-labelledby="page-title">
  <div class="wrap post-wrap">
    <figure class="post-cover"><img src="<?= e(url($article['image'])) ?>" alt="<?= e($article['image_alt']) ?>" width="1200" height="630" fetchpriority="high" decoding="async"></figure>
    <?php if (count($article['toc'] ?? []) >= 3): ?>
      <nav class="post-toc" aria-labelledby="post-toc-title">
        <h2 id="post-toc-title"><?= tr('במאמר', 'In this article') ?></h2>
        <ul>
          <?php foreach ($article['toc'] as $t): ?>
            <li><a href="#<?= e($t['id']) ?>"><?= e($t['text']) ?></a></li>
          <?php endforeach; ?>
          <?php if ($article['faq']): ?><li><a href="#post-faq-title"><?= tr('שאלות נפוצות', 'FAQ') ?></a></li><?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
    <div class="post-body">
      <?= str_replace('{BASE}', $base, $article['html']) ?>
    </div>

    <?php if ($article['faq']): ?>
      <section class="faq post-faq" aria-labelledby="post-faq-title">
        <h2 id="post-faq-title"><?= tr('שאלות נפוצות', 'Frequently asked questions') ?></h2>
        <div class="faq-list">
          <?php foreach ($article['faq'] as $n => $f): ?>
            <details>
              <summary id="pf-q-<?= $n ?>"><span><?= e($f['q']) ?></span></summary>
              <div class="faq-a" role="region" aria-labelledby="pf-q-<?= $n ?>"><p><?= str_replace('{BASE}', $base, $f['a_html']) ?></p></div>
            </details>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <aside class="author-box" aria-label="<?= tr('על הכותב', 'About the author') ?>">
      <img src="<?= e(url($author['photo'])) ?>" alt="<?= e($author['name']) ?>" width="1024" height="1024" loading="lazy" decoding="async">
      <div>
        <p class="ab-k"><?= tr('על הכותב', 'About the author') ?></p>
        <p class="ab-n"><?= e($author['name']) ?>, <?= tr('מייסד SDmarketing', 'founder of SDmarketing') ?></p>
        <p class="ab-b"><?= e($author['bio']) ?></p>
        <a class="link" href="<?= e(url($author['url'])) ?>"><?= tr('עוד על שי', 'More about Shay') ?> <?= icon('arrow') ?></a>
      </div>
    </aside>

    <aside class="post-cta" aria-label="<?= tr('יצירת קשר', 'Contact') ?>">
      <p><?= str_replace('{BASE}', $base, $article['cta_html']) ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, tr('היי שי, קראתי את המאמר "' . $article['title'] . '" ואשמח לדבר', 'Hi Shay, I read your article "' . $article['title'] . '" and would like to talk'))) ?>" target="_blank" rel="noopener"><span><?= tr('בואו נדבר על העסק שלכם', 'Let’s talk about your business') ?></span><?= icon('arrow') ?></a>
    </aside>

    <?php if ($related): ?>
    <nav class="post-next" aria-label="<?= tr('מאמרים נוספים', 'More articles') ?>">
      <h2><?= tr('עוד מאמרים', 'More articles') ?></h2>
      <ul>
        <?php foreach ($related as $r): ?>
          <li><a href="<?= e(lurl('articles/' . $r['slug'])) ?>"><span class="pc-type"><?= e($r['type']) ?></span><b><?= e($r['title']) ?></b><?= icon('arrow') ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="link" href="<?= lurl('articles') ?>"><?= tr('לכל המאמרים', 'All articles') ?> <?= icon('arrow') ?></a>
    </nav>
    <?php endif; ?>
  </div>
</article>
<?php foreach ($ld as $block): ?>
<script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
