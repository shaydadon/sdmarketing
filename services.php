<?php
$page_id      = 'services';
$page_title   = 'שירותים | SDmarketing | אוטומציות, אתרים, אפליקציות PWA ושיווק דיגיטלי';
$page_desc    = 'צ\'אטבוטים לוואטסאפ, אוטומציות מייל ושיווק, דפי נחיתה, אתרי תדמית וחנויות אונליין, אפליקציות PWA וניהול ואופטימיזציה של קמפיינים.';
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/service-visual.php';
?>

<!-- ============ PAGE HERO ============ -->
<section class="page-hero" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container">
    <nav class="breadcrumbs" aria-label="מיקום בעמוד">
      <a href="index.php">בית</a><span aria-hidden="true">/</span><span aria-current="page">שירותים</span>
    </nav>
    <h1 id="page-title">כל מה שהעסק צריך כדי למכור אונליין. <span>ולעבוד פחות.</span></h1>
    <p class="page-lead">ארבעה תחומים שנבנים כך שיתחברו זה לזה: הקמפיין מביא את הלקוח, האתר משכנע אותו, הבוט עונה לו והאוטומציה דואגת שאף אחד לא ייפול בין הכיסאות.</p>
  </div>
</section>

<!-- ============ SERVICE JUMP NAV (sticky) ============ -->
<nav class="svc-jump" aria-label="מעבר בין שירותים" data-jump>
  <div class="container">
    <ul>
      <?php foreach ($services as $s): ?>
        <li><a href="#<?= $s['id'] ?>" data-jump-link="<?= $s['id'] ?>"><?= icon($s['icon']) ?><span><?= e($s['title']) ?></span></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>

<!-- ============ SERVICES ============ -->
<?php foreach ($services as $i => $s): ?>
<section class="svc-block<?= $i % 2 ? ' svc-block--alt' : '' ?>" id="<?= $s['id'] ?>" aria-labelledby="<?= $s['id'] ?>-title" data-jump-section>
  <div class="container svc-block-grid">
    <div class="svc-block-main">
      <h2 id="<?= $s['id'] ?>-title"><span class="svc-block-ico"><?= icon($s['icon']) ?></span><?= e($s['title']) ?></h2>
      <p class="svc-block-headline"><?= e($s['headline']) ?></p>
      <p class="svc-block-intro"><?= e($s['intro']) ?></p>

      <ul class="feature-list">
        <?php foreach ($s['features'] as $f): ?>
          <li>
            <span class="feature-ico"><?= icon($f['icon']) ?></span>
            <div><h3><?= e($f['title']) ?></h3><p><?= e($f['text']) ?></p></div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <aside class="svc-block-side">
      <div class="svc-visual svc-visual--tall" aria-hidden="true"><?php service_visual($s['id']); ?></div>
      <div class="svc-cases">
        <h3>דוגמאות למה שאפשר לבנות</h3>
        <ul class="chips">
          <?php foreach ($s['cases'] as $c): ?><li><?= e($c) ?></li><?php endforeach; ?>
        </ul>
        <a class="btn btn-primary" href="<?= e(wa_link($site, $s['wa_text'])) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
      </div>
    </aside>
  </div>
</section>
<?php endforeach; ?>

<!-- ============ TOGETHER ============ -->
<section class="section together" aria-labelledby="together-title">
  <div class="container">
    <div class="section-head section-head--light">
      <h2 id="together-title">הכוח האמיתי: כשהכל מחובר.</h2>
      <p>ככה נראית דרכו של לקוח אחד כשכל השירותים בנויים על ידי אותו אדם: בלי פערים בין ספקים, ובלי מידע שהולך לאיבוד בדרך.</p>
    </div>

    <ol class="journey">
      <li class="journey-step">
        <span class="journey-ico"><?= icon('chart') ?></span>
        <h3>רואה מודעה</h3>
        <p>קמפיין ממוקד בפייסבוק או בגוגל.</p>
        <small>שיווק דיגיטלי</small>
      </li>
      <li class="journey-step">
        <span class="journey-ico"><?= icon('browser') ?></span>
        <h3>נוחת בעמוד</h3>
        <p>דף נחיתה מהיר עם מסר אחד ברור.</p>
        <small>פיתוח אתרים</small>
      </li>
      <li class="journey-step">
        <span class="journey-ico"><?= icon('whatsapp') ?></span>
        <h3>שולח הודעה</h3>
        <p>הבוט עונה מיד, שואל ומסנן.</p>
        <small>צ'אטבוט לוואטסאפ</small>
      </li>
      <li class="journey-step">
        <span class="journey-ico"><?= icon('database') ?></span>
        <h3>נשמר ומטופל</h3>
        <p>הליד נכנס ל־CRM ומקבל מייל המשך.</p>
        <small>אוטומציות</small>
      </li>
      <li class="journey-step">
        <span class="journey-ico"><?= icon('phone') ?></span>
        <h3>חוזר שוב</h3>
        <p>מתקין את האפליקציה ומקבל עדכונים.</p>
        <small>אפליקציית PWA</small>
      </li>
    </ol>
  </div>
</section>

<?php
$cta_title = 'לא בטוחים מאיפה להתחיל?';
$cta_text  = 'ספרו לי בכמה מילים מה העסק עושה ואיפה הולך לכם הכי הרבה זמן. אציע את הצעד הראשון שהכי משתלם לבנות.';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
