<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'index';
$page_title   = tr('צ׳אטבוט לוואטסאפ, אוטומציות ואתרים לעסקים | SDmarketing', 'WhatsApp Chatbots, Automations and Websites | SDmarketing');
$page_desc    = tr('צ׳אטבוט לוואטסאפ, אוטומציות לעסקים, בניית אתרים וחנויות, אפליקציות PWA, קידום אורגני וקמפיינים ממומנים. הכל מחובר, ואדם אחד אחראי על כולו.', 'WhatsApp chatbots, business automations, websites and online stores, PWA apps, SEO and paid campaigns. All connected, with one person responsible for all of it.');
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/projects-data.php';

?>

<section class="h3ro" aria-labelledby="hero-title">
  <div class="wrap h3-grid">
    <div class="h3-text hero-in">
      <span class="eyebrow"><?= tr('שי דדון · טכנולוגיה, אוטומציות ושיווק', 'Shay Dadon · Technology, automation and marketing') ?></span>
      <h1 id="hero-title"><?= tr('<span class="l1">העסק שלך ממשיך לעבוד.</span><span class="l2">גם כשאתה לא.</span>', '<span class="l1">Your business keeps working.</span><span class="l2">Even when you don’t.</span>') ?></h1>
      <p class="lead"><?= tr('אתרים חכמים, אוטומציות ופתרונות דיגיטליים שמתחברים לעסק שלך, וחוסכים לך זמן, עבודה וכאב ראש.', 'Smart websites, automations and digital tools that plug into your business and save you time, work and headaches.') ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, tr('היי שי, אשמח לדבר על העסק שלי', "Hi Shay, I'd like to talk about my business"))) ?>" target="_blank" rel="noopener"><span><?= tr('בואו נדבר על העסק שלכם', "Let's talk about your business") ?></span><?= icon('arrow') ?></a>
      <p class="offer"><?= tr('הודעה קצרה בוואטסאפ מספיקה. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.', "A short WhatsApp message is enough. I'll come back with one idea you can start with. No commitment.") ?></p>
    </div>
    <figure class="h3-art" aria-label="<?= tr('עבודות אמיתיות: החנות fisha.shop, האפליקציה Excerly והצ׳אטבוט Boardog', 'Real work: the fisha.shop store, the Excerly app and the Boardog chatbot') ?>">
      <div class="browser h3-b">
        <div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div>
        <img src="<?= url('assets/img/projects/fisha/tattoos-1.webp') ?>" alt="" width="1600" height="1000" decoding="async" fetchpriority="high">
      </div>
      <div class="device h3-p"><img src="<?= url('assets/img/projects/excerly/session-m.webp') ?>" alt="" width="780" height="1688" decoding="async"></div>
      <div class="device h3-bd"><img src="<?= url('assets/img/projects/boardog/chat-end.webp') ?>" alt="" width="780" height="1690" decoding="async"></div>
      <ul class="h3-why" aria-label="<?= tr('מה הצ׳אטבוט Boardog פותר', 'What the Boardog chatbot solves') ?>">
        <li><?= icon('check') ?><span><?= tr('<b>עונה תוך שניות</b>גם בשתיים בלילה', '<b>Replies in seconds</b>even at 2 a.m.') ?></span></li>
        <li><?= icon('check') ?><span><?= tr('<b>אוסף את כל הפרטים</b>בלי טלפונים חוזרים', '<b>Collects every detail</b>no callbacks needed') ?></span></li>
        <li><?= icon('check') ?><span><?= tr('<b>קובע פגישה לבד</b>ושולח סיכום מסודר', '<b>Books the meeting</b>and sends a clear summary') ?></span></li>
      </ul>
      <figcaption class="h3-cap"><?= tr('עבודות אמיתיות:', 'Real work:') ?> <b lang="en">fisha.shop</b> · <b lang="en">Excerly</b> · <b lang="en">Boardog</b></figcaption>
    </figure>
  </div>
</section>

<section class="statement" aria-labelledby="problem-title">
  <div class="wrap">
    <span class="eyebrow"><?= tr('הבעיה', 'The problem') ?></span>
    <h2 id="problem-title"><?= tr('רוב העסקים מאבדים לקוחות בפער שבין <mark>"מישהו פנה"</mark> ל<mark>"מישהו חזר אליו"</mark>. <em>אני בונה את המערכת שסוגרת את הפער הזה.</em>', 'Most businesses lose customers in the gap between <mark>“someone got in touch”</mark> and <mark>“someone got back to them”</mark>. <em>I build the system that closes that gap.</em>') ?></h2>
  </div>
</section>

<?php
$outcomes = $is_en ? [
    'automations' => 'Less manual work. More time for the business.',
    'websites'    => 'A site that brings leads, not one that just looks nice.',
    'pwa'         => 'Your app, on your customer’s home screen.',
    'seo'         => 'Customers who find you on Google, without paying per click.',
    'campaigns'   => 'Know what brings customers, and stop paying for what doesn’t.',
] : [
    'automations' => 'פחות עבודה ידנית. יותר זמן לעסק.',
    'websites'    => 'אתר שמביא פניות, לא רק נראה טוב.',
    'pwa'         => 'האפליקציה שלך, במסך הבית של הלקוח.',
    'seo'         => 'לקוחות שמוצאים אתכם בגוגל, בלי לשלם על כל קליק.',
    'campaigns'   => 'יודעים מה מביא לקוחות, ומפסיקים לשלם על מה שלא.',
];
?>
<section class="services lite" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('מה אני בונה', 'What I build') ?></span>
        <h2 class="sec" id="services-title"><?= tr('חמישה תחומים. מערכת אחת שעובדת יחד.', 'Five services. One system that works together.') ?></h2>
      </div>
    </div>

    <div class="svc-grid">
      <?php foreach ($services as $i => $s): ?>
        <a class="svc rv" href="<?= e(lurl('services#' . $s['id'])) ?>">
          <h3 class="svc-h"><span class="icon"><?= icon($s['icon']) ?></span><?= e($s['title']) ?></h3>
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
        <span class="eyebrow"><?= tr('תהליך עבודה', 'How it works') ?></span>
        <h2 class="sec" id="process-title"><?= tr('מהשיחה הראשונה<br>ועד שזה <span class="acc">רץ לבד.</span>', 'From the first call<br>to <span class="acc">running on its own.</span>') ?></h2>
      </div>
      <p class="lead"><?= tr('בלי הפתעות באמצע: יודעים מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר.', 'No surprises along the way: you know what gets built, in what order, what it costs and when it goes live.') ?></p>
    </div>
    <div class="steps">
      <?php if ($is_en): ?>
      <div class="step"><div class="n">01</div><h3>Intro call</h3><p>We look at how the business runs today, where time goes and where customers slip away.</p></div>
      <div class="step"><div class="n">02</div><h3>Plan</h3><p>A written plan: what gets built, in what order, what it costs and when it goes live.</p></div>
      <div class="step"><div class="n">03</div><h3>Build and launch</h3><p>Build it, connect it to the tools you already use and test it with real customers before release.</p></div>
      <div class="step"><div class="n">04</div><h3>Support and improve</h3><p>Watch the numbers, improve what can be improved and add the next step.</p></div>
      <?php else: ?>
      <div class="step"><div class="n">01</div><h3>שיחת היכרות</h3><p>מבינים איך העסק עובד היום, איפה הולך זמן ואיפה הולכים לאיבוד לקוחות.</p></div>
      <div class="step"><div class="n">02</div><h3>אפיון ותוכנית</h3><p>תוכנית כתובה: מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר.</p></div>
      <div class="step"><div class="n">03</div><h3>בנייה והטמעה</h3><p>בונים, מחברים למערכות הקיימות ובודקים עם לקוחות אמיתיים לפני שמשחררים.</p></div>
      <div class="step"><div class="n">04</div><h3>ליווי ושיפור</h3><p>עוקבים אחרי הנתונים, משפרים את מה שאפשר ומוסיפים את הצעד הבא.</p></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="work" aria-labelledby="work-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('עבודות אחרונות', 'Recent work') ?></span>
        <h2 class="sec" id="work-title"><?= tr('ההוכחה נמצאת באוויר.', 'The proof is live.') ?></h2>
      </div>
      <a class="btn btn-ink" href="<?= lurl('projects') ?>"><?= tr('לכל הפרויקטים', 'All projects') ?><?= icon('arrow') ?></a>
    </div>
    <div class="proj-grid">
      <?php foreach ($projects as $p): ?>
        <article class="proj big<?= $p['layout'] === 'phones' ? ' rev' : '' ?>">
          <?php if ($p['layout'] === 'phones'): ?>
            <div class="media media-ex">
              <?php foreach ($p['shots'] as $shot): ?>
                <div class="mphone"><img src="<?= e(url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async"></div>
              <?php endforeach; ?>
            </div>
          <?php else: $shot = $p['shots'][0]; ?>
            <div class="media media-fisha">
              <div class="browser">
                <div class="bar"><i></i><i></i><i></i><u></u></div>
                <img src="<?= e(url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async">
              </div>
            </div>
          <?php endif; ?>
          <div class="body">
            <div class="row"><h3 lang="en"><?= e($p['name']) ?></h3><span class="tag acc"><?= e($p['tag']) ?></span></div>
            <p><?= e($p['summary']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="approach" aria-labelledby="about-title">
  <div class="wrap ap-grid">
    <div class="ap-photo rv">
      <img src="<?= url('assets/img/founder.webp') ?>" alt="<?= tr('שי דדון, מייסד SDmarketing', 'Shay Dadon, founder of SDmarketing') ?>" width="1024" height="1024" loading="lazy" decoding="async">
      <div class="cap"><b><?= tr('שי דדון', 'Shay Dadon') ?></b><span><?= tr('מפתח תוכנה, B.Sc. מדעי המחשב, שיווק דיגיטלי', 'Software developer, B.Sc. in Computer Science, digital marketing') ?></span></div>
    </div>
    <div>
      <span class="eyebrow"><?= tr('למה אני', 'Why me') ?></span>
      <h2 class="sec" id="about-title"><?= tr('<span class="count" data-count="15">15</span> שנות ניסיון בטכנולוגיה.<span class="acc">גישה אחת פשוטה: קודם מבינים את הבעיה.</span>', '<span class="count" data-count="15">15</span> years in tech.<span class="acc">One simple approach: understand the problem first.</span>') ?></h2>
      <p class="lead"><?= tr('אני לא מתחיל מקוד, עיצוב או מערכת חדשה. אני מתחיל מהשאלה מה לא עובד בעסק שלך, ואיך אפשר לשנות את זה.', 'I don’t start with code, design or a new system. I start with what isn’t working in your business, and how to change it.') ?></p>
      <ol class="qs">
        <?php if ($is_en): ?>
        <li class="rv"><span>01</span><div><b>Where does the business lose leads?</b>A message nobody answered, a lead nobody called back, an abandoned cart.</div></li>
        <li class="rv"><span>02</span><div><b>What repeats every day?</b>Anything someone does by hand over and over can run on its own.</div></li>
        <li class="rv"><span>03</span><div><b>Which small step pays back the most?</b>Start there, measure it, and only then add the next one.</div></li>
        <?php else: ?>
        <li class="rv"><span>01</span><div><b>איפה העסק מאבד פניות?</b>הודעה שלא נענתה, ליד שלא חזרו אליו, עגלה שננטשה.</div></li>
        <li class="rv"><span>02</span><div><b>מה חוזר על עצמו כל יום?</b>כל מה שמישהו עושה ידנית שוב ושוב יכול לרוץ לבד.</div></li>
        <li class="rv"><span>03</span><div><b>מה הצעד הקטן שיחזיר הכי הרבה?</b>מתחילים ממנו, מודדים, ורק אז מוסיפים את הבא.</div></li>
        <?php endif; ?>
      </ol>
      <div class="vs">
        <div class="a"><h3><?= tr('הדרך הרגילה', 'The usual way') ?></h3><?= tr('שלושה ספקים, שלוש הצעות מחיר, ואתה מתווך ביניהם.', 'Three vendors, three quotes, and you stuck in the middle.') ?></div>
        <div class="b"><h3><?= tr('עם SDmarketing', 'With SDmarketing') ?></h3><?= tr('תוכנית אחת, מחיר אחד, איש קשר אחד.', 'One plan, one price, one contact.') ?></div>
      </div>
      <a class="link" href="<?= lurl('about') ?>"><?= tr('הסיפור המלא', 'The full story') ?> <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php
$faq = $is_en ? [
    [
        'q' => 'I have great products but no way to sell them online.',
        'a' => 'An online store is built around the purchase: catalog, cart, payments and order management, without the visitor getting lost on the way. The same approach works for a campaign landing page or a business site that leads to a conversation. fisha.shop is an example of a live store.',
    ],
    [
        'q' => 'Leads come in on WhatsApp and email, and I can’t get back to all of them.',
        'a' => 'Automation takes what repeats and makes it run on its own: a message, an email or a spreadsheet update. A bot can answer common questions, collect details and book appointments, and the details go into your calendar or sheet without anyone copying them by hand.',
    ],
    [
        'q' => 'I want an app for my customers, without going through the app store.',
        'a' => 'A PWA installs straight from the browser, with no app store, and opens from an icon on the home screen. The same code runs on Android, iPhone and desktop. That is how Excerly was built.',
    ],
    [
        'q' => 'I pay for ads and I can’t tell what actually brings leads.',
        'a' => 'A Google or Meta campaign is measured by leads and sales, not likes. First we make sure every lead is counted, then improve what brings results and stop what doesn’t. You end up with a clear report: what worked and what to change next.',
    ],
    [
        'q' => 'I have a landing page, but it doesn’t bring in leads.',
        'a' => 'A landing page that works is built around one message and one action, so people coming from a campaign leave their details or send a WhatsApp message. We find what stops visitors, sharpen the message and the action, and add tracking so you know where every lead came from.',
    ],
] : [
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
        'q' => 'יש לי דף נחיתה, אבל הוא לא מביא פניות או לידים?',
        'a' => 'דף נחיתה שעובד נבנה סביב מסר אחד ופעולה אחת, כדי שמי שמגיע מקמפיין ישאיר פרטים או יכתוב בוואטסאפ. בודקים מה עוצר את הגולשים, מחדדים את המסר והפעולה, ומחברים מעקב כדי לדעת מאיפה הגיעה כל פנייה.',
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
    <span class="eyebrow"><?= tr('שאלות נפוצות', 'FAQ') ?></span>
    <h2 class="sec" id="faq-title"><?= tr('שאלות שבעלי עסקים שואלים אותי', 'Questions business owners ask me') ?></h2>
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
