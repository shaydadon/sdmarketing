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
        'url'       => 'https://fisha.shop',
        'url_label' => 'לאתר החי',
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
