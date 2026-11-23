<?php
$page_id      = 'index';
$page_title   = 'SDmarketing | אוטומציות, צ\'אטבוטים, אתרים ושיווק דיגיטלי לעסקים';
$page_desc    = 'SDmarketing בונה לעסקים צ\'אטבוטים לוואטסאפ, אוטומציות מייל ושיווק, אתרים וחנויות אונליין, אפליקציות PWA וקמפיינים ממוטבים.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/projects-data.php';

$by = [];
foreach ($projects as $p) $by[$p['slug']] = $p;
$fisha = $by['fisha'];
$excerly = $by['excerly'];
?>

<section class="hero dark">
  <div class="glow" aria-hidden="true"></div>
  <div class="wrap hero-grid">
    <div>
      <span class="eyebrow">אוטומציות · אתרים · PWA · שיווק</span>
      <h1 id="hero-title">העסק שלך ממשיך לעבוד.<span class="l2">גם כשאתה לא.</span></h1>
      <p class="lead">צ'אטבוטים, אוטומציות, אתרים וקמפיינים שמחוברים זה לזה, כדי שכל פנייה תקבל מענה וכל ליד יגיע למקום הנכון.</p>
      <div class="ctas">
        <a class="btn btn-acc" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
        <a class="btn btn-ghost-d" href="projects.php">לעבודות שלי<?= icon('arrow') ?></a>
      </div>
      <div class="meta">
        <div><b>אדם אחד</b><span>מהקמפיין ועד הבוט</span></div>
        <div><b>הכל בכתב</b><span>תוכנית ומחיר לפני שמתחילים</span></div>
        <div><b>בוואטסאפ</b><span>בלי טפסים ובלי כרטיסים</span></div>
      </div>
    </div>

    <figure class="demo" data-demo>
      <div class="phone">
        <div class="scr">
          <div class="chat-h"><span class="av">ד</span><div><b>המספרה של דנה</b><span>מחובר/ת</span></div></div>
          <div class="chat-b">
            <div class="msg out">היי, אפשר לקבוע תור לתספורת מחר?<span class="t">09:41</span></div>
            <div class="msg in">בטח! מחר פנוי ב־10:00 או ב־13:30. מה מתאים לך?<div class="slots"><i>10:00</i><i class="on">13:30</i></div><span class="t">09:41</span></div>
            <div class="msg out">13:30 מעולה<span class="t">09:42</span></div>
            <div class="msg in">קבעתי! מחר 13:30. שלחתי אישור למייל ואזכיר לך בבוקר.<span class="t">09:42</span></div>
          </div>
          <div class="chat-in">הקלידו הודעה…</div>
        </div>
      </div>
      <div class="events">
        <div class="ev"><span class="ic"><?= icon('calendar') ?></span><div><b>התור נכנס ליומן</b><span>Google Calendar</span></div><span class="ok"><?= icon('check') ?></span></div>
        <div class="ev"><span class="ic"><?= icon('database') ?></span><div><b>לקוחה חדשה נשמרה</b><span>CRM</span></div><span class="ok"><?= icon('check') ?></span></div>
        <div class="ev"><span class="ic"><?= icon('mail') ?></span><div><b>מייל אישור נשלח</b><span>אוטומציית מייל</span></div><span class="ok"><?= icon('check') ?></span></div>
      </div>
      <figcaption class="demo-tag">הדגמה להמחשה</figcaption>
    </figure>
  </div>
  <div class="ticker">
    <div class="wrap">
      <span>צ'אטבוטים לוואטסאפ</span>
      <span>אוטומציות מייל</span>
      <span>חיבור בין מערכות</span>
      <span>אתרים וחנויות</span>
      <span>אפליקציות PWA</span>
      <span>קמפיינים בגוגל ובמטא</span>
    </div>
  </div>
</section>

<section class="statement" aria-labelledby="problem-title">
  <div class="wrap">
    <span class="eyebrow">הבעיה</span>
    <h2 id="problem-title">רוב העסקים מאבדים לקוחות בפער שבין <mark>"מישהו פנה"</mark> ל<mark>"מישהו חזר אליו"</mark>. <em>אני בונה את המערכת שסוגרת את הפער הזה.</em></h2>
  </div>
</section>

<section class="services" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">מה אני בונה</span>
        <h2 class="sec" id="services-title">ארבעה תחומים.<br>מערכת אחת שעובדת יחד.</h2>
      </div>
      <p class="lead">הבוט שעונה ללקוחות, האתר שהוא יושב עליו והקמפיין שמביא אליו תנועה. כשאותו אדם בונה את כולם, הם מדברים זה עם זה.</p>
    </div>

    <div class="svc-grid">
      <?php foreach ($services as $i => $s): ?>
        <article class="svc<?= $i === 0 ? ' feat' : '' ?>">
          <span class="num"><?= sprintf('%02d', $i + 1) ?></span>
          <span class="icon"><?= icon($s['icon']) ?></span>
          <h3><?= e($s['title']) ?></h3>
          <p class="d"><?= e($s['lead']) ?></p>
          <ul>
            <?php foreach ($s['items'] as $item): ?><li><?= e($item) ?></li><?php endforeach; ?>
          </ul>
          <a class="link" href="services.php#<?= e($s['id']) ?>"><span>לפרטים על <?= e($s['title']) ?></span><?= icon('arrow') ?></a>
        </article>
      <?php endforeach; ?>
    </div>

    <div class="flow">
      <span class="lbl">ככה זה מתחבר</span>
      <span class="st"><i>1</i>הודעה נכנסת</span>
      <span class="ln"></span>
      <span class="st"><i>2</i>הבוט מסנן</span>
      <span class="ln"></span>
      <span class="st"><i>3</i>ליד ב־CRM</span>
      <span class="ln"></span>
      <span class="st last"><i>4</i>מייל המשך</span>
    </div>
  </div>
</section>

<section class="process dark" aria-labelledby="process-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">תהליך עבודה</span>
        <h2 class="sec" id="process-title">מהשיחה הראשונה<br>ועד שזה <span class="acc">רץ לבד.</span></h2>
      </div>
      <p class="lead">בלי הפתעות באמצע: יודעים מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר.</p>
    </div>
    <div class="steps">
      <div class="step"><div class="n">01</div><h3>שיחת היכרות</h3><p>מבינים איך העסק עובד היום, איפה הולך זמן ואיפה הולכים לאיבוד לקוחות.</p></div>
      <div class="step"><div class="n">02</div><h3>אפיון ותוכנית</h3><p>תוכנית כתובה: מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר.</p></div>
      <div class="step"><div class="n">03</div><h3>בנייה והטמעה</h3><p>בונים, מחברים למערכות הקיימות ובודקים עם לקוחות אמיתיים לפני שמשחררים.</p></div>
      <div class="step"><div class="n">04</div><h3>ליווי ושיפור</h3><p>עוקבים אחרי הנתונים, משפרים את מה שאפשר ומוסיפים את הצעד הבא.</p></div>
    </div>
  </div>
</section>

<section class="work" aria-labelledby="work-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">עבודות אחרונות</span>
        <h2 class="sec" id="work-title">ההוכחה נמצאת באוויר.</h2>
      </div>
      <a class="btn btn-ink" href="projects.php">לכל הפרויקטים<?= icon('arrow') ?></a>
    </div>
    <div class="proj-grid">
      <article class="proj big">
        <div class="media media-fisha">
          <div class="browser">
            <div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div>
            <img class="tall" src="assets/img/projects/fisha/originals-main.webp" alt="עמוד Originals בחנות fisha.shop" width="1600" height="1133" decoding="async">
          </div>
          <div class="thumbs">
            <img src="assets/img/projects/fisha/tattoos-1.webp" alt="עמוד הקעקועים של fisha.shop" width="1600" height="1000" loading="lazy" decoding="async">
            <img src="assets/img/projects/fisha/tattoos-2.webp" alt="Flash sheet בחנות fisha.shop" width="1600" height="1000" loading="lazy" decoding="async">
            <img src="assets/img/projects/fisha/shop-hq-c.webp" alt="עמוד החנות של fisha.shop" width="1600" height="929" loading="lazy" decoding="async">
          </div>
        </div>
        <div class="body">
          <div class="row"><h3 lang="en"><?= e($fisha['name']) ?></h3><span class="tag acc"><?= e($fisha['type']) ?></span></div>
          <p><?= e($fisha['home']) ?></p>
          <div class="row" style="justify-content:flex-start;gap:8px">
            <?php foreach ($fisha['tags'] as $tag): ?><span class="tag" lang="en"><?= e($tag) ?></span><?php endforeach; ?>
          </div>
          <a class="link" href="<?= e($fisha['url']) ?>" target="_blank" rel="noopener">לאתר החי <?= icon('external') ?></a>
        </div>
      </article>

      <article class="proj big rev">
        <div class="media media-ex">
          <div class="mphone"><img src="assets/img/projects/excerly/workouts-m.webp" alt="מסך האימונים באפליקציית Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
          <div class="mphone"><img src="assets/img/projects/excerly/home-m.webp" alt="מסך היום באפליקציית Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
          <div class="mphone"><img src="assets/img/projects/excerly/nutrition-m.webp" alt="מסך התזונה באפליקציית Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        </div>
        <div class="body">
          <div class="row"><h3 lang="en"><?= e($excerly['name']) ?></h3><span class="tag acc"><?= e($excerly['type']) ?></span></div>
          <p><?= e($excerly['home']) ?></p>
          <a class="link" href="projects.php#case-excerly">פרטים על הפרויקט <?= icon('arrow') ?></a>
        </div>
      </article>
    </div>
  </div>
</section>

<section class="founder" aria-labelledby="about-title">
  <div class="wrap f-grid">
    <div class="f-photo">
      <div class="sq" aria-hidden="true"></div>
      <img src="assets/img/founder.webp" alt="שי דדון, מייסד SDmarketing" width="1024" height="1024" loading="lazy" decoding="async">
      <div class="cap"><b>שי דדון</b><span>מייסד SDmarketing</span></div>
    </div>
    <div>
      <span class="eyebrow">מי עומד מאחורי זה</span>
      <h2 class="sec" id="about-title">מפתח, משווק ואיש אוטומציות.<br><span class="acc">באותו אדם.</span></h2>
      <p class="body">רוב העסקים עובדים עם מתכנת אחד, משווק אחר ומישהו שלישי ש"מחבר את הוואטסאפ". כל העברה ביניהם היא עוד מקום שבו דברים נופלים. אחרי יותר מ־15 שנה כמפתח תוכנה, קורס בשיווק ושנתיים של עבודה בשיווק דיגיטלי, ב־SDmarketing אני מתכנן, בונה ומנהל את כל השרשרת בעצמי: מהקמפיין, דרך האתר ועד הבוט שעונה ללקוח בשתיים בלילה.</p>
      <div class="creds">
        <div><b class="ltr">15+</b><span>שנות ניסיון כמפתח תוכנה</span></div>
        <div><b class="ltr">B.Sc.</b><span>תואר במדעי המחשב</span></div>
        <div><b>שנתיים</b><span>בשיווק דיגיטלי, אחרי קורס שיווק</span></div>
      </div>
      <div class="vs">
        <div class="a"><h3>הדרך הרגילה</h3>שלושה ספקים, שלוש הצעות מחיר, ואתה מתווך ביניהם.</div>
        <div class="b"><h3>עם SDmarketing</h3>תוכנית אחת, מחיר אחד, איש קשר אחד.</div>
      </div>
      <a class="link" href="about.php" style="margin-top:32px">עוד עליי <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php
$cta_contacts = true;
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
