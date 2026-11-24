<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'terms';
$page_title   = tr('תקנון ותנאי שימוש | SDmarketing', 'Terms of Use | SDmarketing');
$page_desc    = tr('תנאי השימוש באתר SDmarketing: המידע באתר, פרויקטים ודוגמאות, פניות ויצירת קשר, קניין רוחני ואחריות.', 'The terms of use of the SDmarketing website: the information on the site, projects and examples, inquiries, intellectual property and liability.');
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';

$o   = e($site['owner']);
$bt  = e($site['business_type']);
$bid = e($site['business_id']);
$dom = e($site['domain']);
$mail = e($site['email']);
$u_privacy = e(lurl('privacy'));
$u_contact = e(lurl('contact'));
$city = e($site['city']);

$legal = [
    'title' => 'תקנון ותנאי שימוש',
    'lead'  => 'הכללים לשימוש באתר ובמידע שמופיע בו. כתוב בשפה פשוטה ככל האפשר. ובכל זאת, כדאי לקרוא.',
    'sections' => [
        ['general', 'כללי', <<<HTML
<p>אתר <span dir="ltr">{$dom}</span> ("<b>האתר</b>") מופעל על ידי {$o}, {$bt} מספר {$bid}, הפועל תחת השם SDmarketing ("<b>SDmarketing</b>", "<b>אנחנו</b>").</p>
<p>השימוש באתר, בכל דרך, מהווה הסכמה לתנאים אלה. אם אינך מסכים/ה להם, אנא הימנע/י משימוש באתר.</p>
<p>התקנון מנוסח בלשון זכר מטעמי נוחות בלבד, והוא מתייחס לכל המגדרים באופן שווה.</p>
HTML],
        ['site-content', 'המידע באתר', <<<HTML
<p>האתר מציג מידע כללי על השירותים של SDmarketing: אוטומציות לעסקים, צ'אטבוטים לוואטסאפ, פיתוח אתרים וחנויות, אפליקציות PWA, קידום אורגני וקמפיינים ממומנים.</p>
<p>המידע באתר אינו מהווה הצעה מחייבת, הצעת מחיר או התחייבות לתוצאה מסוימת. היקף העבודה, המחיר ולוחות הזמנים של כל פרויקט נקבעים בהצעת מחיר או בהסכם כתוב נפרד, והם הגוברים על כל האמור באתר.</p>
<p>אנו משתדלים שהמידע באתר יהיה מדויק ועדכני, אך ייתכנו בו טעויות או אי־דיוקים, ואנו רשאים לעדכן אותו בכל עת וללא הודעה מוקדמת.</p>
HTML],
        ['projects', 'פרויקטים ודוגמאות', <<<HTML
<p>הפרויקטים המוצגים בעמוד הפרויקטים הם עבודות שבוצעו בפועל, וצילומי המסך שלהם הם צילומים אמיתיים. ייתכן שהמראה הנוכחי של פרויקט חי שונה מעט מהצילום.</p>
<p>הדגמות המופיעות באתר (שיחת הוואטסאפ, תרשים האוטומציה ודוח הפרסום) מסומנות "הדגמה להמחשה" ואינן מתעדות לקוח, שיחה או נתונים אמיתיים.</p>
<p>הסימנים המסחריים ושמות המותגים של לקוחות שייכים לבעליהם, ומוצגים באתר באישורם או כתיעוד עבודה שבוצעה.</p>
HTML],
        ['contact-form', 'פניות ויצירת קשר', <<<HTML
<p>שליחת פנייה דרך טופס יצירת הקשר, וואטסאפ, טלפון או מייל אינה יוצרת התקשרות או התחייבות מצד כלשהו. היא מאפשרת לנו לחזור אליך ולבדוק התאמה.</p>
<p>יש למסור פרטים נכונים ומלאים. אין לשלוח באמצעות האתר תוכן פוגעני, בלתי חוקי, או מידע רגיש שאינו נחוץ לפנייה.</p>
<p>השימוש בפרטים שנמסרים בפנייה כפוף ל<a href="{$u_privacy}">מדיניות הפרטיות</a>.</p>
HTML],
        ['ip', 'קניין רוחני', <<<HTML
<p>כל הזכויות באתר, לרבות העיצוב, הטקסטים, הלוגו, הגרפיקה, הקוד והמבנה, שייכות ל־SDmarketing או לבעלי הזכויות שהתירו את השימוש בהם.</p>
<p>אין להעתיק, לשכפל, להפיץ, לפרסם או לעשות שימוש מסחרי בתוכן מהאתר ללא אישור מראש ובכתב. מותר לשתף קישורים לעמודי האתר.</p>
<p>הזכויות בתוצרים שנבנים עבור לקוחות במסגרת פרויקט מוסדרות בהסכם הספציפי של אותו פרויקט.</p>
HTML],
        ['links', 'קישורים ושירותי צד שלישי', <<<HTML
<p>האתר כולל קישורים לאתרים ולשירותים של צדדים שלישיים, כגון וואטסאפ, אתרי לקוחות ו־Google Fonts. אין לנו שליטה על התוכן, הזמינות או מדיניות הפרטיות שלהם, והשימוש בהם כפוף לתנאים שלהם.</p>
HTML],
        ['liability', 'אחריות', <<<HTML
<p>האתר מוצע לשימוש כפי שהוא ("<span dir="ltr">AS IS</span>"). איננו מתחייבים שהאתר יפעל ללא הפסקות או תקלות, או שיהיה חסין מפני גישה בלתי מורשית.</p>
<p>במידה המרבית המותרת לפי דין, SDmarketing לא תישא באחריות לנזק ישיר או עקיף שנגרם כתוצאה מהשימוש באתר או מהסתמכות על המידע שבו. האחריות במסגרת פרויקט ששולם עליו מוסדרת בהסכם עם הלקוח.</p>
HTML],
        ['changes', 'שינויים בתקנון', <<<HTML
<p>אנו רשאים לעדכן תקנון זה מעת לעת. הנוסח המחייב הוא הנוסח המפורסם באתר בעת השימוש, ותאריך העדכון האחרון מופיע בראש העמוד.</p>
HTML],
        ['law', 'דין וסמכות שיפוט', <<<HTML
<p>על תקנון זה ועל השימוש באתר יחולו דיני מדינת ישראל בלבד. סמכות השיפוט הייחודית בכל עניין הנוגע לאתר נתונה לבתי המשפט המוסמכים במחוז שבו נמצא העסק ({$city}).</p>
HTML],
        ['contact', 'יצירת קשר', <<<HTML
<p>לשאלות בנוגע לתקנון: {$o}, במייל <a href="mailto:{$mail}" dir="ltr">{$mail}</a>, או דרך <a href="{$u_contact}">עמוד יצירת הקשר</a>.</p>
HTML],
    ],
];

if ($is_en) {
    $o   = 'Shay Dadon';
    $bt  = '[business type]';     // TODO, like the Hebrew placeholders in includes/config.php
    $bid = '[business number]';
    $city = '[city]';
    $legal = [
        'title' => 'Terms of use',
        'lead'  => 'The rules for using this website and the information on it, in language as plain as possible. Still worth reading.',
        'sections' => [
            ['general', 'General', <<<HTML
<p>The website {$dom} (the "<b>Site</b>") is operated by {$o}, {$bt} number {$bid}, trading as SDmarketing ("<b>SDmarketing</b>", "<b>we</b>").</p>
<p>Using the Site in any way means you accept these terms. If you do not accept them, please do not use the Site.</p>
<p>This English text is a translation for convenience. If it differs from the Hebrew version, the Hebrew version prevails.</p>
HTML],
            ['site-content', 'Information on the Site', <<<HTML
<p>The Site gives general information about SDmarketing’s services: business automations, WhatsApp chatbots, websites and online stores, PWA apps, SEO and paid campaigns.</p>
<p>Nothing on the Site is a binding offer, a price quote or a promise of a specific result. The scope, price and timeline of each project are set in a separate quote or written agreement, which takes precedence over anything on the Site.</p>
<p>We try to keep the information accurate and up to date, but it may contain errors, and we may update it at any time without notice.</p>
HTML],
            ['projects', 'Projects and examples', <<<HTML
<p>The projects on the projects page are real work, and their screenshots are real. A live project may look slightly different today than in the screenshot.</p>
<p>The demos on the Site (the WhatsApp conversation, the automation diagram and the ad report) are marked as illustrations and do not show a real customer, conversation or data.</p>
<p>Clients’ trademarks and brand names belong to their owners and are shown with their permission or as a record of work done.</p>
HTML],
            ['contact-form', 'Inquiries and contact', <<<HTML
<p>Sending an inquiry through the contact form, WhatsApp, phone or email does not create an engagement or obligation for anyone. It lets us get back to you and see whether we are a fit.</p>
<p>Please give correct and complete details. Do not send offensive or illegal content through the Site, or sensitive information the inquiry does not need.</p>
<p>The details you send are handled under the <a href="{$u_privacy}">privacy policy</a>.</p>
HTML],
            ['ip', 'Intellectual property', <<<HTML
<p>All rights in the Site, including its design, text, logo, graphics, code and structure, belong to SDmarketing or to the rights holders who allowed their use.</p>
<p>Do not copy, reproduce, distribute, publish or commercially use content from the Site without prior written permission. Sharing links to the Site’s pages is fine.</p>
<p>Rights in work built for clients are set out in the agreement for that project.</p>
HTML],
            ['links', 'Links and third-party services', <<<HTML
<p>The Site links to third-party sites and services such as WhatsApp, client websites and Google Fonts. We have no control over their content, availability or privacy policies, and your use of them is subject to their terms.</p>
HTML],
            ['liability', 'Liability', <<<HTML
<p>The Site is provided "as is". We do not promise that it will run without interruptions or faults, or that it is immune to unauthorized access.</p>
<p>To the fullest extent the law allows, SDmarketing is not liable for any direct or indirect damage caused by using the Site or relying on its information. Liability for paid project work is set out in the agreement with the client.</p>
HTML],
            ['changes', 'Changes to these terms', <<<HTML
<p>We may update these terms from time to time. The binding version is the one published on the Site when you use it, and the date of the last update is shown at the top of the page.</p>
HTML],
            ['law', 'Governing law and jurisdiction', <<<HTML
<p>These terms and the use of the Site are governed by the laws of the State of Israel only. The competent courts in the district where the business is located ({$city}) have exclusive jurisdiction over any matter related to the Site.</p>
HTML],
            ['contact', 'Contact', <<<HTML
<p>Questions about these terms: {$o}, by email at <a href="mailto:{$mail}">{$mail}</a>, or through the <a href="{$u_contact}">contact page</a>.</p>
HTML],
        ],
    ];
}

require __DIR__ . '/includes/legal.php';
require __DIR__ . '/includes/footer.php';
