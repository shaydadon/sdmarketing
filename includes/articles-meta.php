<?php
// Shared article metadata: the author, the topics used to filter the list, and Hebrew dates.

$author = [
    'name'  => 'שי דדון',
    'role'  => 'מייסד SDmarketing · פיתוח, SEO, קמפיינים ואוטומציות',
    'photo' => 'assets/img/founder.webp',
    'url'   => 'about.php',
    // Short bio for the "about the author" box at the end of each article.
    'bio'   => 'יותר מ-15 שנה כמפתח תוכנה, עם תואר B.Sc. במדעי המחשב. השלים קורס בשיווק דיגיטלי שכלל SEO וקמפיינים ממומנים, ועובד בשיווק דיגיטלי כבר שנתיים. את האתרים, האוטומציות והקמפיינים שהוא כותב עליהם, הוא בונה ומנהל בעצמו.',
    'job_title' => 'מפתח תוכנה ומשווק דיגיטלי',
];

// Topics follow the service a reader is looking at, not the article format.
$article_topics = [
    'all'         => 'הכל',
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
