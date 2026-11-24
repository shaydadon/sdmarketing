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
    <nav class="subnav" aria-label="<?= tr('מעבר בין שירותים', 'Jump to a service') ?>" data-jump>
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
      <?php if (!empty($s['more'])): ?>
        <p class="more"><a href="<?= e(url($s['more']['href'])) ?>"><?= e($s['more']['label']) ?></a></p>
      <?php endif; ?>
      <div class="feat-grid">
        <?php foreach ($s['features'] as $f): ?>
          <div class="feat"><h3><?= e($f['title']) ?></h3><p><?= e($f['text']) ?></p></div>
        <?php endforeach; ?>
      </div>
      <div class="examples"><b><?= tr('דוגמאות:', 'Typical projects:') ?></b><?php foreach ($s['cases'] as $c): ?><span class="ex-chip"><?= e($c) ?></span><?php endforeach; ?></div>
    </div>
    <?php if (!$alt) service_visual($s['id']); ?>
  </div>
</section>
<?php endforeach; ?>

<section class="journey dark" aria-labelledby="journey-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('איך זה מתחבר', 'How it all connects') ?></span>
        <h2 class="sec" id="journey-title"><?= tr('הכוח האמיתי:<br><span class="acc">כשהכל מחובר.</span>', 'The real advantage:<br><span class="acc">everything works together.</span>') ?></h2>
      </div>
      <p class="lead"><?= tr('ככה נראית דרכו של לקוח אחד כשכל השירותים בנויים על ידי אותו אדם: בלי פערים בין ספקים, ובלי מידע שהולך לאיבוד בדרך.', 'Here’s one customer’s journey when every piece is built by the same person: no gaps between vendors, and no data lost along the way.') ?></p>
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
