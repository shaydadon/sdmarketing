<?php
// Closing call-to-action band. Optional: $cta_title, $cta_text before including.
$cta_title = $cta_title ?? 'מה אפשר להפוך לאוטומטי אצלך?';
$cta_text  = $cta_text  ?? 'שלחו הודעה קצרה על העסק. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.';
?>
<section class="cta" aria-labelledby="cta-title">
  <div class="container cta-inner">
    <div>
      <h2 id="cta-title"><?= e($cta_title) ?></h2>
      <p><?= e($cta_text) ?></p>
    </div>
    <div class="cta-actions">
      <a class="btn btn-light btn-lg" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
      <a class="btn btn-ghost btn-lg" href="contact.php"><span>לטופס יצירת קשר</span><?= icon('arrow') ?></a>
    </div>
  </div>
</section>
