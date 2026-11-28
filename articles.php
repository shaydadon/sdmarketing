<?php
$page_id    = 'articles';
require_once __DIR__ . '/includes/config.php';
$page_title = tr('מאמרים ומדריכים לבעלי עסקים | SDmarketing', 'Articles and Guides for Small Business Owners | SDmarketing');
$page_desc  = tr('מדריכים ומאמרים לבעלי עסקים: קידום אתרים, צ׳אטבוט לוואטסאפ, איך לא לאבד לידים, אוטומציות לעסקים, אפליקציית PWA, דף נחיתה ומעקב המרות.', 'Practical guides for small business owners on getting found on Google and turning visitors into customers, from the developer who builds these systems.');
require __DIR__ . '/includes/header.php';
require __DIR__ . ($is_en ? '/includes/en/articles-data.php' : '/includes/articles-data.php');
require __DIR__ . '/includes/articles-meta.php';
usort($articles, fn($a, $b) => strcmp($b['published'], $a['published']));   // newest first (stable: same-day articles keep their order)
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= tr('מאמרים', 'Articles') ?></b></nav>
    <h1 id="page-title"><?= tr('מאמרים ומדריכים.<span>קצר, מעשי, בלי מילים מיותרות.</span>', 'Articles and guides.<span>Practical, and based on real work.</span>') ?></h1>
    <p class="lead"><?= tr('איך מופיעים בגוגל, איך לא לאבד פניות, מה לעשות עם הוואטסאפ, מתי אפליקציה שווה את זה, ואיך יודעים מה באמת עובד בפרסום.', 'Getting found on Google, replying to every lead, automating the busywork, apps without an app store, and knowing which ads actually work.') ?></p>
    <?php if (count($articles) > 3): ?>
    <div class="filters" role="group" aria-label="<?= tr('סינון לפי נושא', 'Filter by topic') ?>" data-filters>
      <?php foreach ($article_topics as $key => $label):
        $count = $key === 'all' ? count($articles) : count(array_filter($articles, fn($a) => $a['topic'] === $key));
        if (!$count) continue; ?>
        <button type="button" class="chip<?= $key === 'all' ? ' on' : '' ?>" data-filter="<?= e($key) ?>" aria-pressed="<?= $key === 'all' ? 'true' : 'false' ?>"><?= e($label) ?> <i><?= $count ?></i></button>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="posts" aria-labelledby="page-title">
  <div class="wrap">
    <ul class="post-grid" data-showcase>
      <?php foreach ($articles as $i => $a): ?>
        <li class="post-card rv" data-cat="<?= e($a['topic']) ?>">
          <a href="<?= e(lurl('articles/' . $a['slug'])) ?>">
            <img class="pc-img" src="<?= e(url($a['image'])) ?>" alt="<?= e($a['image_alt']) ?>" width="1200" height="630" <?= $i < 3 ? 'fetchpriority="high"' : 'loading="lazy"' ?> decoding="async">
            <span class="pc-top"><span class="pc-type"><?= e($a['type']) ?></span><span class="pc-min"><?= (int) $a['minutes'] ?> <?= tr('דקות קריאה', 'min read') ?></span></span>
            <h2><?= e($a['title']) ?></h2>
            <p><?= e($a['description']) ?></p>
            <span class="pc-go"><?= tr('לקריאה', 'Read') ?><?= icon('arrow') ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
$cta_title = tr("יש לכם שאלה\nשלא מופיעה כאן?", "Have a question\nthat isn’t covered here?");
$cta_text  = tr('שלחו לי אותה בוואטסאפ, ואולי היא תהיה המאמר הבא.', 'Send it to me on WhatsApp. It might become the next article.');
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
