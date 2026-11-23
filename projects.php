<?php
$page_id    = 'projects';
$page_title = 'פרויקטים | SDmarketing | חנויות, אתרים ואפליקציות שעלו לאוויר';
$page_desc  = 'עבודות של SDmarketing: חנות אונליין ואפליקציית PWA, עם צילומי מסך אמיתיים.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/projects-data.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero">
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <b>פרויקטים</b></nav>
    <div class="row">
      <h1 id="page-title">לא מצגות.<span>דברים שעובדים באוויר.</span></h1>
    </div>
    <div class="row" style="align-items:center;margin-top:36px">
      <p class="lead" style="margin:0;max-width:560px">חנויות, אתרים ואפליקציות שבניתי ושלקוחות משתמשים בהם עכשיו. אפשר להיכנס ולנסות בעצמכם.</p>
      <div class="filters" role="group" aria-label="סינון לפי סוג" data-filters>
        <?php foreach ($project_cats as $key => $label):
          $count = $key === 'all' ? count($projects) : count(array_filter($projects, fn($p) => $p['cat'] === $key)); ?>
          <button type="button" class="chip<?= $key === 'all' ? ' on' : '' ?>" data-filter="<?= e($key) ?>" aria-pressed="<?= $key === 'all' ? 'true' : 'false' ?>">
            <?= e($label) ?> <i><?= $count ?></i>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<div data-showcase>
<?php foreach ($projects as $i => $p): ?>
<section class="case" id="case-<?= e($p['slug']) ?>" data-cat="<?= e($p['cat']) ?>" aria-labelledby="case-title-<?= e($p['slug']) ?>">
  <div class="wrap">
    <div class="case-head">
      <div>
        <div class="case-idx"><b><?= sprintf('%02d', $i + 1) ?></b> / <?= sprintf('%02d', count($projects)) ?></div>
        <h2 id="case-title-<?= e($p['slug']) ?>" lang="en"><?= e($p['name']) ?></h2>
        <div class="tags"><span class="tag acc"><?= e($p['tag']) ?></span></div>
      </div>
      <div>
        <p class="desc"><?= e($p['summary']) ?></p>
        <div class="acts">
          <a class="btn btn-ink" href="<?= e($p['url']) ?>" target="_blank" rel="noopener"><?= e($p['url_label']) ?><?= icon('external') ?></a>
        </div>
      </div>
    </div>

    <?php if ($p['layout'] === 'phones'): ?>
      <div class="stage stage-ex compact">
        <?php foreach ($p['shots'] as $shot): ?>
          <div class="mphone"><img src="<?= e($shot['src']) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async"></div>
        <?php endforeach; ?>
        <p class="stage-cap">צילום מסך אמיתי</p>
      </div>
    <?php else:
      $shot = $p['shots'][0];
      if ($p['slug'] === 'fisha') {
        $shot = ['src' => 'assets/img/projects/fisha/tattoos-1.webp', 'alt' => 'צילום מסך של החנות fisha.shop', 'w' => 1600, 'h' => 1000, 'chrome' => 'fisha.shop'];
      }
    ?>
      <div class="stage stage-one<?= $p['slug'] === 'fisha' ? ' stage-fisha-slim' : '' ?>">
        <div class="browser">
          <div class="bar"><i></i><i></i><i></i><u><?= e($shot['chrome'] ?? $p['name']) ?></u></div>
          <img src="<?= e($shot['src']) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async">
        </div>
        <p class="stage-cap">צילום מסך אמיתי</p>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php endforeach; ?>
<?php require __DIR__ . '/includes/wa-demo.php'; ?>
</div>

<p class="soon wrap"><?= e($projects_soon) ?></p>

<section class="next" style="padding-top:0">
  <div class="wrap">
    <div class="box">
      <div>
        <h2>הפרויקט הבא<br><span>יכול להיות שלך.</span></h2>
        <p>חנות, אתר, אפליקציה או בוט? כל פרויקט כאן התחיל בהודעה אחת. ספרו לי מה אתם צריכים ואחזור עם הצעה.</p>
      </div>
      <div class="ctas">
        <a class="btn btn-acc" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        <a class="btn btn-ghost-d" href="contact.php">לטופס יצירת קשר</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
