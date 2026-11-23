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

    <?php if ($p['slug'] === 'excerly'): ?>
      <div class="stage stage-ex-nice">
        <?php foreach ([
          ['assets/img/projects/excerly/home-m.webp', 'מסך היום באפליקציית Excerly'],
          ['assets/img/projects/excerly/workouts-m.webp', 'מסך האימונים באפליקציית Excerly'],
          ['assets/img/projects/excerly/session-m.webp', 'מסך אימון באפליקציית Excerly'],
          ['assets/img/projects/excerly/nutrition-m.webp', 'מסך התזונה באפליקציית Excerly'],
        ] as $i => $shot): ?>
          <div class="mphone"><img src="<?= e($shot[0]) ?>" alt="<?= e($shot[1]) ?>" width="780" height="1688" loading="lazy" decoding="async"></div>
        <?php endforeach; ?>
      </div>
    <?php elseif ($p['slug'] === 'fisha'): ?>
      <div class="stage stage-fisha">
        <div class="browser main">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img class="tall" src="assets/img/projects/fisha/originals-main.webp" alt="עמוד Originals בחנות fisha.shop" width="1600" height="1133" loading="lazy" decoding="async">
        </div>
        <div class="side">
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/tattoos-1.webp" alt="עמוד הקעקועים של fisha.shop" width="1600" height="1000" loading="lazy" decoding="async"></div>
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/tattoos-2.webp" alt="Flash sheet בחנות fisha.shop" width="1600" height="1000" loading="lazy" decoding="async"></div>
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/shop-hq-c.webp" alt="עמוד החנות של fisha.shop" width="1600" height="929" loading="lazy" decoding="async"></div>
        </div>
      </div>
      <div class="tat-strip">
        <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/tattoos-3.webp" alt="עמוד קעקועים נוסף בחנות fisha.shop" width="1600" height="1000" loading="lazy" decoding="async"></div>
        <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/tattoos-4.webp" alt="עמוד קעקועים נוסף בחנות fisha.shop" width="1600" height="1000" loading="lazy" decoding="async"></div>
        <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="assets/img/projects/fisha/collectibles-dc.webp" alt="עמוד Collectibles בחנות fisha.shop" width="1440" height="836" loading="lazy" decoding="async"></div>
      </div>
    <?php else: $shot = $p['shots'][0]; ?>
      <div class="stage stage-one">
        <div class="browser">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img src="<?= e($shot['src']) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async">
        </div>
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
