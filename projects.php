<?php
$page_id      = 'projects';
$page_title   = 'פרויקטים | SDmarketing | חנויות, אתרים ואפליקציות שעלו לאוויר';
$page_desc    = 'עבודות של SDmarketing: חנויות אונליין, אתרים ואפליקציות PWA שעלו לאוויר, ביניהן fisha.shop, Excerly ו־Boardog.';
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/projects-data.php';
require __DIR__ . '/includes/device.php';
?>

<!-- ============ PAGE HERO ============ -->
<section class="page-hero" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container">
    <nav class="breadcrumbs" aria-label="מיקום בעמוד">
      <a href="index.php">בית</a><span aria-hidden="true">/</span><span aria-current="page">פרויקטים</span>
    </nav>
    <h1 id="page-title">לא מצגות. <span>דברים שעובדים באוויר.</span></h1>
    <p class="page-lead">חנויות, אתרים ואפליקציות שבניתי ושלקוחות משתמשים בהם עכשיו. כל מסך גולל את הפרויקט מלמעלה עד למטה: במחשב כשמעבירים עליו את העכבר, בטלפון מעצמו.</p>
  </div>
</section>

<!-- ============ SHOWCASE ============ -->
<section class="section showcase" aria-labelledby="showcase-title">
  <div class="container">
    <h2 id="showcase-title" class="sr-only">רשימת הפרויקטים</h2>

    <div class="filters" role="group" aria-label="סינון לפי סוג" data-filters>
      <?php foreach ($project_cats as $key => $label):
        $count = $key === 'all' ? count($projects) : count(array_filter($projects, fn($p) => $p['cat'] === $key)); ?>
        <button type="button" class="filter" data-filter="<?= $key ?>" aria-pressed="<?= $key === 'all' ? 'true' : 'false' ?>">
          <?= e($label) ?><span class="filter-count"><?= $count ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="showcase-list" data-showcase>
      <?php
      // Sites get a full-width row each; the PWAs sit side by side as a pair (breaks the zigzag rhythm).
      $render_case = function (array $p, string $extra = '') { ?>
        <article class="case case--<?= $p['device'] ?> <?= $extra ?>" data-cat="<?= $p['cat'] ?>" aria-labelledby="case-<?= $p['slug'] ?>">
          <div class="case-stage">
            <?php device_frame($p); ?>
            <p class="case-hint">
              <?php if (!project_screenshot($p['slug'])): ?><span>הדמיית מסך</span><?php endif; ?>
              <span class="hover-note"><?= icon('arrow', 'icon icon-down') ?>עברו עם העכבר כדי לגלול</span>
            </p>
          </div>

          <div class="case-info">
            <span class="proj-type"><?= e($p['type']) ?></span>
            <h3 id="case-<?= $p['slug'] ?>" dir="ltr" lang="en"><?= e($p['name']) ?></h3>
            <p class="case-long"><?= e($p['long']) ?></p>

            <h4>מה נבנה</h4>
            <ul class="check-list">
              <?php foreach ($p['built'] as $b): ?><li><?= icon('check') ?><?= e($b) ?></li><?php endforeach; ?>
            </ul>

            <ul class="tags" aria-label="טכנולוגיות">
              <?php foreach ($p['tags'] as $t): ?><li dir="ltr"><?= e($t) ?></li><?php endforeach; ?>
            </ul>

            <?php if ($p['url']): ?>
              <a class="btn btn-primary" href="<?= e($p['url']) ?>" target="_blank" rel="noopener"><span>לאתר החי</span><?= icon('external') ?></a>
            <?php endif; ?>
          </div>
        </article>
      <?php };

      $sites = array_filter($projects, fn($p) => $p['device'] !== 'phone');
      $apps  = array_filter($projects, fn($p) => $p['device'] === 'phone');
      foreach ($sites as $p) $render_case($p);
      if ($apps): ?>
        <div class="case-pair" data-group>
          <?php foreach ($apps as $p) $render_case($p, 'case--stacked'); ?>
        </div>
      <?php endif; ?>

      <!-- Closing slot: the next project -->
      <article class="case case--next" data-cat="all">
        <div class="next-slot">
          <div class="next-frame" aria-hidden="true"><?= logo_mark('next-mark') ?></div>
          <div>
            <h3>הפרויקט הבא יכול להיות שלך.</h3>
            <p>חנות, אתר, אפליקציה או בוט? ספרו לי מה אתם צריכים ואחזור עם הצעה.</p>
          </div>
          <a class="btn btn-primary" href="<?= e(wa_link($site, 'היי, ראיתי את הפרויקטים באתר ויש לי פרויקט חדש')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        </div>
      </article>
    </div>
  </div>
</section>

<?php
$cta_title = 'רוצים שהעסק שלכם יופיע כאן?';
$cta_text  = 'כל פרויקט כאן התחיל בהודעה אחת. שלחו כמה מילים על מה שאתם צריכים, ונמשיך משם.';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
