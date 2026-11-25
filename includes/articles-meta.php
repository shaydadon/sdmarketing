<?php
// Shared article metadata: the author, the topics used to filter the list, and dates, in both languages.

$author = $is_en ? [
    'name'  => 'Shay Dadon',
    'role'  => 'Founder of SDmarketing · Web development, SEO, paid ads and automation',
    'photo' => 'assets/img/founder.webp',
    'url'   => 'en/about',
    'bio'   => 'Software developer for more than 15 years, with a B.Sc. in Computer Science. He completed a digital marketing course covering SEO and paid advertising, and has worked in digital marketing for two years. He builds and runs the websites, automations and campaigns he writes about himself.',
    'job_title' => 'Software developer and digital marketer',
] : [
    'name'  => 'שי דדון',
    'role'  => 'מייסד SDmarketing · פיתוח, SEO, קמפיינים ואוטומציות',
    'photo' => 'assets/img/founder.webp',
    'url'   => 'about',
    // Short bio for the "about the author" box at the end of each article.
    'bio'   => 'יותר מ-15 שנה כמפתח תוכנה, עם תואר B.Sc. במדעי המחשב. השלים קורס בשיווק דיגיטלי שכלל SEO וקמפיינים ממומנים, ועובד בשיווק דיגיטלי כבר שנתיים. את האתרים, האוטומציות והקמפיינים שהוא כותב עליהם, הוא בונה ומנהל בעצמו.',
    'job_title' => 'מפתח תוכנה ומשווק דיגיטלי',
];

// Topics follow the service a reader is looking at, not the article format.
$article_topics = $is_en ? [
    'all'         => 'All',
    'seo'         => 'SEO',
    'automations' => 'Automation and chatbots',
    'websites'    => 'Websites and landing pages',
    'pwa'         => 'Apps',
    'campaigns'   => 'Ads and measurement',
] : [
    'all'         => 'הכל',
    'seo'         => 'קידום אורגני',
    'automations' => 'אוטומציות וצ׳אטבוטים',
    'websites'    => 'אתרים ודפי נחיתה',
    'pwa'         => 'אפליקציות',
    'campaigns'   => 'קמפיינים ומדידה',
];

function he_date(string $iso): string
{
    $months = ['ינואר', 'פברואר', 'מרץ', 'אפריל', 'מאי', 'יוני', 'יולי', 'אוגוסט', 'ספטמבר', 'אוקטובר', 'נובמבר', 'דצמבר'];
    $t = strtotime($iso);
    if (!$t) {
        return '';
    }
    return (int) date('j', $t) . ' ב' . $months[(int) date('n', $t) - 1] . ' ' . date('Y', $t);
}

/** The article date in the page's language: "25 בנובמבר 2026" or "November 25, 2026". */
function article_date(string $iso): string
{
    if (($GLOBALS['lang'] ?? 'he') !== 'en') {
        return he_date($iso);
    }
    $t = strtotime($iso);
    return $t ? date('F j, Y', $t) : '';
}
