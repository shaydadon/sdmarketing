<?php
$page_id    = 'articles';
$page_title = 'מאמרים ומדריכים | SDmarketing | צ׳אטבוט לוואטסאפ, אוטומציות, אתרים וקמפיינים';
$page_desc  = 'מדריכים ומאמרים קצרים לבעלי עסקים: צ׳אטבוט לוואטסאפ, איך לא לאבד לידים, אוטומציות לעסקים, אפליקציית PWA, דף נחיתה ומעקב המרות.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/articles-data.php';
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm">
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <b>מאמרים</b></nav>
    <h1 id="page-title">מאמרים ומדריכים.<span>קצר, מעשי, בלי מילים מיותרות.</span></h1>
    <p class="lead">איך לא לאבד פניות, מה לעשות עם הוואטסאפ, מתי אפליקציה שווה את זה, ואיך יודעים מה באמת עובד בפרסום. כל מאמר נקרא בכמה דקות.</p>
  </div>
</section>

<section class="posts" aria-labelledby="page-title">
  <div class="wrap">
    <ul class="post-grid">
      <?php foreach ($articles as $i => $a): ?>
        <li class="post-card rv">
          <a href="article.php?slug=<?= e($a['slug']) ?>">
            <img class="pc-img" src="<?= e($a['image']) ?>" alt="<?= e($a['image_alt']) ?>" width="1200" height="630" <?= $i < 3 ? 'fetchpriority="high"' : 'loading="lazy"' ?> decoding="async">
            <span class="pc-top"><span class="pc-type"><?= e($a['type']) ?></span><span class="pc-min"><?= (int) $a['minutes'] ?> דקות קריאה</span></span>
            <h2><?= e($a['title']) ?></h2>
            <p><?= e($a['description']) ?></p>
            <span class="pc-go">לקריאה<?= icon('arrow') ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
$cta_title = "יש לכם שאלה\nשלא מופיעה כאן?";
$cta_text  = 'שלחו הודעה קצרה על העסק. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
