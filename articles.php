<?php
$page_id    = 'articles';
$page_title = 'מאמרים | SDmarketing | שיווק דיגיטלי, אתרים ואוטומציות לעסקים';
$page_desc  = 'מאמרים של SDmarketing על צ׳אטבוט לוואטסאפ לעסקים, אוטומציות, בניית אתרים וקמפיינים. בקרוב.';
$noindex    = true;
require __DIR__ . '/includes/header.php';
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm">
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <b>מאמרים</b></nav>
    <h1 id="page-title">מאמרים בקרוב.</h1>
    <p class="lead">כאן יעלו מדריכים קצרים על צ׳אטבוט לוואטסאפ לעסקים, אוטומציות לעסקים, בניית אתרים ודפי נחיתה, וקמפיינים בגוגל ובמטא.</p>
    <div class="ctas">
      <a class="btn btn-acc" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
      <a class="btn btn-ghost-d" href="services.php">לשירותים<?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
