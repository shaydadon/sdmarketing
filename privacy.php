<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'privacy';
$page_title   = tr('מדיניות פרטיות | SDmarketing', 'Privacy Policy | SDmarketing');
$page_desc    = tr('מדיניות הפרטיות של SDmarketing: איזה מידע נאסף באתר ובטופס יצירת הקשר, למה הוא משמש, איך הוא נשמר, ומה הזכויות שלכם.', 'The SDmarketing privacy policy: what information the site and the contact form collect, what it is used for, how it is kept, and your rights.');
$header_theme = 'dark';
require __DIR__ . '/includes/header.php';

$o    = e($site['owner']);
$bt   = e($site['business_type']);
$bid  = e($site['business_id']);
$reg  = ($bt && $bid) ? ", {$bt} מספר {$bid}" : '';   // only once registered (includes/config.php)
$dom  = e($site['domain']);
$mail = e($site['email']);

$legal = [
    'title' => 'מדיניות פרטיות',
    'lead'  => 'איזה מידע נאסף כשאתם משתמשים באתר, למה הוא נחוץ, איך הוא נשמר, ומה הזכויות שלכם.',
    'sections' => [
        ['who', 'מי אחראי על המידע', <<<HTML
<p>האתר <span dir="ltr">{$dom}</span> מופעל על ידי {$o}{$reg}, תחת השם SDmarketing. {$o} הוא האחראי על המידע הנאסף באתר (בעל מאגר המידע).</p>
<p>מדיניות זו נכתבה בהתאם לחוק הגנת הפרטיות, התשמ"א-1981 ולתקנות שהותקנו מכוחו.</p>
HTML],
        ['what', 'איזה מידע נאסף', <<<HTML
<p><b>מידע שאתם מוסרים בטופס יצירת הקשר:</b> שם, מספר טלפון, כתובת מייל (לא חובה), תחום השירות שמעניין אתכם (לא חובה) ותוכן ההודעה.</p>
<p><b>מידע שאתם מוסרים בערוצים אחרים:</b> אם תפנו בוואטסאפ, בטלפון או במייל: המידע שתבחרו לשתף באותה שיחה.</p>
<p><b>מידע טכני:</b> כמו בכל אתר, שרת האחסון רושם באופן אוטומטי מידע טכני בסיסי (כגון כתובת IP, סוג הדפדפן ושעת הביקור) לצורכי אבטחה ותפעול.</p>
<p>אין חובה חוקית למסור את המידע. ללא שם ומספר טלפון לא נוכל לחזור אליכם בעקבות פנייה בטופס.</p>
HTML],
        ['why', 'למה המידע משמש', <<<HTML
<ul>
  <li>לחזור אליכם בעקבות הפנייה ולבדוק אם ואיך אפשר לעזור.</li>
  <li>להכין הצעת מחיר ולנהל את ההתקשרות, אם תבחרו לעבוד יחד.</li>
  <li>לשמור על אבטחת האתר ולמנוע שימוש לרעה, כמו הודעות ספאם.</li>
  <li>לעמוד בחובות לפי דין, למשל בתחום המס והחשבונאות.</li>
</ul>
<p>לא נשלח אליכם דיוור שיווקי (ניוזלטר, מבצעים) בלי הסכמה מפורשת נפרדת, בהתאם לחוק התקשורת (״חוק הספאם״).</p>
HTML],
        ['cookies', 'עוגיות (Cookies)', <<<HTML
<p>האתר משתמש בעוגייה טכנית אחת בלבד (עוגיית Session), שנדרשת כדי שטופס יצירת הקשר יעבוד בצורה מאובטחת. היא נמחקת עם סגירת הדפדפן.</p>
<p>נכון למועד העדכון, האתר אינו משתמש בעוגיות פרסום או במערכות מעקב וסטטיסטיקה. אם יתווספו כאלה, מדיניות זו תעודכן ונבקש את הסכמתכם במקרים שהדין מחייב.</p>
HTML],
        ['sharing', 'עם מי המידע משותף', <<<HTML
<p>אנחנו לא מוכרים ולא משכירים מידע אישי. המידע עשוי לעבור רק לגורמים שנדרשים כדי להפעיל את האתר והשירות:</p>
<ul>
  <li><b>חברת האחסון</b> (Hostinger), שעל שרתיה פועל האתר ונשלחות הודעות הטופס. השרתים עשויים להיות ממוקמים מחוץ לישראל.</li>
  <li><b>ספק תיבת המייל</b> שאליה מגיעות הפניות.</li>
  <li><b>Google Fonts:</b> הגופנים באתר נטענים משרתי Google, ולכן הדפדפן שלכם פונה אליהם ישירות.</li>
  <li><b>וואטסאפ (Meta):</b> אם תבחרו לפנות דרך כפתור הוואטסאפ, השיחה תתנהל בשירות של וואטסאפ ותהיה כפופה למדיניות הפרטיות שלו.</li>
  <li>רשויות מוסמכות, כאשר הדין מחייב זאת.</li>
</ul>
HTML],
        ['security', 'אבטחה ושמירת מידע', <<<HTML
<p>אנו נוקטים אמצעים סבירים לאבטחת המידע, כולל חיבור מוצפן (HTTPS), הגנה על הטופס מפני שליחה מזויפת וספאם, והגבלת הגישה למידע לבעל העסק בלבד.</p>
<p>פניות שלא הובילו להתקשרות נשמרות לפרק זמן סביר שאינו עולה על 24 חודשים, ולאחר מכן נמחקות. מידע על לקוחות נשמר כל עוד נדרש לצורך השירות ולפי חובות שמירת מסמכים בדין.</p>
<p>אין מערכת שחסינה לחלוטין מפני חדירה, ולכן איננו יכולים להבטיח אבטחה מוחלטת.</p>
HTML],
        ['rights', 'הזכויות שלכם', <<<HTML
<p>לפי חוק הגנת הפרטיות אתם זכאים:</p>
<ul>
  <li>לעיין במידע שנשמר עליכם.</li>
  <li>לבקש לתקן מידע שאינו נכון, שלם, ברור או מעודכן.</li>
  <li>לבקש למחוק את המידע, בכפוף לחובות שמירה לפי דין.</li>
  <li>לבקש שלא לקבל פניות שיווקיות, בכל עת.</li>
</ul>
<p>כדי לממש את הזכויות, כתבו אל <a href="mailto:{$mail}" dir="ltr">{$mail}</a>. נשיב לבקשה בתוך זמן סביר ובהתאם לדין.</p>
HTML],
        ['minors', 'קטינים', <<<HTML
<p>האתר מיועד לבעלי עסקים ואינו מיועד לקטינים מתחת לגיל 18. איננו אוספים ביודעין מידע על קטינים.</p>
HTML],
        ['changes', 'עדכונים למדיניות', <<<HTML
<p>מדיניות זו עשויה להתעדכן, למשל אם יתווספו לאתר כלים חדשים. תאריך העדכון האחרון מופיע בראש העמוד, ושינוי מהותי יסומן בבירור.</p>
HTML],
    ],
];

if ($is_en) {
    $o   = 'Shay Dadon';
    $reg = ($site['business_type_en'] && $site['business_id']) ? ', ' . e($site['business_type_en']) . ' no. ' . e($site['business_id']) : '';
    $legal = [
        'title' => 'Privacy policy',
        'lead'  => 'What information is collected when you use the site, why it is needed, how it is kept, and what your rights are.',
        'sections' => [
            ['who', 'Who is responsible for the information', <<<HTML
<p>The website {$dom} is operated by {$o}{$reg}, trading as SDmarketing. {$o} is responsible for the information collected on the site (the database owner).</p>
<p>This policy follows the Israeli Privacy Protection Law, 5741-1981, and the regulations made under it. This English text is a translation; if it differs from the Hebrew version, the Hebrew version prevails.</p>
HTML],
            ['what', 'What information is collected', <<<HTML
<p><b>Information you give in the contact form:</b> name, phone number, email address (optional), the service you are interested in (optional) and your message.</p>
<p><b>Information you give in other channels:</b> if you reach out on WhatsApp, by phone or by email, whatever you choose to share in that conversation.</p>
<p><b>Technical information:</b> like any website, the hosting server automatically logs basic technical information (such as IP address, browser type and time of visit) for security and operation.</p>
<p>You are not legally required to give any information. Without a name and phone number we cannot get back to you after a form inquiry.</p>
HTML],
            ['why', 'What the information is used for', <<<HTML
<ul>
  <li>To get back to you about your inquiry and see whether and how we can help.</li>
  <li>To prepare a quote and manage the engagement, if you choose to work together.</li>
  <li>To keep the site secure and prevent abuse, such as spam.</li>
  <li>To meet legal obligations, for example tax and accounting.</li>
</ul>
<p>We will not send you marketing messages (newsletters, offers) without separate explicit consent, as required by Israeli anti-spam law.</p>
HTML],
            ['cookies', 'Cookies', <<<HTML
<p>The site uses one technical cookie only (a session cookie), which the contact form needs to work securely. It is deleted when you close the browser.</p>
<p>As of the last update, the site does not use advertising cookies or tracking and analytics tools. If any are added, this policy will be updated and we will ask for your consent where the law requires it.</p>
HTML],
            ['sharing', 'Who the information is shared with', <<<HTML
<p>We do not sell or rent personal information. It may only be passed to parties needed to run the site and the service:</p>
<ul>
  <li><b>The hosting company</b> (Hostinger), whose servers run the site and send the form messages. The servers may be located outside Israel.</li>
  <li><b>The email provider</b> of the inbox that receives inquiries.</li>
  <li><b>Google Fonts:</b> the site’s fonts load from Google’s servers, so your browser contacts them directly.</li>
  <li><b>WhatsApp (Meta):</b> if you choose to reach out through the WhatsApp button, the conversation takes place on WhatsApp and is subject to its privacy policy.</li>
  <li>Competent authorities, when the law requires it.</li>
</ul>
HTML],
            ['security', 'Security and retention', <<<HTML
<p>We take reasonable measures to protect the information, including an encrypted connection (HTTPS), protecting the form against forged submissions and spam, and limiting access to the business owner only.</p>
<p>Inquiries that did not lead to an engagement are kept for a reasonable period of no more than 24 months and then deleted. Client information is kept as long as the service needs it and as record-keeping laws require.</p>
<p>No system is completely immune to intrusion, so we cannot guarantee absolute security.</p>
HTML],
            ['rights', 'Your rights', <<<HTML
<p>Under the Privacy Protection Law you may:</p>
<ul>
  <li>Review the information kept about you.</li>
  <li>Ask to correct information that is not accurate, complete, clear or up to date.</li>
  <li>Ask to delete the information, subject to legal retention duties.</li>
  <li>Ask not to receive marketing messages, at any time.</li>
</ul>
<p>To use these rights, write to <a href="mailto:{$mail}">{$mail}</a>. We will reply within a reasonable time and as the law requires.</p>
HTML],
            ['minors', 'Minors', <<<HTML
<p>The site is meant for business owners and not for minors under 18. We do not knowingly collect information about minors.</p>
HTML],
            ['changes', 'Updates to this policy', <<<HTML
<p>This policy may change, for example if new tools are added to the site. The date of the last update is shown at the top of the page, and any material change will be clearly marked.</p>
HTML],
        ],
    ];
}

require __DIR__ . '/includes/legal.php';
require __DIR__ . '/includes/footer.php';
