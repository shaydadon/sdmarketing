<?php
$page_id    = 'services';
$page_title = 'שירותים | SDmarketing | אוטומציות, אתרים, אפליקציות PWA ושיווק דיגיטלי';
$page_desc  = 'צ\'אטבוטים לוואטסאפ, אוטומציות מייל ושיווק, דפי נחיתה, אתרי תדמית וחנויות אונליין, אפליקציות PWA וניהול ואופטימיזציה של קמפיינים.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/service-visual.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero sm">
    <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <b>שירותים</b></nav>
    <h1 id="page-title">כל מה שהעסק צריך כדי למכור אונליין.<span>ולעבוד פחות.</span></h1>
    <p class="lead" style="max-width:720px;margin-top:28px">ארבעה תחומים שנבנים כך שיתחברו זה לזה: הקמפיין מביא את הלקוח, האתר משכנע אותו, הבוט עונה לו והאוטומציה דואגת שאף אחד לא ייפול בין הכיסאות.</p>
    <nav class="subnav" aria-label="מעבר בין שירותים" data-jump>
      <?php foreach ($services as $i => $s): ?>
        <a class="chip<?= $i === 0 ? ' on' : '' ?>" href="#<?= e($s['id']) ?>" data-jump-link="<?= e($s['id']) ?>"><?= sprintf('%02d', $i + 1) ?> · <?= e($s['title']) ?></a>
      <?php endforeach; ?>
    </nav>
  </div>
</section>

<?php foreach ($services as $i => $s):
  $alt = $i % 2 === 1;
  $last = $i === count($services) - 1;
?>
<section class="svc-block<?= $alt ? ' alt' : '' ?><?= $last ? ' is-last' : '' ?>" id="<?= e($s['id']) ?>" data-jump-section aria-labelledby="<?= e($s['id']) ?>-title">
  <div class="wrap split">
    <?php if ($alt) service_visual($s['id']); ?>
    <div>
      <span class="eyebrow"><?= sprintf('%02d', $i + 1) ?> · <?= e($s['title']) ?></span>
      <h2 id="<?= e($s['id']) ?>-title"><?= e($s['title']) ?></h2>
      <div class="tagline"><?= e($s['headline']) ?> <span><?= e($s['headline_accent']) ?></span></div>
      <p class="intro"><?= e($s['intro']) ?></p>
      <div class="feat-grid">
        <?php foreach ($s['features'] as $f): ?>
          <div class="feat"><h3><?= e($f['title']) ?></h3><p><?= e($f['text']) ?></p></div>
        <?php endforeach; ?>
      </div>
      <div class="examples"><b>דוגמאות:</b><?php foreach ($s['cases'] as $c): ?><span class="ex-chip"><?= e($c) ?></span><?php endforeach; ?></div>
    </div>
    <?php if (!$alt) service_visual($s['id']); ?>
  </div>
</section>
<?php endforeach; ?>

<section class="journey dark" aria-labelledby="journey-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">איך זה מתחבר</span>
        <h2 class="sec" id="journey-title">הכוח האמיתי:<br><span class="acc">כשהכל מחובר.</span></h2>
      </div>
      <p class="lead">ככה נראית דרכו של לקוח אחד כשכל השירותים בנויים על ידי אותו אדם: בלי פערים בין ספקים, ובלי מידע שהולך לאיבוד בדרך.</p>
    </div>
    <div class="jsteps">
      <div class="jstep"><span class="k">01</span><h3>רואה מודעה</h3><p>קמפיין ממוקד בפייסבוק או בגוגל.</p><span class="s">שיווק דיגיטלי</span></div>
      <div class="jstep"><span class="k">02</span><h3>נוחת בעמוד</h3><p>דף נחיתה מהיר עם מסר אחד ברור.</p><span class="s">פיתוח אתרים</span></div>
      <div class="jstep"><span class="k">03</span><h3>שולח הודעה</h3><p>הבוט עונה מיד, שואל ומסנן.</p><span class="s">צ'אטבוט לוואטסאפ</span></div>
      <div class="jstep"><span class="k">04</span><h3>נשמר ומטופל</h3><p>הליד נכנס ל־CRM ומקבל מייל המשך.</p><span class="s">אוטומציות</span></div>
      <div class="jstep"><span class="k">05</span><h3>חוזר שוב</h3><p>מתקין את האפליקציה ומקבל עדכונים.</p><span class="s">אפליקציית PWA</span></div>
    </div>
  </div>
</section>

<?php
$cta_title = "לא בטוחים\nמאיפה להתחיל?";
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
