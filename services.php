<?php
require_once __DIR__ . '/includes/config.php';
$page_id    = 'services';
$page_title = tr('שירותי אוטומציות, אתרים, SEO וקמפיינים | SDmarketing', 'Services: Automation, Web Development, SEO & PPC | SDmarketing');
$page_desc  = tr('צ׳אטבוט לוואטסאפ ואוטומציות לעסקים, בניית אתרים, חנויות ודפי נחיתה, אפליקציות PWA, קידום אורגני וקמפיינים בגוגל ובמטא. מה כל שירות כולל ואיך מתחילים.', 'WhatsApp chatbots, business automation, websites and landing pages, PWA apps, SEO, and Google Ads and Meta ads management. See what each service includes.');
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/service-visual.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero sm">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= tr('שירותים', 'Services') ?></b></nav>
    <h1 id="page-title"><?= tr('כל מה שהעסק צריך כדי למכור אונליין.<span>ולעבוד פחות.</span>', 'Everything your business needs to sell more online.<span>While you work less.</span>') ?></h1>
    <p class="lead" style="max-width:720px;margin-top:28px"><?= tr('חמישה תחומים שנבנים כך שיתחברו זה לזה: חיפוש אורגני או קמפיין ממומן מביאים את הלקוח, האתר משכנע אותו, הבוט עונה לו והאוטומציה דואגת שאף אחד לא ייפול בין הכיסאות.', 'Five services designed to work together: SEO or a paid campaign brings customers in, your website wins them over, a chatbot answers instantly, and automation makes sure no one slips through the cracks.') ?></p>
  </div>
</section>

<section class="svc-overview" aria-label="<?= tr('סיכום השירותים', 'Services at a glance') ?>">
  <div class="wrap">
    <nav class="svo-grid" aria-label="<?= tr('מעבר בין שירותים', 'Jump to a service') ?>" data-jump>
      <?php foreach ($services as $i => $s): ?>
        <a class="svo" href="#<?= e($s['id']) ?>" data-jump-link="<?= e($s['id']) ?>">
          <span class="svo-ic"><?= icon($s['icon']) ?></span>
          <span class="svo-t"><?= e($s['title']) ?></span>
          <span class="svo-d"><?= e($s['lead']) ?></span>
          <span class="svo-f"><small><?= tr('מתאים ל', 'Good for') ?></small><?= e($s['fit']) ?></span>
          <span class="svo-go"><?= tr('לפרטים', 'Details') ?><?= icon('arrow') ?></span>
        </a>
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
      <h2 id="<?= e($s['id']) ?>-title"><?= e($s['title']) ?></h2>
      <p class="intro"><?= e($s['intro']) ?></p>
      <div class="feat-grid">
        <?php foreach ($s['features'] as $f): ?>
          <div class="feat"><h3><?= e($f['title']) ?></h3><p><?= e($f['text']) ?></p></div>
        <?php endforeach; ?>
      </div>
      <div class="examples"><b><?= tr('דוגמאות:', 'Typical projects:') ?></b><?php foreach ($s['cases'] as $c): ?><span class="ex-chip"><?= e($c) ?></span><?php endforeach; ?></div>
      <?php if (!empty($s['guide'])): ?><a class="link svc-guide" href="<?= e(lurl($s['guide']['href'])) ?>"><?= e($s['guide']['label']) ?> <?= icon('arrow') ?></a><?php endif; ?>
    </div>
    <?php if (!$alt) service_visual($s['id']); ?>
  </div>
</section>
<?php endforeach; ?>

<section class="journey dark" aria-labelledby="journey-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('איך זה מתחבר', 'How it connects') ?></span>
        <h2 class="sec" id="journey-title"><?= tr('איך השירותים<br><span class="acc">עובדים יחד.</span>', 'How the services<br><span class="acc">work together.</span>') ?></h2>
      </div>
      <p class="lead"><?= tr('ככה נראית הדרך של לקוח אחד כשאותו אדם בונה את כל השירותים, והמידע עובר משלב לשלב.', 'This is one customer’s journey when the same person builds every service, and the information moves from one step to the next.') ?></p>
    </div>
    <div class="jsteps">
      <?php if ($is_en): ?>
      <div class="jstep"><span class="k">01</span><h3>Sees your ad</h3><p>A targeted campaign on Google, Facebook or Instagram.</p><span class="s">Paid ads</span></div>
      <div class="jstep"><span class="k">02</span><h3>Lands on your page</h3><p>A fast landing page with one clear message.</p><span class="s">Web development</span></div>
      <div class="jstep"><span class="k">03</span><h3>Sends a message</h3><p>The chatbot replies instantly, asks the right questions and qualifies the lead.</p><span class="s">WhatsApp chatbot</span></div>
      <div class="jstep"><span class="k">04</span><h3>Gets followed up</h3><p>The lead lands in your CRM and receives a follow-up email.</p><span class="s">Automation</span></div>
      <div class="jstep"><span class="k">05</span><h3>Comes back</h3><p>Installs your app and gets your updates.</p><span class="s">PWA app</span></div>
      <?php else: ?>
      <div class="jstep"><span class="k">01</span><h3>רואה מודעה</h3><p>קמפיין ממוקד בפייסבוק, בגוגל או באינסטגרם.</p><span class="s">קמפיינים ממומנים</span></div>
      <div class="jstep"><span class="k">02</span><h3>נוחת בעמוד</h3><p>דף נחיתה מהיר עם מסר אחד ברור.</p><span class="s">פיתוח אתרים</span></div>
      <div class="jstep"><span class="k">03</span><h3>שולח הודעה</h3><p>הבוט עונה מיד, שואל ומסנן.</p><span class="s">צ'אטבוט לוואטסאפ</span></div>
      <div class="jstep"><span class="k">04</span><h3>נשמר ומטופל</h3><p>הליד נכנס ל־CRM ומקבל מייל המשך.</p><span class="s">אוטומציות</span></div>
      <div class="jstep"><span class="k">05</span><h3>חוזר שוב</h3><p>מתקין את האפליקציה ומקבל עדכונים.</p><span class="s">אפליקציית PWA</span></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
$cta_title = tr("לא בטוחים\nמאיפה להתחיל?", "Not sure\nwhere to start?");
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
