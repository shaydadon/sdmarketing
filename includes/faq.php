<?php
// Frequently asked questions: shown on the services page (moved from the home page), with FAQPage structured data.
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
        'a' => 'A progressive web app (PWA) installs straight from the browser, no app store required, and opens from an icon on the home screen. One codebase runs on Android, iPhone and desktop. That’s how Excerly, an AI-powered fitness and nutrition app, was built.',
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
        'a' => 'אפליקציית PWA מתקינים ישר מהדפדפן, ללא צורך בחנות האפליקציות, והיא נפתחת עם אייקון במסך הבית. אותו קוד רץ על אנדרואיד, על אייפון ועל מחשב. כך נבנתה Excerly, אפליקציית כושר ותזונה מבוססת AI.',
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
