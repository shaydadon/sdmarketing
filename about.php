<?php
$page_id      = 'about';
$page_title   = 'אודות | SDmarketing | מפתח, משווק ואיש אוטומציות באדם אחד';
$page_desc    = 'מי עומד מאחורי SDmarketing, איך אני עובד, ולמה עסק מרוויח כשאותו אדם בונה את האוטומציה, האתר והקמפיין.';
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/projects-data.php';
?>

<!-- ============ ABOUT HERO ============ -->
<section class="page-hero about-hero" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container about-hero-grid">
    <div>
      <nav class="breadcrumbs" aria-label="מיקום בעמוד">
        <a href="index.php">בית</a><span aria-hidden="true">/</span><span aria-current="page">אודות</span>
      </nav>
      <h1 id="page-title">נעים מאוד, אני <span class="nowrap">שי דדון.</span><br><span>המייסד של <bdi>SDmarketing</bdi></span></h1>
      <p class="page-lead">מפתח עם יותר מעשר שנות ניסיון, שבונה לעסקים את מה שמחבר בין הלקוח לבין המכירה: הבוט שעונה בוואטסאפ, האתר או האפליקציה שהלקוח נוחת בהם, הקמפיין שמביא אותו, והאוטומציה שדואגת שאף אחד לא ייפול באמצע.</p>
      <div class="hero-actions">
        <a class="btn btn-light btn-lg" href="<?= e(wa_link($site, 'היי, קראתי עליך באתר ואשמח לדבר')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        <a class="btn btn-ghost btn-lg" href="projects.php"><span>לעבודות שלי</span><?= icon('arrow') ?></a>
      </div>
    </div>
    <figure class="about-hero-photo">
      <img src="assets/img/founder.jpg" alt="שי דדון, מייסד SDmarketing" width="1024" height="1024">
      <figcaption><?= logo_mark() ?><span><b>שי דדון</b><small>מייסד SDmarketing</small></span></figcaption>
    </figure>
  </div>
</section>

<!-- ============ BACKGROUND ============ -->
<section class="section story" aria-labelledby="story-title">
  <div class="container story-grid">
    <div class="story-copy">
      <h2 id="story-title">מתכנת שלמד לדבר שיווק.</h2>
      <p>את רוב הקריירה שלי ביליתי בפיתוח: יותר מעשר שנים של בניית מערכות, אתרים ואפליקציות, על בסיס תואר ראשון במדעי המחשב.</p>
      <p>עם הזמן הבנתי שהקוד הוא רק חצי מהסיפור. אתר מצוין לא שווה הרבה אם אף אחד לא מגיע אליו, וליד שנכנס לא שווה כלום אם אף אחד לא חוזר אליו. אז הוספתי לימודי שיווק דיגיטלי, והקמתי את SDmarketing כדי לחבר בין שני העולמות.</p>
      <p>התוצאה: מישהו שמבין גם איך הקמפיין עובד, גם איך האתר בנוי מבפנים, וגם איך לגרום לשניהם לדבר עם הוואטסאפ של העסק.</p>
    </div>
    <ul class="creds" aria-label="השכלה וניסיון">
      <li><span class="cred-ico"><?= icon('code') ?></span><span><b><bdi dir="ltr">10+</bdi> שנות ניסיון בפיתוח</b><small>מערכות, אתרים ואפליקציות</small></span></li>
      <li><span class="cred-ico"><?= icon('cap') ?></span><span><b><bdi dir="ltr">B.Sc.</bdi> במדעי המחשב</b><small>תואר ראשון</small></span></li>
      <li><span class="cred-ico"><?= icon('chart') ?></span><span><b>בוגר קורס שיווק דיגיטלי</b><small>קמפיינים, מדידה ואופטימיזציה</small></span></li>
    </ul>
  </div>
</section>

<!-- ============ ONE PERSON vs THREE SUPPLIERS ============ -->
<section class="section why-one" aria-labelledby="why-title">
  <div class="container">
    <div class="section-head">
      <h2 id="why-title">למה אדם אחד עדיף על שלושה ספקים.</h2>
      <p>כשהמתכנת, המשווק ומי ש"מחבר את הוואטסאפ" הם שלושה אנשים שונים, כל העברה ביניהם היא מקום שבו מידע הולך לאיבוד. וכשמשהו לא עובד, כל אחד מצביע על השני.</p>
    </div>

    <div class="compare">
      <div class="compare-side compare-side--before">
        <h3>הדרך הרגילה</h3>
        <div class="compare-diagram" aria-hidden="true">
          <span class="cd-node cd-a"><?= icon('browser') ?>מתכנת</span>
          <span class="cd-node cd-b"><?= icon('chart') ?>משווק</span>
          <span class="cd-node cd-c"><?= icon('bot') ?>איש אוטומציות</span>
          <svg class="cd-lines" viewBox="0 0 300 200" preserveAspectRatio="none"><path d="M80 52 L 220 52"/><path d="M70 70 L 140 150"/><path d="M230 70 L 160 150"/></svg>
          <span class="cd-break cd-break-1">?</span><span class="cd-break cd-break-2">?</span><span class="cd-break cd-break-3">?</span>
        </div>
        <ul class="compare-list">
          <li>שלוש הצעות מחיר, שלושה לוחות זמנים</li>
          <li>אתה מתווך בין הספקים</li>
          <li>כשמשהו נשבר, לא ברור של מי האחריות</li>
        </ul>
      </div>

      <div class="compare-side compare-side--after">
        <h3>עם SDmarketing</h3>
        <div class="compare-diagram" aria-hidden="true">
          <span class="cd-hub"><?= logo_mark('cd-mark') ?></span>
          <span class="cd-node cd-a"><?= icon('browser') ?>אתר</span>
          <span class="cd-node cd-b"><?= icon('chart') ?>קמפיין</span>
          <span class="cd-node cd-c"><?= icon('bot') ?>אוטומציה</span>
          <svg class="cd-lines" viewBox="0 0 300 200" preserveAspectRatio="none"><path d="M150 100 L 70 50"/><path d="M150 100 L 230 50"/><path d="M150 100 L 150 165"/></svg>
        </div>
        <ul class="compare-list">
          <li>תוכנית אחת, מחיר אחד, איש קשר אחד</li>
          <li>כל חלק נבנה כדי לעבוד עם השאר</li>
          <li>אחריות מלאה על התוצאה, מקצה לקצה</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ============ HOW I WORK ============ -->
<section class="section principles" aria-labelledby="principles-title">
  <div class="container principles-grid">
    <div class="principles-head">
      <h2 id="principles-title">איך אני עובד.</h2>
      <p>ארבעה כללים שמלווים כל פרויקט, מהשיחה הראשונה ועד אחרי שהוא עולה לאוויר.</p>
    </div>
    <ul class="principle-list">
      <li>
        <h3>קודם מבינים את העסק, אחר כך בונים.</h3>
        <p>לא מתחילים מטכנולוגיה. מתחילים מהשאלה איפה הולך לכם זמן ואיפה הולכים לאיבוד לקוחות. ובונים רק את מה שפותר את זה.</p>
      </li>
      <li>
        <h3>הכל בכתב, לפני שמתחילים.</h3>
        <p>מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר. בלי הפתעות באמצע.</p>
      </li>
      <li>
        <h3>מודדים, ואז משפרים.</h3>
        <p>כל אתר, בוט וקמפיין מחוברים למעקב מהיום הראשון, כדי שהחלטות יתקבלו לפי נתונים ולא לפי תחושה.</p>
      </li>
      <li>
        <h3>זמין כמו שהלקוחות שלכם זמינים.</h3>
        <p>מדברים בוואטסאפ, בשפה פשוטה, בלי טפסים ובלי מערכת כרטיסים. אתם יודעים בכל רגע איפה הפרויקט עומד.</p>
      </li>
    </ul>
  </div>
</section>

<!-- ============ PROOF: RECENT WORK ============ -->
<section class="section about-work" aria-labelledby="work-title">
  <div class="container">
    <div class="section-head section-head--row">
      <div>
        <h2 id="work-title">ההוכחה נמצאת באוויר.</h2>
        <p>כמה מהדברים שבניתי לאחרונה. אפשר להיכנס ולנסות בעצמכם.</p>
      </div>
      <a class="btn btn-outline" href="projects.php"><span>לכל הפרויקטים</span><?= icon('arrow') ?></a>
    </div>
    <ul class="work-strip">
      <?php foreach ($projects as $p): ?>
        <li>
          <a class="work-item" href="<?= e($p['url'] ?: 'projects.php#case-' . $p['slug']) ?>"<?= $p['url'] ? ' target="_blank" rel="noopener"' : '' ?>>
            <span class="work-mono" aria-hidden="true"><?= e(mb_strtoupper(mb_substr($p['name'], 0, 1))) ?></span>
            <span class="work-text"><b dir="ltr" lang="en"><?= e($p['name']) ?></b><small><?= e($p['type']) ?></small></span>
            <?= icon($p['url'] ? 'external' : 'arrow', 'icon work-arrow') ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
$cta_title = 'בואו נכיר.';
$cta_text  = 'שיחה קצרה, בלי התחייבות: תספרו לי על העסק, ואגיד לכם בכנות מה הייתי בונה ראשון (ואם בכלל צריך).';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
?>
