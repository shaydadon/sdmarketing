<?php
// English copy of includes/projects-data.php. Keep slugs, layouts and shots in step with the Hebrew file.
$projects = [
    [
        'slug'      => 'fisha',
        'name'      => 'fisha.shop',
        'cat'       => 'web',
        'tag'       => 'E-commerce store',
        'summary'   => 'A live online store that takes real orders: design, development, order management and secure checkout.',
        'url'       => 'https://fisha.shop',
        'url_label' => 'Visit the live site',
        'layout'    => 'browser',
        'shots'     => [
            ['src' => 'assets/img/projects/fisha/shop-hq-c.webp', 'alt' => 'Screenshot of the fisha.shop store', 'w' => 1600, 'h' => 929, 'chrome' => 'fisha.shop'],
        ],
    ],
    [
        'slug'      => 'excerly',
        'name'      => 'Excerly',
        'cat'       => 'pwa',
        'tag'       => 'Progressive web app (PWA)',
        'summary'   => 'A web app that installs straight from the browser and feels just like a native app.',
        'url'       => 'https://shaydadon.github.io/Excerly/',
        'url_label' => 'Open the app',
        'layout'    => 'phones',
        'shots'     => [
            ['src' => 'assets/img/projects/excerly/home-m.webp', 'alt' => 'Screenshot of the Excerly app', 'w' => 780, 'h' => 1688],
            ['src' => 'assets/img/projects/excerly/workouts-m.webp', 'alt' => 'Another screenshot of the Excerly app', 'w' => 780, 'h' => 1688],
        ],
    ],
];

$project_cats = [
    'all' => 'All',
    'web' => 'Websites & stores',
    'pwa' => 'PWA apps',
    'automations' => 'Automation',
];

$extra_cases = ['automations' => 1];

$projects_soon = 'Coming soon: landing pages and business websites';
