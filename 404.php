<?php
http_response_code(404);
$page_id      = '404';
$page_title   = 'העמוד לא נמצא | SDmarketing';
$page_desc    = 'העמוד שחיפשתם לא קיים או שהועבר.';
$header_theme = 'dark';
$noindex      = true;
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero not-found" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container not-found-inner">
    <p class="not-found-code" aria-hidden="true" dir="ltr">404</p>
    <h1 id="page-title">העמוד הזה לא קיים. <span>אבל העסק שלך כן.</span></h1>
    <p class="page-lead">ייתכן שהקישור שבור או שהעמוד הועבר. אפשר להמשיך מכאן:</p>
    <ul class="not-found-links">
      <?php foreach ($nav as $id => $item): ?>
        <li><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?><?= icon('arrow') ?></a></li>
      <?php endforeach; ?>
    </ul>
    <div class="hero-actions">
      <a class="btn btn-light btn-lg" href="<?= e(wa_link($site, 'היי, הגעתי לעמוד שלא קיים באתר')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
