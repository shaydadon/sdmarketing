<?php
// Closing call-to-action. Optional before include: $cta_title, $cta_text, $cta_contacts.
$cta_title    = $cta_title ?? "מה אפשר להפוך\nלאוטומטי אצלך?";
$cta_text     = $cta_text  ?? 'שלחו הודעה קצרה על העסק. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.';
$cta_contacts = $cta_contacts ?? false;
?>
<section class="cta" aria-labelledby="cta-title">
  <div class="ring" aria-hidden="true"></div>
  <div class="wrap" style="position:relative">
    <span class="eyebrow">בואו נכיר</span>
    <h2 class="big" id="cta-title"><?= nl2br(e($cta_title)) ?></h2>
    <p><?= e($cta_text) ?></p>
    <div class="ctas">
      <a class="btn btn-ink" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
      <a class="btn btn-ghost" href="<?= url('contact') ?>">לטופס יצירת קשר</a>
    </div>
    <?php if ($cta_contacts): ?>
      <div class="contact-list">
        <a href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>"><span><?= e($site['phone']) ?> <small>TEL</small></span></a>
        <a href="mailto:<?= e($site['email']) ?>"><span><?= e($site['email']) ?> <small>MAIL</small></span></a>
      </div>
    <?php endif; ?>
  </div>
</section>
