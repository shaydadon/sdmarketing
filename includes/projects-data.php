<?php
if (($GLOBALS['lang'] ?? 'he') === 'en') { require __DIR__ . '/en/projects-data.php'; return; }
// Portfolio examples. To add one, append an item:
//   layout "browser" for a site or store, "phones" for an app.
//   cat: web, pwa, landing, brochure.
// Shots are real screenshots only. Copy stays short: what kind of work it is,
// not a tour of the client's product.
$projects = [
    [
        'slug'      => 'fisha',
        'name'      => 'fisha.shop',
        'cat'       => 'web',
        'tag'       => 'חנות אונליין / E-commerce',
        'summary'   => 'חנות אונליין שמוכרת בפועל: עיצוב, פיתוח, ניהול הזמנות וסליקה.',
        'url'       => 'https://dev.fisha.shop/shop-2/',
        'url_label' => 'לאתר החי',
        'challenge' => 'לרכז מוצרים, יצירות מקור וקעקועים בחנות אחת שמוכרת אונליין.',
        'built'     => ['קטלוג עם סינון לפי סוג, גודל ומחיר', 'עגלת קניות וסליקה מאובטחת', 'ניהול הזמנות', 'Fisha Studio: מערכת ניהול שבה בעלת החנות מוסיפה מוצרים, גרסאות ומידות ומנהלת מלאי, עם התחברות דו-שלבית'],
        'show_link' => false,   // the new design is still on the dev site; link to the live site once it launches
        'service'   => ['websites', 'לשירות בניית אתרים וחנויות'],
        'layout'    => 'browser',
        'shots'     => [
            ['src' => 'assets/img/projects/fisha/shop-hq-c.webp', 'alt' => 'צילום מסך של החנות fisha.shop', 'w' => 1600, 'h' => 929, 'chrome' => 'fisha.shop'],
        ],
    ],
    [
        'slug'      => 'excerly',
        'name'      => 'Excerly',
        'cat'       => 'pwa',
        'tag'       => 'אפליקציית PWA',
        'summary'   => 'אפליקציית כושר ותזונה מבוססת AI, שמתקינים מהדפדפן ונפתחת כמו אפליקציה.',
        'url'       => 'https://shaydadon.github.io/Excerly/',
        'url_label' => 'לאפליקציה',
        'challenge' => 'לנהל אימונים ותזונה במקום אחד בטלפון, בלי להוריד אפליקציה מהחנות.',
        'built'     => ['מסך יומי עם האימון והתזונה של היום', 'ספריית אימונים ומסך אימון מודרך', 'מעקב תזונה מבוסס AI'],
        'show_link' => true,
        'service'   => ['pwa', 'לשירות אפליקציות PWA'],
        'layout'    => 'phones',
        'shots'     => [
            ['src' => 'assets/img/projects/excerly/home-m.webp', 'alt' => 'צילום מסך של האפליקציה Excerly', 'w' => 780, 'h' => 1688],
            ['src' => 'assets/img/projects/excerly/workouts-m.webp', 'alt' => 'צילום מסך נוסף של האפליקציה Excerly', 'w' => 780, 'h' => 1688],
        ],
    ],
];

$project_cats = [
    'all' => 'הכל',
    'web' => 'אתרים וחנויות',
    'pwa' => 'אפליקציות PWA',
    'automations' => 'אוטומציות לעסקים',
];

// Cases shown on the projects page that are not in $projects (the Boardog WhatsApp chatbot, includes/wa-demo.php).
$extra_cases = ['automations' => 1];

$projects_soon = 'בקרוב: דפי נחיתה ואתרי תדמית';
