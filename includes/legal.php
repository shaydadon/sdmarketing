<?php
// Shared layout for legal pages. Expects $legal = ['title', 'lead', 'sections' => [[id, title, html], ...]].
?>
<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero sm legal">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>">
      <a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= e($legal['title']) ?></b>
    </nav>
    <h1 id="page-title"><?= e($legal['title']) ?></h1>
    <p class="lead"><?= e($legal['lead']) ?></p>
    <p class="legal-meta"><?= tr('עודכן לאחרונה:', 'Last updated:') ?> <?= e($site['legal_updated_display']) ?></p>
  </div>
</section>

<section class="legal">
  <div class="wrap legal-grid">
    <nav class="legal-toc" aria-label="<?= tr('תוכן העניינים', 'Contents') ?>">
      <h2><?= tr('תוכן העניינים', 'Contents') ?></h2>
      <ol>
        <?php foreach ($legal['sections'] as $s): ?>
          <li><a href="#<?= e($s[0]) ?>" data-toc-link="<?= e($s[0]) ?>"><?= e($s[1]) ?></a></li>
        <?php endforeach; ?>
      </ol>
      <div class="legal-other">
        <?php foreach (['terms' => tr('תקנון ותנאי שימוש', 'Terms of use'), 'privacy' => tr('מדיניות פרטיות', 'Privacy policy'), 'accessibility' => tr('הצהרת נגישות', 'Accessibility statement')] as $k => $label): ?>
          <?php if ($k !== $page_id): ?><a href="<?= e(lurl($k)) ?>"><?= e($label) ?><?= icon('arrow') ?></a><?php endif; ?>
        <?php endforeach; ?>
      </div>
    </nav>

    <article class="legal-body">
      <?php foreach ($legal['sections'] as $i => $s): ?>
        <section id="<?= e($s[0]) ?>" class="legal-section" data-toc-section>
          <h2><span class="legal-n"><?= $i + 1 ?>.</span><?= e($s[1]) ?></h2>
          <?= $s[2] ?>
        </section>
      <?php endforeach; ?>

      <aside class="legal-contact">
        <h2><?= tr('שאלות? כתבו לי.', 'Questions? Get in touch.') ?></h2>
        <p><?= tr('על כל שאלה בנוגע למסמך הזה אפשר לפנות אליי ישירות.', 'If you have any questions about this document, feel free to contact me directly.') ?></p>
        <div class="legal-contact-links">
          <a class="btn btn-ink" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('וואטסאפ', 'WhatsApp') ?></span></a>
          <a class="btn btn-ghost" href="mailto:<?= e($site['email']) ?>"><?= icon('mail') ?><span dir="ltr"><?= e($site['email']) ?></span></a>
        </div>
      </aside>
    </article>
  </div>
</section>
