<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/articles-data.php';

$slug    = (string) ($_GET['slug'] ?? '');
$article = $articles_by_slug[$slug] ?? null;
if (!$article) {
    require __DIR__ . '/404.php';
    return;
}

$page_id        = 'articles';
$page_title     = $article['meta_title'] . ' | SDmarketing';
$page_desc      = $article['description'];
$canonical_path = 'article.php?slug=' . rawurlencode($article['slug']);
$og_type        = 'article';
require __DIR__ . '/includes/header.php';

$url = 'https://' . $site['domain'] . '/' . $canonical_path;
$ld  = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $article['title'],
        'description' => $article['description'],
        'inLanguage' => 'he',
        'mainEntityOfPage' => $url,
        'author' => ['@type' => 'Person', 'name' => 'שי דדון', 'url' => 'https://' . $site['domain'] . '/about.php'],
        'publisher' => ['@type' => 'Organization', 'name' => 'SDmarketing', 'url' => 'https://' . $site['domain'] . '/'],
        'keywords' => $article['keyword'],
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'בית', 'item' => 'https://' . $site['domain'] . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'מאמרים', 'item' => 'https://' . $site['domain'] . '/articles.php'],
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
$related = [$others[$i % count($others)], $others[($i + 1) % count($others)]];
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm post-hero">
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <a href="articles.php">מאמרים</a> / <b><?= e($article['type']) ?></b></nav>
    <h1 id="page-title"><?= e($article['title']) ?></h1>
    <p class="post-meta"><span>שי דדון</span><span><?= (int) $article['minutes'] ?> דקות קריאה</span></p>
  </div>
</section>

<article class="post" aria-labelledby="page-title">
  <div class="wrap post-wrap">
    <div class="post-body">
      <?= $article['html'] ?>
    </div>

    <?php if ($article['faq']): ?>
      <section class="faq post-faq" aria-labelledby="post-faq-title">
        <h2 id="post-faq-title">שאלות נפוצות</h2>
        <div class="faq-list">
          <?php foreach ($article['faq'] as $n => $f): ?>
            <details>
              <summary id="pf-q-<?= $n ?>"><span><?= e($f['q']) ?></span></summary>
              <div class="faq-a" role="region" aria-labelledby="pf-q-<?= $n ?>"><p><?= $f['a_html'] ?></p></div>
            </details>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <aside class="post-cta" aria-label="יצירת קשר">
      <p><?= $article['cta_html'] ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, 'היי שי, קראתי את המאמר "' . $article['title'] . '" ואשמח לדבר')) ?>" target="_blank" rel="noopener"><span>בואו נדבר על העסק שלכם</span><?= icon('arrow') ?></a>
    </aside>

    <nav class="post-next" aria-label="מאמרים נוספים">
      <h2>עוד מאמרים</h2>
      <ul>
        <?php foreach ($related as $r): ?>
          <li><a href="article.php?slug=<?= e($r['slug']) ?>"><span class="pc-type"><?= e($r['type']) ?></span><b><?= e($r['title']) ?></b><?= icon('arrow') ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="link" href="articles.php">לכל המאמרים <?= icon('arrow') ?></a>
    </nav>
  </div>
</article>
<?php foreach ($ld as $block): ?>
<script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
