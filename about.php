<?php
$page_id    = 'about';
$page_title = 'אודות | SDmarketing | מפתח, משווק ואיש אוטומציות באדם אחד';
$page_desc  = 'שי דדון, מייסד SDmarketing: יותר מ־15 שנה כמפתח תוכנה, B.Sc. במדעי המחשב, קורס שיווק ושנתיים בשיווק דיגיטלי.';
require __DIR__ . '/includes/header.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap about-hero">
    <div style="padding-bottom:90px">
      <nav class="crumb" aria-label="מיקום בעמוד"><a href="index.php">בית</a> / <b>אודות</b></nav>
      <h1 id="page-title">נעים מאוד,<span>אני שי דדון.</span></h1>
      <p class="lead">מפתח תוכנה עם יותר מ־15 שנות ניסיון, שבונה לעסקים את מה שמחבר בין הלקוח לבין המכירה: הבוט שעונה בוואטסאפ, האתר או האפליקציה שהלקוח נוחת בהם, הקמפיין שמביא אותו, והאוטומציה שדואגת שאף אחד לא ייפול באמצע.</p>
      <div class="ctas">
        <a class="btn btn-acc" href="<?= e(wa_link($site, 'היי, קראתי עליך באתר ואשמח לדבר')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        <a class="btn btn-ghost-d" href="projects.php">לעבודות שלי</a>
      </div>
    </div>
    <div class="ph">
      <img src="assets/img/founder.webp" alt="שי דדון, מייסד SDmarketing" width="1024" height="1024" decoding="async">
      <div class="badge">המייסד של<br>SDmarketing</div>
    </div>
  </div>
</section>

<section class="story" id="bio" aria-labelledby="story-title">
  <div class="wrap">
    <div class="split">
      <div>
        <span class="eyebrow">הסיפור</span>
        <h2 id="story-title" style="margin-top:16px">מתכנת<br>שלמד <span class="acc">לדבר שיווק.</span></h2>
      </div>
      <div>
        <p>את רוב הקריירה שלי ביליתי בפיתוח: יותר מ־15 שנים של בניית מערכות, אתרים ואפליקציות, על בסיס תואר ראשון במדעי המחשב.</p>
        <p>עם הזמן הבנתי שהקוד הוא רק חצי מהסיפור. אתר מצוין לא שווה הרבה אם אף אחד לא מגיע אליו, וליד שנכנס לא שווה כלום אם אף אחד לא חוזר אליו. אז השלמתי קורס בשיווק, ובשנתיים האחרונות אני עוסק גם בשיווק דיגיטלי. הקמתי את SDmarketing כדי לחבר בין שני העולמות.</p>
        <p class="hl">התוצאה: מישהו שמבין גם איך הקמפיין עובד, גם איך האתר בנוי מבפנים, וגם איך לגרום לשניהם לדבר עם הוואטסאפ של העסק.</p>
      </div>
    </div>
    <div class="cred-row" id="creds">
      <div class="c"><b class="ltr">15+</b><span>שנות ניסיון כמפתח תוכנה</span><small>מערכות, אתרים ואפליקציות</small></div>
      <div class="c"><b class="ltr">B.Sc.</b><span>במדעי המחשב</span><small>תואר ראשון</small></div>
      <div class="c"><b class="sm">קורס שיווק</b><span>בוגר קורס בשיווק</span><small>אסטרטגיה, קהלים ומסרים</small></div>
      <div class="c"><b>שנתיים</b><span>בשיווק דיגיטלי</span><small>קמפיינים, מדידה ואופטימיזציה</small></div>
    </div>
  </div>
</section>

<section class="compare dark" aria-labelledby="compare-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">למה זה חשוב</span>
        <h2 class="sec" id="compare-title">למה אדם אחד<br><span class="acc">עדיף על שלושה ספקים.</span></h2>
      </div>
      <p class="lead">כשהמתכנת, המשווק ומי ש"מחבר את הוואטסאפ" הם שלושה אנשים שונים, כל העברה ביניהם היא מקום שבו מידע הולך לאיבוד. וכשמשהו לא עובד, כל אחד מצביע על השני.</p>
    </div>
    <div class="cmp">
      <div class="col old">
        <h3>הדרך הרגילה</h3>
        <div class="nodes"><span>מתכנת</span><span>משווק</span><span>איש אוטומציות</span></div>
        <ul>
          <li><i><?= icon('close') ?></i>שלוש הצעות מחיר, שלושה לוחות זמנים</li>
          <li><i><?= icon('close') ?></i>אתה מתווך בין הספקים</li>
          <li><i><?= icon('close') ?></i>כשמשהו נשבר, לא ברור של מי האחריות</li>
        </ul>
      </div>
      <div class="col new">
        <h3>עם SDmarketing</h3>
        <div class="nodes"><span>אתר</span><span>קמפיין</span><span>אוטומציה</span></div>
        <ul>
          <li><i><?= icon('check') ?></i>תוכנית אחת, מחיר אחד, איש קשר אחד</li>
          <li><i><?= icon('check') ?></i>כל חלק נבנה כדי לעבוד עם השאר</li>
          <li><i><?= icon('check') ?></i>אחריות מלאה על התוצאה, מקצה לקצה</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="rules" aria-labelledby="rules-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">איך אני עובד</span>
        <h2 class="sec" id="rules-title">ארבעה כללים.</h2>
      </div>
      <p class="lead">ארבעה כללים שמלווים כל פרויקט, מהשיחה הראשונה ועד אחרי שהוא עולה לאוויר.</p>
    </div>
    <div class="rule-grid">
      <div class="rule"><span class="n">01</span><div><h3>קודם מבינים את העסק, אחר כך בונים.</h3><p>לא מתחילים מטכנולוגיה. מתחילים מהשאלה איפה הולך לכם זמן ואיפה הולכים לאיבוד לקוחות, ובונים רק את מה שפותר את זה.</p></div></div>
      <div class="rule"><span class="n">02</span><div><h3>הכל בכתב, לפני שמתחילים.</h3><p>מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר. בלי הפתעות באמצע.</p></div></div>
      <div class="rule"><span class="n">03</span><div><h3>מודדים, ואז משפרים.</h3><p>כל אתר, בוט וקמפיין מחוברים למעקב מהיום הראשון, כדי שהחלטות יתקבלו לפי נתונים ולא לפי תחושה.</p></div></div>
      <div class="rule"><span class="n">04</span><div><h3>זמין כמו שהלקוחות שלכם זמינים.</h3><p>מדברים בוואטסאפ, בשפה פשוטה, בלי טפסים ובלי מערכת כרטיסים. אתם יודעים בכל רגע איפה הפרויקט עומד.</p></div></div>
    </div>
  </div>
</section>

<?php
$cta_title = "שיחה קצרה,\nבלי התחייבות.";
$cta_text  = 'תספרו לי על העסק, ואגיד לכם בכנות מה הייתי בונה ראשון (ואם בכלל צריך).';
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
