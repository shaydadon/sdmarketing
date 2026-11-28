<?php
// English copy of includes/projects-data.php. Keep slugs, layouts and shots in step with the Hebrew file.
$projects = [
    [
        'slug'      => 'fisha',
        'name'      => 'fisha.shop',
        'cat'       => 'web',
        'tag'       => 'E-commerce store',
        'summary'   => 'A live online store that takes real orders: design, development, order management and secure checkout.',
        'url'       => 'https://dev.fisha.shop/shop-2/',
        'url_label' => 'Visit the live site',
        'challenge' => 'Bring products, original artwork and tattoo designs together in one store that sells online.',
        'built'     => ['A catalog filtered by type, size and price', 'Shopping cart and secure checkout', 'Order management', 'Fisha Studio: a back office where the owner adds products, variants and sizes and manages stock, with two-factor sign-in'],
        'show_link' => false,   // the new design is still on the dev site; link to the live site once it launches
        'service'   => ['websites', 'See web development'],
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
        'summary'   => 'An AI-powered fitness and nutrition app that installs straight from the browser and feels just like a native app.',
        'url'       => 'https://shaydadon.github.io/Excerly/',
        'url_label' => 'Open the app',
        'challenge' => 'Keep workouts and nutrition in one place on the phone, without downloading anything from an app store.',
        'built'     => ['A daily screen with today’s workout and meals', 'A workout library and guided sessions', 'AI-powered nutrition tracking'],
        'show_link' => true,
        'service'   => ['pwa', 'See PWA apps'],
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
