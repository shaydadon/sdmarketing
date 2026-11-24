<?php
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/articles-data.php';
require __DIR__ . '/includes/articles-meta.php';

$slug    = (string) ($_GET['slug'] ?? '');
$article = $articles_by_slug[$slug] ?? null;
if (!$article) {
    require __DIR__ . '/404.php';
    return;
}

$page_id        = 'articles';
$translated     = false;   // Hebrew only
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
        'inLanguage' => 'he',
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
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'בית', 'item' => 'https://' . $site['domain'] . '/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'מאמרים', 'item' => 'https://' . $site['domain'] . '/articles'],
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
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="<?= url('') ?>">בית</a> / <a href="<?= url('articles') ?>">מאמרים</a> / <b><?= e($article['type']) ?></b></nav>
    <h1 id="page-title"><?= e($article['title']) ?></h1>
    <div class="byline">
      <span class="by-photo"><img src="<?= e(url($author['photo'])) ?>" alt="" width="1024" height="1024" decoding="async"></span>
      <div>
        <a class="by-name" href="<?= e(url($author['url'])) ?>"><?= e($author['name']) ?></a>
        <span class="by-role"><?= e($author['role']) ?></span>
        <span class="by-meta"><time datetime="<?= e($article['published']) ?>">פורסם ב-<?= e(he_date($article['published'])) ?></time><?php if ($article['updated'] !== $article['published']): ?> · <time datetime="<?= e($article['updated']) ?>">עודכן ב-<?= e(he_date($article['updated'])) ?></time><?php endif; ?> · <?= (int) $article['minutes'] ?> דקות קריאה</span>
      </div>
    </div>
  </div>
</section>

<article class="post" aria-labelledby="page-title">
  <div class="wrap post-wrap">
    <figure class="post-cover"><img src="<?= e(url($article['image'])) ?>" alt="<?= e($article['image_alt']) ?>" width="1200" height="630" fetchpriority="high" decoding="async"></figure>
    <div class="post-body">
      <?= str_replace('{BASE}', $base, $article['html']) ?>
    </div>

    <?php if ($article['faq']): ?>
      <section class="faq post-faq" aria-labelledby="post-faq-title">
        <h2 id="post-faq-title">שאלות נפוצות</h2>
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

    <aside class="author-box" aria-label="על הכותב">
      <img src="<?= e(url($author['photo'])) ?>" alt="<?= e($author['name']) ?>" width="1024" height="1024" loading="lazy" decoding="async">
      <div>
        <p class="ab-k">על הכותב</p>
        <p class="ab-n"><?= e($author['name']) ?>, מייסד SDmarketing</p>
        <p class="ab-b"><?= e($author['bio']) ?></p>
        <a class="link" href="<?= e(url($author['url'])) ?>">עוד על שי <?= icon('arrow') ?></a>
      </div>
    </aside>

    <aside class="post-cta" aria-label="יצירת קשר">
      <p><?= str_replace('{BASE}', $base, $article['cta_html']) ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, 'היי שי, קראתי את המאמר "' . $article['title'] . '" ואשמח לדבר')) ?>" target="_blank" rel="noopener"><span>בואו נדבר על העסק שלכם</span><?= icon('arrow') ?></a>
    </aside>

    <nav class="post-next" aria-label="מאמרים נוספים">
      <h2>עוד מאמרים</h2>
      <ul>
        <?php foreach ($related as $r): ?>
          <li><a href="<?= e(url('articles/' . $r['slug'])) ?>"><span class="pc-type"><?= e($r['type']) ?></span><b><?= e($r['title']) ?></b><?= icon('arrow') ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="link" href="<?= url('articles') ?>">לכל המאמרים <?= icon('arrow') ?></a>
    </nav>
  </div>
</article>
<?php foreach ($ld as $block): ?>
<script type="application/ld+json"><?= json_encode($block, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
