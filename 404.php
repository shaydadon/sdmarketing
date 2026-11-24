<?php
http_response_code(404);
// Missing addresses under /en/ get the English page.
$lang         = preg_match('#^/(?:dev/)?en(/|$)#', parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/') ? 'en' : 'he';
require_once __DIR__ . '/includes/config.php';
$page_id      = '404';
$page_title   = tr('העמוד לא נמצא | SDmarketing', 'Page not found | SDmarketing');
$page_desc    = tr('העמוד שחיפשתם לא קיים או שהועבר.', 'The page you were looking for doesn’t exist or has moved.');
$translated   = false;
$noindex      = true;
require __DIR__ . '/includes/header.php';
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap p-hero sm not-found">
    <p class="not-found-code" aria-hidden="true" dir="ltr">404</p>
    <h1 id="page-title"><?= tr('העמוד הזה לא קיים. <span>אבל העסק שלך כן.</span>', 'This page doesn’t exist. <span>Your business does.</span>') ?></h1>
    <p class="lead"><?= tr('ייתכן שהקישור שבור או שהעמוד הועבר. אפשר להמשיך מכאן:', 'The link may be broken, or the page has moved. You can carry on from here:') ?></p>
    <ul class="not-found-links">
      <li><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?><?= icon('arrow') ?></a></li>
      <?php foreach ($nav as $item): ?>
        <li><a href="<?= e(lurl($item['href'])) ?>"><?= e($item['label']) ?><?= icon('arrow') ?></a></li>
      <?php endforeach; ?>
    </ul>
    <div class="ctas">
      <a class="btn btn-acc" href="<?= e(wa_link($site, tr('היי, הגעתי לעמוד שלא קיים באתר', 'Hi, I landed on a page that doesn’t exist on your website'))) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
