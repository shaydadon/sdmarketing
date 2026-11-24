<?php
$page_id      = 'index';
$page_title   = 'SDmarketing | אוטומציות, צ\'אטבוטים, אתרים ושיווק דיגיטלי לעסקים';
$page_desc    = 'SDmarketing בונה לעסקים צ\'אטבוטים לוואטסאפ, אוטומציות מייל ושיווק, אתרים וחנויות אונליין, אפליקציות PWA וקמפיינים ממוטבים.';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/projects-data.php';

?>

<section class="h3ro" aria-labelledby="hero-title">
  <div class="wrap h3-grid">
    <div class="h3-text hero-in">
      <span class="eyebrow">שי דדון · טכנולוגיה, אוטומציות ושיווק</span>
      <h1 id="hero-title"><span class="l1">העסק שלך ממשיך לעבוד.</span><span class="l2">גם כשאתה לא.</span></h1>
      <p class="lead">אתרים חכמים, אוטומציות ופתרונות דיגיטליים שמתחברים לעסק שלך, וחוסכים לך זמן, עבודה וכאב ראש.</p>
      <a class="btn btn-main" href="<?= e(wa_link($site, 'היי שי, אשמח לדבר על העסק שלי')) ?>" target="_blank" rel="noopener"><span>בואו נדבר על העסק שלכם</span><?= icon('arrow') ?></a>
      <p class="offer">הודעה קצרה בוואטסאפ מספיקה. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.</p>
    </div>
    <figure class="h3-art" aria-label="עבודות אמיתיות: החנות fisha.shop, האפליקציה Excerly והצ׳אטבוט Boardog">
      <div class="browser h3-b">
        <div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div>
        <img src="assets/img/projects/fisha/tattoos-1.webp" alt="" width="1600" height="1000" decoding="async" fetchpriority="high">
      </div>
      <div class="device h3-p"><img src="assets/img/projects/excerly/session-m.webp" alt="" width="780" height="1688" decoding="async"></div>
      <div class="device h3-bd"><img src="assets/img/projects/boardog/chat-end.webp" alt="" width="780" height="1690" decoding="async"></div>
      <ul class="h3-why" aria-label="מה הצ׳אטבוט Boardog פותר">
        <li><?= icon('check') ?><span><b>עונה תוך שניות</b>גם בשתיים בלילה</span></li>
        <li><?= icon('check') ?><span><b>אוסף את כל הפרטים</b>בלי טלפונים חוזרים</span></li>
        <li><?= icon('check') ?><span><b>קובע פגישה לבד</b>ושולח סיכום מסודר</span></li>
      </ul>
      <figcaption class="h3-cap">עבודות אמיתיות: <b lang="en">fisha.shop</b> · <b lang="en">Excerly</b> · <b lang="en">Boardog</b></figcaption>
    </figure>
  </div>
</section>

<section class="statement" aria-labelledby="problem-title">
  <div class="wrap">
    <span class="eyebrow">הבעיה</span>
    <h2 id="problem-title">רוב העסקים מאבדים לקוחות בפער שבין <mark>"מישהו פנה"</mark> ל<mark>"מישהו חזר אליו"</mark>. <em>אני בונה את המערכת שסוגרת את הפער הזה.</em></h2>
  </div>
</section>

<?php
$outcomes = [
    'automations' => 'פחות עבודה ידנית. יותר זמן לעסק.',
    'websites'    => 'אתר שמביא פניות, לא רק נראה טוב.',
    'pwa'         => 'האפליקציה שלך, במסך הבית של הלקוח.',
    'marketing'   => 'יודעים מה מביא לקוחות, ומפסיקים לשלם על מה שלא.',
];
?>
<section class="services lite" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">מה אני בונה</span>
        <h2 class="sec" id="services-title">ארבעה תחומים. מערכת אחת שעובדת יחד.</h2>
      </div>
    </div>

    <div class="svc-grid">
      <?php foreach ($services as $i => $s): ?>
        <a class="svc rv" href="services.php#<?= e($s['id']) ?>">
          <span class="icon"><?= icon($s['icon']) ?></span>
          <h3><?= e($s['title']) ?></h3>
          <p class="d"><?= e($s['lead']) ?></p>
          <p class="out"><?= e($outcomes[$s['id']] ?? '') ?><?= icon('arrow') ?></p>
        </a>
      <?php endforeach; ?>
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
      <?php foreach ($projects as $p): ?>
        <article class="proj big<?= $p['layout'] === 'phones' ? ' rev' : '' ?>">
          <?php if ($p['layout'] === 'phones'): ?>
            <div class="media media-ex">
              <?php foreach ($p['shots'] as $shot): ?>
                <div class="mphone"><img src="<?= e($shot['src']) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async"></div>
              <?php endforeach; ?>
            </div>
          <?php else: $shot = $p['shots'][0]; ?>
            <div class="media media-fisha">
              <div class="browser">
                <div class="bar"><i></i><i></i><i></i><u></u></div>
                <img src="<?= e($shot['src']) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" decoding="async">
              </div>
            </div>
          <?php endif; ?>
          <div class="body">
            <div class="row"><h3 lang="en"><?= e($p['name']) ?></h3><span class="tag acc"><?= e($p['tag']) ?></span></div>
            <p><?= e($p['summary']) ?></p>
            <a class="link" href="<?= e($p['url']) ?>" target="_blank" rel="noopener"><?= e($p['url_label']) ?> <?= icon('external') ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="approach" aria-labelledby="about-title">
  <div class="wrap ap-grid">
    <div class="ap-photo rv">
      <img src="assets/img/founder.webp" alt="שי דדון, מייסד SDmarketing" width="1024" height="1024" loading="lazy" decoding="async">
      <div class="cap"><b>שי דדון</b><span>מפתח תוכנה, B.Sc. מדעי המחשב, שיווק דיגיטלי</span></div>
    </div>
    <div>
      <span class="eyebrow">למה אני</span>
      <h2 class="sec" id="about-title"><span class="count" data-count="15">15</span> שנות ניסיון בטכנולוגיה.<span class="acc">גישה אחת פשוטה: קודם מבינים את הבעיה.</span></h2>
      <p class="lead">אני לא מתחיל מקוד, עיצוב או מערכת חדשה. אני מתחיל מהשאלה מה לא עובד בעסק שלך, ואיך אפשר לשנות את זה.</p>
      <ol class="qs">
        <li class="rv"><span>01</span><div><b>איפה העסק מאבד פניות?</b>הודעה שלא נענתה, ליד שלא חזרו אליו, עגלה שננטשה.</div></li>
        <li class="rv"><span>02</span><div><b>מה חוזר על עצמו כל יום?</b>כל מה שמישהו עושה ידנית שוב ושוב יכול לרוץ לבד.</div></li>
        <li class="rv"><span>03</span><div><b>מה הצעד הקטן שיחזיר הכי הרבה?</b>מתחילים ממנו, מודדים, ורק אז מוסיפים את הבא.</div></li>
      </ol>
      <div class="vs">
        <div class="a"><h3>הדרך הרגילה</h3>שלושה ספקים, שלוש הצעות מחיר, ואתה מתווך ביניהם.</div>
        <div class="b"><h3>עם SDmarketing</h3>תוכנית אחת, מחיר אחד, איש קשר אחד.</div>
      </div>
      <a class="link" href="about.php">הסיפור המלא <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php
$faq = [
    [
        'q' => 'יש לי מוצרים מעולים אבל אין לי איך למכור אותם אונליין?',
        'a' => 'חנות אונליין נבנית סביב הקנייה: קטלוג, עגלה, סליקה וניהול הזמנות, בלי שהגולש ילך לאיבוד בדרך. אותו קו עבודה מתאים גם לדף נחיתה לקמפיין או לאתר תדמית שמוביל לשיחה. דוגמה לחנות חיה היא fisha.shop.',
    ],
    [
        'q' => 'פניות מגיעות בוואטסאפ ובמייל, ואני לא מספיק לחזור לכולן?',
        'a' => 'אוטומציה מעבירה את מה שחוזר על עצמו לרוץ לבד: הודעה, מייל או עדכון בטבלה. בוט יכול לענות על שאלות נפוצות, לאסוף פרטים ולקבוע תור, והפרטים עוברים ליומן או לגיליון בלי להעתיק אותם ידנית.',
    ],
    [
        'q' => 'אני רוצה אפליקציה ללקוחות, בלי לעבור דרך חנות האפליקציות?',
        'a' => 'אפליקציית PWA מתקינים ישר מהדפדפן, ללא צורך בחנות האפליקציות, והיא נפתחת עם אייקון במסך הבית. אותו קוד רץ על אנדרואיד, על אייפון ועל מחשב. כך נבנתה Excerly.',
    ],
    [
        'q' => 'אני משלם על פרסום ולא ברור לי מה באמת מביא פניות?',
        'a' => 'קמפיין בגוגל או במטא נמדד לפי פניות ומכירות, לא לפי לייקים. קודם מוודאים שכל פנייה נספרת, ואז משפרים את מה שמביא תוצאה ועוצרים את מה שלא. בסוף יש דוח ברור: מה עבד ומה כדאי לשנות הלאה.',
    ],
    [
        'q' => 'יש לי פנסיון, והוואטסאפ מתמלא בשאלות על תאריכים ופגישות?',
        'a' => 'Boardog הוא צ׳אטבוט לוואטסאפ לבעלי פנסיונים. הוא מקבל את הפנייה, אוסף את פרטי בעל החיים ואת התאריכים, וקובע פגישת היכרות בלי שתנהלו את כל השיחה ידנית.',
    ],
];
$faq_ld = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn($item) => [
        '@type' => 'Question',
        'name' => $item['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
    ], $faq),
];
?>
<section class="faq" aria-labelledby="faq-title">
  <div class="wrap">
    <span class="eyebrow">שאלות נפוצות</span>
    <h2 class="sec" id="faq-title">שאלות שבעלי עסקים שואלים אותי</h2>
    <div class="faq-list">
      <?php foreach ($faq as $i => $item): ?>
        <details>
          <summary id="faq-q-<?= $i ?>"><span><?= e($item['q']) ?></span></summary>
          <div class="faq-a" role="region" aria-labelledby="faq-q-<?= $i ?>">
            <p><?php
              $html = e($item['a']);
              $html = str_replace(
                  'fisha.shop',
                  '<a href="https://fisha.shop" target="_blank" rel="noopener">fisha.shop</a>',
                  $html
              );
              $html = str_replace(
                  'Excerly',
                  '<a href="https://shaydadon.github.io/Excerly/" target="_blank" rel="noopener">Excerly</a>',
                  $html
              );
              echo $html;
            ?></p>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<script type="application/ld+json"><?= json_encode($faq_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>

<?php
$cta_contacts = true;
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
