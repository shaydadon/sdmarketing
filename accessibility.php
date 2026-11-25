<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'accessibility';
$page_title   = tr('הצהרת נגישות | SDmarketing', 'Accessibility Statement | SDmarketing');
$page_desc    = tr('הצהרת הנגישות של אתר SDmarketing: מה הונגש, מה עדיין בטיפול, ואיך פונים לרכז הנגישות.', 'The SDmarketing accessibility statement: what has been made accessible, what is still in progress, and how to reach the accessibility coordinator.');
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';

$o     = e($site['owner']);
$mail  = e($site['email']);
$phone = e($site['phone']);
$tel   = e(preg_replace('/\D/', '', $site['phone']));
$date  = e($site['legal_updated_display']);

$legal = [
    'title' => 'הצהרת נגישות',
    'lead'  => 'האתר נבנה כך שכל אחד יוכל להשתמש בו: עם מקלדת, עם קורא מסך, בטלפון או במחשב.',
    'sections' => [
        ['commitment', 'המחויבות שלנו', <<<HTML
<p>SDmarketing רואה חשיבות במתן שירות שוויוני לכל הגולשים, כולל אנשים עם מוגבלות. האתר נבנה מתוך כוונה לעמוד בדרישות תקנות שוויון זכויות לאנשים עם מוגבלות (התאמות נגישות לשירות), התשע"ג-2013, ובתקן הישראלי ת"י 5568 המבוסס על הנחיות <span dir="ltr">WCAG 2.0</span> ברמה <span dir="ltr">AA</span>.</p>
HTML],
        ['done', 'מה הונגש באתר', <<<HTML
<ul>
  <li>ניווט מלא באמצעות מקלדת, עם סימון ברור של הרכיב שבפוקוס.</li>
  <li>קישור "דילוג לתוכן" בתחילת כל עמוד.</li>
  <li>מבנה כותרות היררכי, אזורי ניווט מסומנים וסימון העמוד הנוכחי בתפריט.</li>
  <li>טקסט חלופי לתמונות בעלות משמעות; רכיבים דקורטיביים מוסתרים מקוראי מסך.</li>
  <li>ניגודיות צבעים מספקת בין טקסט לרקע.</li>
  <li>תמיכה מלאה בכתיבה מימין לשמאל, ותצוגה מותאמת לטלפונים ולמסכים בכל גודל.</li>
  <li>טפסים עם תוויות ברורות, סימון שדות חובה והודעות שגיאה בעברית שמוקראות לקוראי מסך.</li>
  <li>כיבוד הגדרת "הפחתת תנועה" של מערכת ההפעלה: אנימציות מושבתות למי שביקש זאת.</li>
  <li>אפשרות להגדיל את הטקסט בעזרת הדפדפן (Ctrl ו־+) בלי לשבור את העמוד.</li>
</ul>
HTML],
        ['browsers', 'דפדפנים ותוכנות נתמכות', <<<HTML
<p>האתר נבדק ומותאם לגרסאות העדכניות של Chrome, Edge, Firefox ו־Safari, במחשב ובטלפון. מומלץ להשתמש בגרסה עדכנית של הדפדפן לחוויה הנגישה ביותר.</p>
HTML],
        ['limits', 'מגבלות ידועות', <<<HTML
<p>למרות המאמצים, ייתכן שחלקים מסוימים באתר עדיין אינם נגישים במלואם. בפרט:</p>
<ul>
  <li>צילומי המסך בעמוד הפרויקטים הם צילומים אמיתיים, והתוכן שלהם מתואר גם בטקסט שלצידם. הדגמות אחרות (תרשים האוטומציה ודוח הפרסום) מסומנות "הדגמה להמחשה".</li>
  <li>אתרים חיצוניים שאליהם מקשר האתר (כגון אתרי לקוחות ווואטסאפ) אינם באחריותנו, ורמת הנגישות שלהם עשויה להשתנות.</li>
</ul>
<p>אם נתקלתם בבעיה, נשמח שתספרו לנו, ונטפל בה בהקדם.</p>
HTML],
        ['coordinator', 'רכז הנגישות ופניות', <<<HTML
<p>נתקלתם בקושי? יש לכם הצעה לשיפור? אפשר לפנות לרכז הנגישות:</p>
<ul class="legal-card">
  <li><b>שם:</b> {$o}</li>
  <li><b>טלפון:</b> <a href="tel:{$tel}" dir="ltr">{$phone}</a></li>
  <li><b>מייל:</b> <a href="mailto:{$mail}" dir="ltr">{$mail}</a></li>
</ul>
<p>כדי שנוכל לטפל בפנייה במהירות, מומלץ לציין את העמוד שבו נתקלתם בבעיה, תיאור קצר שלה, ואת הדפדפן או הטכנולוגיה המסייעת שבה השתמשתם.</p>
HTML],
        ['date', 'עדכון ההצהרה', <<<HTML
<p>הצהרת נגישות זו עודכנה בתאריך {$date}.</p>
HTML],
    ],
];

if ($is_en) {
    $o = 'Shay Dadon';
    $phone = e($site['phone_display']);
    $legal = [
        'title' => 'Accessibility statement',
        'lead'  => 'The site is built so everyone can use it: with a keyboard, with a screen reader, on a phone or on a computer.',
        'sections' => [
            ['commitment', 'Our commitment', <<<HTML
<p>SDmarketing cares about giving every visitor equal service, including people with disabilities. The site was built to meet the Israeli Equal Rights for Persons with Disabilities (Service Accessibility Adjustments) Regulations, 5773-2013, and Israeli Standard 5568, which is based on the WCAG 2.0 guidelines at level AA.</p>
HTML],
            ['done', 'What has been made accessible', <<<HTML
<ul>
  <li>Full keyboard navigation, with a clear outline on the focused element.</li>
  <li>A "Skip to content" link at the top of every page.</li>
  <li>A clear heading structure, labeled navigation areas and the current page marked in the menu.</li>
  <li>Text alternatives for meaningful images; decorative elements are hidden from screen readers.</li>
  <li>Enough color contrast between text and background.</li>
  <li>Full support for left-to-right (English) and right-to-left (Hebrew) text, and layouts that fit phones and screens of every size.</li>
  <li>Forms with clear labels, marked required fields and error messages that screen readers announce.</li>
  <li>Respect for the operating system’s "reduce motion" setting: animations are turned off for people who ask for it.</li>
  <li>Text can be enlarged with the browser (Ctrl and +) without breaking the page.</li>
</ul>
HTML],
            ['browsers', 'Supported browsers and software', <<<HTML
<p>The site was tested on current versions of Chrome, Edge, Firefox and Safari, on computers and phones. For the most accessible experience, use an up-to-date browser.</p>
HTML],
            ['limits', 'Known limitations', <<<HTML
<p>Despite our efforts, some parts of the site may not be fully accessible yet. In particular:</p>
<ul>
  <li>The screenshots on the projects page are real, and their content is also described in the text next to them. Other demos (the automation diagram and the ad report) are marked as illustrations.</li>
  <li>Some demos and screenshots show Hebrew content.</li>
  <li>External sites the site links to (such as client sites and WhatsApp) are not under our control, and their accessibility may vary.</li>
</ul>
<p>If you run into a problem, please let us know and we will fix it as soon as we can.</p>
HTML],
            ['coordinator', 'Accessibility coordinator and contact', <<<HTML
<p>Ran into a difficulty? Have a suggestion? You can reach the accessibility coordinator:</p>
<ul class="legal-card">
  <li><b>Name:</b> {$o}</li>
  <li><b>Phone:</b> <a href="tel:{$tel}">{$phone}</a></li>
  <li><b>Email:</b> <a href="mailto:{$mail}">{$mail}</a></li>
</ul>
<p>To help us handle it quickly, please mention the page where you found the problem, a short description of it, and the browser or assistive technology you used.</p>
HTML],
            ['date', 'Statement updated', <<<HTML
<p>This accessibility statement was last updated on {$date}.</p>
HTML],
        ],
    ];
}

require __DIR__ . '/includes/legal.php';
require __DIR__ . '/includes/footer.php';
