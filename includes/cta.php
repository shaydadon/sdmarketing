<?php
// Closing call-to-action. Optional before include: $cta_title, $cta_text, $cta_contacts.
$cta_title    = $cta_title ?? tr("מה אפשר להפוך\nלאוטומטי אצלכם?", "What could your business\nrun on autopilot?");
$cta_text     = $cta_text  ?? tr('ספרו לי בהודעה קצרה מה העסק עושה ומה הייתם רוצים לשפר.', 'Tell me in a short message what your business does and what you’d like to improve.');
$cta_contacts = $cta_contacts ?? false;
?>
<section class="cta" aria-labelledby="cta-title">
  <div class="ring" aria-hidden="true"></div>
  <div class="wrap" style="position:relative">
    <span class="eyebrow"><?= tr('בואו נכיר', 'Let’s talk') ?></span>
    <h2 class="big" id="cta-title"><?= nl2br(e($cta_title)) ?></h2>
    <p><?= e($cta_text) ?></p>
    <div class="ctas">
      <a class="btn btn-ink" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
      <a class="btn btn-ghost" href="<?= lurl('contact') ?>"><?= tr('לטופס יצירת קשר', 'Fill out the contact form') ?></a>
    </div>
    <?php if ($cta_contacts): ?>
      <div class="contact-list">
        <a href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>"><span><?= e($site['phone_display']) ?> <small>TEL</small></span></a>
        <a href="mailto:<?= e($site['email']) ?>"><span><?= e($site['email']) ?> <small>MAIL</small></span></a>
      </div>
    <?php endif; ?>
  </div>
</section>
