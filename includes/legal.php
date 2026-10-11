<?php
// Shared layout for legal pages. Expects $legal = ['title', 'lead', 'sections' => [[id, title, html], ...]].
?>
<section class="page-hero page-hero--short page-hero--legal" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container">
    <nav class="breadcrumbs" aria-label="מיקום בעמוד">
      <a href="index.php">בית</a><span aria-hidden="true">/</span><span aria-current="page"><?= e($legal['title']) ?></span>
    </nav>
    <h1 id="page-title"><?= e($legal['title']) ?></h1>
    <p class="page-lead"><?= e($legal['lead']) ?></p>
    <p class="legal-meta">עודכן לאחרונה: <?= e($site['legal_updated']) ?></p>
  </div>
</section>

<section class="section legal">
  <div class="container legal-grid">
    <nav class="legal-toc" aria-label="תוכן העניינים">
      <h2>תוכן העניינים</h2>
      <ol>
        <?php foreach ($legal['sections'] as $s): ?>
          <li><a href="#<?= e($s[0]) ?>" data-toc-link="<?= e($s[0]) ?>"><?= e($s[1]) ?></a></li>
        <?php endforeach; ?>
      </ol>
      <div class="legal-other">
        <?php foreach (['terms' => 'תקנון ותנאי שימוש', 'privacy' => 'מדיניות פרטיות', 'accessibility' => 'הצהרת נגישות'] as $k => $label): ?>
          <?php if ($k !== $page_id): ?><a href="<?= $k ?>.php"><?= e($label) ?><?= icon('arrow') ?></a><?php endif; ?>
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
        <h2>שאלות? כתבו לי.</h2>
        <p>על כל שאלה בנוגע למסמך הזה אפשר לפנות אליי ישירות.</p>
        <div class="legal-contact-links">
          <a class="btn btn-primary" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>וואטסאפ</span></a>
          <a class="btn btn-outline" href="mailto:<?= e($site['email']) ?>"><?= icon('mail') ?><span dir="ltr"><?= e($site['email']) ?></span></a>
        </div>
      </aside>
    </article>
  </div>
</section>
