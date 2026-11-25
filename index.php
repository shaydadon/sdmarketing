<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'index';
$page_title   = tr('צ׳אטבוט לוואטסאפ, אוטומציות ואתרים לעסקים | SDmarketing', 'WhatsApp Chatbots & Business Automation | SDmarketing');
$page_desc    = tr('צ׳אטבוט לוואטסאפ, אוטומציות לעסקים, בניית אתרים וחנויות, אפליקציות PWA, קידום אורגני וקמפיינים ממומנים. הכל מחובר, ואדם אחד אחראי על כולו.', 'WhatsApp chatbots, business automation, web development, PWA apps, SEO and Google Ads management, built as one connected system by one specialist.');
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/projects-data.php';

?>

<section class="h3ro" aria-labelledby="hero-title">
  <div class="wrap h3-grid">
    <div class="h3-text hero-in">
      <span class="eyebrow"><?= tr('שי דדון · טכנולוגיה, אוטומציות ושיווק', 'Shay Dadon · Developer, automation & marketing') ?></span>
      <h1 id="hero-title"><?= tr('<span class="l1">העסק שלכם ממשיך לעבוד.</span><span class="l2">גם כשאתם לא.</span>', '<span class="l1">Your business keeps working.</span><span class="l2">Even when you’re not.</span>') ?></h1>
      <p class="lead"><?= tr('אתרים, אוטומציות וכלים דיגיטליים שמתחברים למערכות של העסק שלכם וחוסכים לכם זמן ועבודה.', 'Websites, automations and digital tools that connect to the systems your business already uses and save you time and work.') ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, tr('היי שי, אשמח לדבר על העסק שלי', "Hi Shay, I'd like to talk about my business"))) ?>" target="_blank" rel="noopener"><span><?= tr('בואו נדבר על העסק שלכם', 'Let’s talk about your business') ?></span><?= icon('arrow') ?></a>
      <p class="offer"><?= tr('הודעה קצרה בוואטסאפ מספיקה. אחזור עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.', 'A quick WhatsApp message is all it takes. I’ll reply with one concrete idea you can start with, no strings attached.') ?></p>
    </div>
    <figure class="h3-art" aria-label="<?= tr('עבודות אמיתיות: החנות fisha.shop, האפליקציה Excerly והצ׳אטבוט Boardog', 'Live projects: the fisha.shop online store, the Excerly app and the Boardog chatbot') ?>">
      <div class="browser h3-b">
        <div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div>
        <img src="<?= url('assets/img/projects/fisha/tattoos-1.webp') ?>" alt="" width="1600" height="1000" decoding="async" fetchpriority="high">
      </div>
      <div class="device h3-p"><img src="<?= url('assets/img/projects/excerly/session-m.webp') ?>" alt="" width="780" height="1688" decoding="async"></div>
      <div class="device h3-bd"><img src="<?= url('assets/img/projects/boardog/chat-end.webp') ?>" alt="" width="780" height="1690" decoding="async"></div>
      <ul class="h3-why" aria-label="<?= tr('מה הצ׳אטבוט Boardog פותר', 'What the Boardog chatbot solves') ?>">
        <li><?= icon('check') ?><span><?= tr('<b>עונה תוך שניות</b>גם בשתיים בלילה', '<b>Replies in seconds</b>even at 2 a.m.') ?></span></li>
        <li><?= icon('check') ?><span><?= tr('<b>אוסף את כל הפרטים</b>בלי טלפונים חוזרים', '<b>Captures every detail</b>no phone tag') ?></span></li>
        <li><?= icon('check') ?><span><?= tr('<b>קובע פגישה לבד</b>ושולח סיכום מסודר', '<b>Books the meeting</b>and sends a tidy summary') ?></span></li>
      </ul>
      <figcaption class="h3-cap"><?= tr('עבודות אמיתיות:', 'Live projects:') ?> <b lang="en">fisha.shop</b> · <b lang="en">Excerly</b> · <b lang="en">Boardog</b></figcaption>
    </figure>
  </div>
</section>

<section class="statement" aria-labelledby="problem-title">
  <div class="wrap">
    <span class="eyebrow"><?= tr('הבעיה', 'The problem') ?></span>
    <h2 id="problem-title"><?= tr('עסקים רבים מאבדים לקוחות בפער שבין <mark>"מישהו פנה"</mark> ל<mark>"מישהו חזר אליו"</mark>. <em>אני בונה את המערכת שסוגרת את הפער הזה.</em>', 'Many businesses lose customers in the gap between <mark>“someone reached out”</mark> and <mark>“someone got back to them.”</mark> <em>I build the system that closes that gap.</em>') ?></h2>
  </div>
</section>

<section class="services lite" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('מה אני בונה', 'What I build') ?></span>
        <h2 class="sec" id="services-title"><?= tr('חמישה שירותים שבנויים לעבוד יחד.', 'Five services built to work together.') ?></h2>
      </div>
    </div>

    <div class="svc-grid">
      <?php foreach ($services as $i => $s): ?>
        <a class="svc rv" href="<?= e(lurl('services#' . $s['id'])) ?>">
          <h3 class="svc-h"><span class="icon"><?= icon($s['icon']) ?></span><?= e($s['title']) ?></h3>
          <p class="d"><?= e($s['lead']) ?></p>
          <p class="out"><?= tr('לפרטים על השירות', 'More about this service') ?><?= icon('arrow') ?></p>
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
        <h2 class="sec" id="process-title"><?= tr('מהשיחה הראשונה<br>ועד שזה <span class="acc">רץ לבד.</span>', 'From the first call<br>to <span class="acc">running on autopilot.</span>') ?></h2>
      </div>
    </div>
    <div class="steps">
      <?php if ($is_en): ?>
      <div class="step"><div class="n">01</div><h3>Discovery call</h3><p>We map how your business runs today, where time is wasted and where leads slip through the cracks.</p></div>
      <div class="step"><div class="n">02</div><h3>Plan and proposal</h3><p>A written plan covering the scope, the order of work, the cost and the launch date.</p></div>
      <div class="step"><div class="n">03</div><h3>Build and integrate</h3><p>I build it, connect it to the tools you already use and test it with real customers before launch.</p></div>
      <div class="step"><div class="n">04</div><h3>Support and optimize</h3><p>I track the numbers, refine what works and add the next step.</p></div>
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
        <h2 class="sec" id="work-title"><?= tr('פרויקטים שאפשר להיכנס אליהם עכשיו.', 'Projects you can open and try today.') ?></h2>
      </div>
      <a class="btn btn-ink" href="<?= lurl('projects') ?>"><?= tr('לכל הפרויקטים', 'View all projects') ?><?= icon('arrow') ?></a>
    </div>
    <?php
    // The home page also shows the Boardog chatbot demo (on the projects page it is its own section, includes/wa-demo.php).
    $home_projects = $projects;
    $home_projects[] = [
        'name'    => 'Boardog',
        'tag'     => tr('צ׳אטבוט לוואטסאפ · הדגמה', 'WhatsApp chatbot · Demo'),
        'summary' => tr('צ׳אטבוט לוואטסאפ שמקבל פנייה, אוסף את הפרטים וקובע פגישה לבד.', 'A WhatsApp chatbot that handles a new inquiry, collects the details and books the meeting on its own.'),
        'layout'  => 'phones',
        'shots'   => [
            ['src' => 'assets/img/projects/boardog/chat-top.webp', 'alt' => tr('תחילת שיחה עם הצ׳אטבוט Boardog בוואטסאפ', 'The start of a WhatsApp conversation with the Boardog chatbot'), 'w' => 780, 'h' => 1690],
            ['src' => 'assets/img/projects/boardog/chat-end.webp', 'alt' => tr('הצ׳אטבוט Boardog קובע פגישה ושולח סיכום', 'The Boardog chatbot books a meeting and sends a summary'), 'w' => 780, 'h' => 1690],
        ],
    ];
    ?>
    <div class="proj-grid" data-carousel id="home-projects" tabindex="0" role="region" aria-label="<?= tr('פרויקטים, אפשר לגלול הצידה', 'Projects, scrollable') ?>">
      <?php foreach ($home_projects as $n => $p): ?>
        <article class="proj big<?= $p['layout'] === 'phones' ? ' rev' : '' ?><?= $n % 2 === 0 && $p['layout'] === 'phones' ? ' flip' : '' ?>">
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
    <div class="proj-dots" role="group" aria-label="<?= tr('מעבר בין הפרויקטים', 'Move between projects') ?>" data-carousel-dots="home-projects">
      <?php foreach ($home_projects as $i => $p): ?>
        <button type="button" aria-controls="home-projects" aria-label="<?= e(tr('פרויקט ' . ($i + 1) . ' מתוך ' . count($home_projects) . ': ', 'Project ' . ($i + 1) . ' of ' . count($home_projects) . ': ') . $p['name']) ?>"<?= $i === 0 ? ' aria-current="true"' : '' ?>></button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="approach" aria-labelledby="about-title">
  <div class="wrap ap-grid">
    <div class="ap-photo rv">
      <img src="<?= url('assets/img/founder.webp') ?>" alt="<?= tr('שי דדון, מייסד SDmarketing', 'Shay Dadon, founder of SDmarketing') ?>" width="1024" height="1024" loading="lazy" decoding="async">
      <div class="cap"><b><?= tr('שי דדון', 'Shay Dadon') ?></b><span><?= tr('מפתח תוכנה, B.Sc. מדעי המחשב, שיווק&nbsp;דיגיטלי', 'Software developer · B.Sc. Computer Science · Digital marketing') ?></span></div>
    </div>
    <div>
      <span class="eyebrow"><?= tr('למה אני', 'Why work with me') ?></span>
      <h2 class="sec" id="about-title"><?= tr('<span class="count" data-count="15">15</span>+ שנות ניסיון בטכנולוגיה.<span class="acc">קודם מבינים את הבעיה.</span>', '<span class="count" data-count="15">15</span>+ years in tech.<span class="acc">The problem comes first.</span>') ?></h2>
      <p class="lead"><?= tr('רק אחרי שברור מה לא עובד בעסק שלכם, אני בוחר קוד, עיצוב או מערכת.', 'Only once it’s clear what isn’t working in your business do I choose the code, the design or the tools.') ?></p>
      <ol class="qs">
        <?php if ($is_en): ?>
        <li class="rv"><span>01</span><div><b>Where are you losing leads?</b>An unanswered message, a lead nobody followed up on, an abandoned cart.</div></li>
        <li class="rv"><span>02</span><div><b>What do you repeat every day?</b>Anything done by hand over and over can run on its own.</div></li>
        <li class="rv"><span>03</span><div><b>Which small step pays off the most?</b>We start there, measure the results, then add the next one.</div></li>
        <?php else: ?>
        <li class="rv"><span>01</span><div><b>איפה העסק מאבד פניות?</b>הודעה שלא נענתה, ליד שלא חזרו אליו, עגלה שננטשה.</div></li>
        <li class="rv"><span>02</span><div><b>מה חוזר על עצמו כל יום?</b>כל מה שמישהו עושה ידנית שוב ושוב יכול לרוץ לבד.</div></li>
        <li class="rv"><span>03</span><div><b>מה הצעד הקטן שיחזיר הכי הרבה?</b>מתחילים ממנו, מודדים, ורק אז מוסיפים את הבא.</div></li>
        <?php endif; ?>
      </ol>
      <a class="link" href="<?= lurl('about') ?>"><?= tr('הסיפור המלא', 'Read my story') ?> <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php if (!$is_en):
  // Latest guides, newest first (Hebrew only: most articles have no English version yet)
  require __DIR__ . '/includes/articles-data.php';
  $latest = $articles;
  usort($latest, fn($a, $b) => strcmp($b['published'], $a['published']));
  $latest = array_slice($latest, 0, 3); ?>
<section class="home-posts" aria-labelledby="posts-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow">מהבלוג</span>
        <h2 class="sec" id="posts-title">מדריכים קצרים לבעלי עסקים</h2>
      </div>
      <a class="btn btn-ink" href="<?= url('articles') ?>">לכל המאמרים<?= icon('arrow') ?></a>
    </div>
    <ul class="hp-grid">
      <?php foreach ($latest as $a): ?>
        <li class="rv"><a class="hp-card" href="<?= e(url('articles/' . $a['slug'])) ?>">
          <img src="<?= e(url($a['image'])) ?>" alt="" width="1200" height="630" loading="lazy" decoding="async">
          <span class="hp-meta"><?= e($a['type']) ?> · <?= (int) $a['minutes'] ?> דקות קריאה</span>
          <h3><?= e($a['title']) ?></h3>
        </a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>

<?php
$faq = $is_en ? [
    [
        'q' => 'I have great products, but no way to sell them online.',
        'a' => 'An online store is built around the purchase: product catalog, cart, secure checkout and order management, so shoppers never get lost along the way. The same approach works for a campaign landing page or a business website designed to start conversations. fisha.shop is a live example.',
    ],
    [
        'q' => 'Leads come in on WhatsApp and email, and I can’t keep up.',
        'a' => 'Automation takes the repetitive work off your plate: messages, emails and spreadsheet updates run on their own. A WhatsApp chatbot can answer common questions, collect details and book appointments, then send everything straight to your calendar or CRM, with no copying and pasting.',
    ],
    [
        'q' => 'I want an app for my customers, without going through the App Store.',
        'a' => 'A progressive web app (PWA) installs straight from the browser, no app store required, and opens from an icon on the home screen. One codebase runs on Android, iPhone and desktop. That’s how Excerly was built.',
    ],
    [
        'q' => 'I’m paying for ads, but I can’t tell what actually brings in leads.',
        'a' => 'Google Ads and Meta campaigns should be measured in leads and sales, not likes. First we set up conversion tracking so every lead is counted, then we scale what works and cut what doesn’t. You get a clear report on what worked and what to change next.',
    ],
    [
        'q' => 'I have a landing page, but it isn’t generating leads.',
        'a' => 'A high-converting landing page is built around one message and one action, so visitors from your campaign leave their details or start a WhatsApp chat. We find what’s holding visitors back, sharpen the message and the call to action, and add tracking so you know where every lead came from.',
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
