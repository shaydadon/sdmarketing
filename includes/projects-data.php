<?php
// Projects shown on the homepage and projects.php.
// Real screenshots: drop a full-page capture at assets/img/projects/<slug>.jpg (or .png / .webp)
// and it replaces the drawn mock screen automatically. Desktop sites: ~1440px wide. PWAs: ~390px wide.
// TODO: confirm the Excerly / Boardog descriptions and add their links.
$projects = [
    [
        'slug'    => 'fisha',
        'name'    => 'fisha.shop',
        'cat'     => 'web',
        'type'    => 'חנות אונליין',
        'device'  => 'laptop',
        'desc'    => 'חנות אונליין למותג האמנות Fisha: דמות שעוברת בין ציורים, בובות, קרמיקה וטקסטיל.',
        'long'    => 'Fisha היא דמות שמשנה צורה כל הזמן: מציורים לבובות, מקרמיקה לטקסטיל. החנות נבנתה כדי שהעולם הזה ירגיש שלם גם אונליין, עם סיפור המותג במרכז, וקטגוריות שמובילות ישר לקנייה.',
        'built'   => ['חנות מלאה עם קטלוג ועגלת קניות', 'שלוש קטגוריות: Wearables, Collectibles, Originals', 'דף סיפור המותג, אודות ויצירת קשר', 'אזור אישי ללקוחות, תקנון ומדיניות'],
        'tags'    => ['E-commerce', 'Responsive', 'Branding'],
        'url'     => 'https://fisha.shop',
        'screen'  => 'shop',
    ],
    [
        'slug'    => 'excerly',
        'name'    => 'Excerly',
        'cat'     => 'pwa',
        'type'    => 'אפליקציית PWA',
        'device'  => 'phone',
        'desc'    => 'אפליקציית ווב שמותקנת על הטלפון ועובדת כמו אפליקציה רגילה.',
        'long'    => 'Excerly נבנתה כ־PWA: המשתמשים מתקינים אותה ישר מהדפדפן, היא נפתחת במסך מלא עם אייקון משלה, ואותו קוד רץ על אנדרואיד, אייפון ומחשב.',
        'built'   => ['התקנה מהדפדפן למסך הבית', 'ממשק מותאם מובייל', 'קוד אחד לכל המכשירים'],
        'tags'    => ['PWA', 'Mobile-first'],
        'url'     => '',
        'screen'  => 'app',
    ],
    [
        'slug'    => 'boardog',
        'name'    => 'Boardog',
        'cat'     => 'pwa',
        'type'    => 'אפליקציית PWA',
        'device'  => 'phone',
        'desc'    => 'אפליקציית ווב מותקנת, עם ממשק מותאם למובייל.',
        'long'    => 'Boardog היא אפליקציית PWA: מתקינים אותה בלחיצה מהדפדפן, בלי חנות אפליקציות, והיא מתנהגת כמו כל אפליקציה אחרת בטלפון.',
        'built'   => ['התקנה מהדפדפן למסך הבית', 'ממשק מותאם מובייל', 'קוד אחד לכל המכשירים'],
        'tags'    => ['PWA', 'Mobile-first'],
        'url'     => '',
        'screen'  => 'app',
    ],
];

$project_cats = [
    'all' => 'הכל',
    'web' => 'אתרים וחנויות',
    'pwa' => 'אפליקציות PWA',
];

function project_screenshot(string $slug): ?string
{
    foreach (['jpg', 'png', 'webp'] as $ext) {
        $rel = "assets/img/projects/$slug.$ext";
        if (is_file(__DIR__ . '/../' . $rel)) return $rel;
    }
    return null;
}
