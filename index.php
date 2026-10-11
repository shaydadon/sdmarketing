<?php
$page_id      = 'index';
$page_title   = 'SDmarketing | אוטומציות, צ\'אטבוטים, אתרים ושיווק דיגיטלי לעסקים';
$page_desc    = 'SDmarketing בונה לעסקים צ\'אטבוטים לוואטסאפ, אוטומציות מייל ושיווק, אתרים וחנויות אונליין, אפליקציות PWA וקמפיינים ממוטבים.';
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';

require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/service-visual.php';
require __DIR__ . '/includes/projects-data.php';
?>

<!-- ============ HERO ============ -->
<section class="hero" aria-labelledby="hero-title">
  <div class="hero-bg" aria-hidden="true">
    <svg class="hero-arc" viewBox="0 0 1200 700" preserveAspectRatio="none">
      <path d="M-40 640 C 300 600, 700 420, 1240 40" />
      <path d="M-40 690 C 340 650, 760 480, 1240 120" />
    </svg>
  </div>

  <div class="container hero-grid">
    <div class="hero-copy">
      <h1 id="hero-title"><span class="h1-line">העסק שלך ממשיך לעבוד.</span> <span class="h1-line h1-accent">גם כשאתה לא.</span></h1>
      <p class="hero-lead">צ'אטבוטים, אוטומציות, אתרים וקמפיינים שמחוברים זה לזה, כדי שכל פנייה תקבל מענה וכל ליד יגיע למקום הנכון.</p>

      <div class="hero-actions">
        <a class="btn btn-light btn-lg" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        <a class="btn btn-ghost btn-lg" href="services.php"><span>מה אני בונה</span><?= icon('arrow') ?></a>
      </div>
    </div>

    <!-- Live demo: a WhatsApp booking bot, followed by the automations it triggers -->
    <figure class="hero-demo" data-demo role="figure" aria-label="הדגמה: בוט וואטסאפ לקביעת תורים והאוטומציות שהוא מפעיל">
      <div class="phone">
        <div class="phone-top">
          <span class="wa-avatar"><?= icon('bot') ?></span>
          <span class="wa-meta"><b>המספרה של דנה</b><small data-status>מחובר/ת</small></span>
          <?= icon('whatsapp', 'icon wa-mark') ?>
        </div>
        <div class="chat" data-chat>
          <div class="msg in" data-step="1">היי, אפשר לקבוע תור לתספורת מחר?</div>
          <div class="msg out" data-step="2">בטח! מחר פנוי ב־<b>10:00</b> או ב־<b>13:30</b>. מה מתאים לך?</div>
          <div class="msg in" data-step="3">13:30 מעולה</div>
          <div class="msg out" data-step="4">קבעתי! <?= icon('check', 'icon icon-inline') ?> מחר 13:30. שלחתי אישור למייל ואזכיר לך בבוקר.</div>
          <div class="typing" data-typing aria-hidden="true"><i></i><i></i><i></i></div>
        </div>
      </div>

      <ol class="flow" aria-label="מה קורה מאחורי הקלעים">
        <li class="flow-node" data-step="5"><span class="flow-ico"><?= icon('calendar') ?></span><span><b>התור נכנס ליומן</b><small>Google Calendar</small></span></li>
        <li class="flow-node" data-step="6"><span class="flow-ico"><?= icon('database') ?></span><span><b>לקוחה חדשה נשמרה</b><small>CRM</small></span></li>
        <li class="flow-node" data-step="7"><span class="flow-ico"><?= icon('mail') ?></span><span><b>מייל אישור נשלח</b><small>אוטומציית מייל</small></span></li>
      </ol>
      <p class="demo-note">הדגמה להמחשה</p>
    </figure>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section class="section services" aria-labelledby="services-title">
  <div class="container">
    <div class="section-head">
      <h2 id="services-title">ארבעה תחומים. מערכת אחת שעובדת יחד.</h2>
      <p>הבוט שעונה ללקוחות, האתר שהוא יושב עליו והקמפיין שמביא אליו תנועה. כשאותו אדם בונה את כולם, הם מדברים זה עם זה.</p>
    </div>

    <div class="svc" data-tabs>
      <div class="svc-list" role="tablist" aria-label="שירותים">
        <?php foreach ($services as $i => $s): ?>
          <button class="svc-tab" role="tab" type="button"
                  id="tab-<?= $s['id'] ?>" aria-controls="panel-<?= $s['id'] ?>"
                  aria-selected="<?= $i === 0 ? 'true' : 'false' ?>" tabindex="<?= $i === 0 ? '0' : '-1' ?>">
            <span class="svc-tab-ico"><?= icon($s['icon']) ?></span>
            <span class="svc-tab-text"><b><?= e($s['title']) ?></b><small><?= e($s['lead']) ?></small></span>
            <?= icon('arrow', 'icon svc-tab-arrow') ?>
          </button>
        <?php endforeach; ?>
      </div>

      <?php foreach ($services as $i => $s): ?>
        <div class="svc-panel svc-panel--<?= $s['id'] ?>" role="tabpanel" id="panel-<?= $s['id'] ?>" aria-labelledby="tab-<?= $s['id'] ?>"<?= $i === 0 ? '' : ' hidden' ?>>
          <div class="svc-visual" aria-hidden="true">
            <?php service_visual($s['id']); ?>
          </div>

          <div class="svc-detail">
            <h3><?= e($s['title']) ?></h3>
            <p><?= e($s['lead']) ?></p>
            <ul class="check-list">
              <?php foreach ($s['items'] as $item): ?>
                <li><?= icon('check') ?><?= e($item) ?></li>
              <?php endforeach; ?>
            </ul>
            <a class="link-arrow" href="services.php#<?= $s['id'] ?>">לפרטים על <?= e($s['title']) ?><?= icon('arrow') ?></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ PROCESS ============ -->
<section class="section process" aria-labelledby="process-title">
  <div class="container">
    <div class="section-head">
      <h2 id="process-title">מהשיחה הראשונה ועד שזה רץ לבד</h2>
    </div>
    <ol class="steps">
      <li class="step"><span class="step-n">1</span><h3>שיחת היכרות</h3><p>מבינים איך העסק עובד היום, איפה הולך זמן ואיפה הולכים לאיבוד לקוחות.</p></li>
      <li class="step"><span class="step-n">2</span><h3>אפיון ותוכנית</h3><p>תוכנית כתובה: מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר.</p></li>
      <li class="step"><span class="step-n">3</span><h3>בנייה והטמעה</h3><p>בונים, מחברים למערכות הקיימות ובודקים עם לקוחות אמיתיים לפני שמשחררים.</p></li>
      <li class="step"><span class="step-n">4</span><h3>ליווי ושיפור</h3><p>עוקבים אחרי הנתונים, משפרים את מה שאפשר ומוסיפים את הצעד הבא.</p></li>
    </ol>
  </div>
</section>

<!-- ============ PROJECTS ============ -->
<section class="section projects" aria-labelledby="projects-title">
  <div class="container">
    <div class="section-head section-head--row">
      <div>
        <h2 id="projects-title">עבודות אחרונות</h2>
        <p>חנויות, אפליקציות ומערכות שעלו לאוויר ועובדות עכשיו.</p>
      </div>
      <a class="btn btn-outline" href="projects.php"><span>לכל הפרויקטים</span><?= icon('arrow') ?></a>
    </div>

    <div class="proj-grid">
      <?php foreach ($projects as $i => $p): ?>
        <article class="proj<?= $i === 0 ? ' proj--feature' : '' ?>">

          <div class="proj-screen proj-screen--<?= $p['screen'] ?>" aria-hidden="true">
            <?php if ($shot = project_screenshot($p['slug'])): ?>
              <img class="proj-shot" src="<?= e($shot) ?>" alt="" loading="lazy">
            <?php elseif ($p['screen'] === 'shop'): ?>
              <div class="ps-bar"><i></i><i></i><i></i><span dir="ltr" lang="en"><?= e($p['name']) ?></span></div>
              <div class="ps-shop">
                <div class="ps-banner"><b><?= e($p['name']) ?></b></div>
                <div class="ps-products"><i></i><i></i><i></i><i></i></div>
              </div>
            <?php else: ?>
              <div class="ps-phone"><div class="ps-app"><b><?= e(mb_substr($p['name'], 0, 1)) ?></b><span><?= e($p['name']) ?></span><i></i><i></i><i></i></div></div>
            <?php endif; ?>
          </div>
          <div class="proj-body">
            <div class="proj-meta"><span class="proj-type"><?= e($p['type']) ?></span><?php if (!project_screenshot($p['slug'])): ?><span class="proj-note">הדמיית מסך</span><?php endif; ?></div>
            <h3 dir="ltr" lang="en"><?= e($p['name']) ?></h3>
            <p><?= e($p['desc']) ?></p>
            <?php if ($p['url']): ?>
              <a class="link-arrow" href="<?= e($p['url']) ?>" target="_blank" rel="noopener">לאתר החי<?= icon('external') ?></a>
            <?php else: ?>
              <a class="link-arrow" href="projects.php#case-<?= e($p['slug']) ?>">פרטים על הפרויקט<?= icon('arrow') ?></a>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section class="section about" aria-labelledby="about-title">
  <div class="container about-grid">
    <figure class="about-photo">
      <img src="assets/img/founder.jpg" alt="שי דדון, מייסד SDmarketing" width="1024" height="1024" loading="lazy">
    </figure>
    <div class="about-copy">
      <h2 id="about-title">מפתח, משווק ואיש אוטומציות. באותו אדם.</h2>
      <p>רוב העסקים עובדים עם מתכנת אחד, משווק אחר ומישהו שלישי ש"מחבר את הוואטסאפ". כל העברה ביניהם היא עוד מקום שבו דברים נופלים.</p>
      <p>אני שי דדון, מפתח עם יותר מעשר שנות ניסיון, תואר במדעי המחשב ולימודי שיווק דיגיטלי. ב־SDmarketing אני מתכנן, בונה ומנהל את כל השרשרת בעצמי: מהקמפיין, דרך האתר ועד הבוט שעונה ללקוח בשתיים בלילה. כתובת אחת, אחריות אחת.</p>
      <a class="link-arrow" href="about.php">עוד עליי<?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/cta.php'; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
