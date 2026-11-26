<?php
require_once __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/services-data.php';

session_start();

$service_options = ['' => tr('בחרו תחום (לא חובה)', 'Select a service (optional)')];
foreach ($services as $s) $service_options[$s['id']] = $s['title'];
$service_options['other'] = tr('משהו אחר / עוד לא בטוח', 'Something else / Not sure yet');

$values = ['name' => '', 'phone' => '', 'email' => '', 'service' => $_GET['service'] ?? '', 'message' => '', 'consent' => ''];
if (!isset($service_options[$values['service']])) $values['service'] = '';
$errors = [];
$send_failed = false;

if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $k => $_) $values[$k] = trim((string)($_POST[$k] ?? ''));

    $bot = ($_POST['website'] ?? '') !== '';                                  // honeypot
    $too_fast = (time() - (int)($_SESSION['form_shown'] ?? 0)) < 3;          // submitted faster than a human could
    $too_often = (time() - (int)($_SESSION['last_sent'] ?? 0)) < 30;
    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) $errors['form'] = tr('פג תוקף הטופס. רעננו את העמוד ונסו שוב.', 'This form has expired. Please refresh the page and try again.');

    if (mb_strlen($values['name']) < 2)  $errors['name'] = tr('כתבו את השם שלכם.', 'Please enter your name.');
    $digits = preg_replace('/\D/', '', $values['phone']);
    if (strlen($digits) < 9 || strlen($digits) > 13) $errors['phone'] = tr('מספר הטלפון לא נראה תקין. לדוגמה: 050-1234567', 'That phone number doesn’t look right. For example: +972 50 123 4567');
    if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = tr('כתובת המייל לא נראית תקינה.', 'That email address doesn’t look right.');
    if (!isset($service_options[$values['service']])) $values['service'] = '';
    if (mb_strlen($values['message']) > 3000) $errors['message'] = tr('ההודעה ארוכה מדי. אפשר עד 3,000 תווים.', 'Your message is too long. Please keep it under 3,000 characters.');
    if ($values['consent'] !== '1') $errors['consent'] = tr('כדי שנוכל לחזור אליכם יש לאשר את מדיניות הפרטיות.', 'Please accept the privacy policy so I can get back to you.');

    if (!$errors && ($bot || $too_fast)) {
        // Quietly pretend it worked so bots learn nothing.
        header('Location: ' . lurl('contact') . '?sent=1#sent');
        exit;
    }
    if (!$errors && $too_often) $errors['form'] = tr('כבר קיבלנו ממך הודעה לפני רגע. אפשר לשלוח שוב בעוד חצי דקה.', 'We just received your message. You can send another one in 30 seconds.');

    if (!$errors) {
        $clean = fn($v) => str_replace(["\r", "\n"], ' ', $v);
        $lines = [
            'שם: '      . $values['name'],
            'טלפון: '   . $values['phone'],
            'מייל: '    . ($values['email'] ?: '—'),
            'תחום: '    . ($values['service'] ? $service_options[$values['service']] : '—'),
            'שפת האתר: ' . ($is_en ? 'אנגלית' : 'עברית'),
            '',
            'הודעה:',
            $values['message'] ?: '—',
            '',
            '— נשלח מטופס יצירת הקשר ב-' . $site['domain'] . ' · ' . date('d/m/Y H:i'),
        ];
        $subject = '=?UTF-8?B?' . base64_encode(($is_dev ? '[DEV] ' : '') . ($is_en ? 'פנייה חדשה מהאתר באנגלית: ' : 'פנייה חדשה מהאתר: ') . $clean($values['name'])) . '?=';
        $headers = [
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
            'Content-Transfer-Encoding: 8bit',
            'From: SDmarketing <no-reply@' . $site['domain'] . '>',
        ];
        if ($values['email'] !== '') $headers[] = 'Reply-To: ' . $clean($values['email']);

        if (@mail($site['email'], $subject, implode("\n", $lines), implode("\r\n", $headers))) {
            $_SESSION['last_sent'] = time();
            $_SESSION['csrf'] = bin2hex(random_bytes(16));
            header('Location: ' . lurl('contact') . '?sent=1#sent');
            exit;
        }
        $send_failed = true;
    }
}
$_SESSION['form_shown'] = time();
$sent = isset($_GET['sent']);

$page_id      = 'contact';
$page_title   = tr('צור קשר | SDmarketing', 'Contact Shay Dadon | SDmarketing');
$page_desc    = tr('דברו עם שי דדון מ-SDmarketing: וואטסאפ, טלפון, מייל או טופס קצר, על אוטומציות, צ\'אטבוטים, אתרים, אפליקציות, קידום אורגני וקמפיינים ממומנים.', 'Get in touch with Shay Dadon at SDmarketing by WhatsApp, phone, email or a short form to talk about chatbots, automation, websites, apps, SEO or paid ads.');
require __DIR__ . '/includes/header.php';

function field_attrs(string $name, array $errors): string
{
    return isset($errors[$name]) ? ' aria-invalid="true" aria-describedby="err-' . $name . '"' : '';
}
function field_error(string $name, array $errors): string
{
    return isset($errors[$name]) ? '<p class="field-error" id="err-' . $name . '">' . icon('close') . e($errors[$name]) . '</p>' : '';
}
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero sm" style="padding-bottom:160px">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= tr('צור קשר', 'Contact') ?></b></nav>
    <h1 id="page-title"><?= tr('בואו נדבר.<span>הודעה אחת מספיקה.</span>', 'Let’s talk.<span>One message is all it takes.</span>') ?></h1>
    <p class="lead" style="max-width:640px;margin-top:28px"><?= tr('ספרו בכמה מילים מה העסק עושה ומה הייתם רוצים לשפר. אחזור אליכם עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.', 'Tell me in a few words what your business does and what you’d like to improve. I’ll get back to you with one concrete idea to start with, no strings attached.') ?></p>
  </div>
</section>

<section class="contact-wrap" aria-label="<?= tr('פרטי התקשרות וטופס', 'Contact details and form') ?>">
  <div class="wrap cgrid">
    <div class="cform">
      <?php if ($sent): ?>
        <div class="sent-card" id="sent" tabindex="-1" role="status">
          <h2><?= tr('ההודעה התקבלה. תודה.', 'Thanks! Your message has been received.') ?></h2>
          <p><?= tr('אעבור עליה ואחזור אליכם לטלפון או לוואטסאפ שהשארתם. אם זה דחוף, אפשר גם לכתוב לי ישירות.', 'I’ll review it and get back to you by phone or WhatsApp. If it’s urgent, feel free to message me directly.') ?></p>
          <div class="ctas">
            <a class="btn btn-ink" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
            <a class="btn btn-ghost" href="<?= lurl('projects') ?>"><?= tr('בינתיים, לעבודות שלי', 'In the meantime, see my work') ?></a>
          </div>
        </div>
      <?php else: ?>
        <form class="contact-form" method="post" action="<?= lurl('contact') ?>" novalidate data-contact-form>
          <h2><?= tr('השאירו פרטים', 'Send me a message') ?></h2>
          <p class="hint"><?= tr('שדות עם <b class="req">*</b> הם חובה. השאר עוזר לי להגיע לשיחה מוכן.', 'Fields marked <b class="req">*</b> are required. The rest helps me prepare for our call.') ?></p>

          <?php if ($errors || $send_failed): ?>
            <div class="form-alert" role="alert" tabindex="-1" data-form-alert>
              <?= icon('close') ?>
              <div>
                <?php if ($send_failed): ?>
                  <b><?= tr('ההודעה לא נשלחה בגלל תקלה אצלנו.', 'Your message couldn’t be sent due to a problem on our end.') ?></b>
                  <p><?= tr('הפרטים שמילאתם נשמרו בטופס. אפשר לנסות שוב, או לשלוח לי אותם', 'Your details are still in the form. You can try again or send them to me') ?> <a href="<?= e(wa_link($site, tr('היי, ניסיתי לשלוח את הטופס באתר: ', 'Hi, I tried to send the form on the website: ') . $values['message'])) ?>" target="_blank" rel="noopener"><?= tr('ישירות בוואטסאפ', 'directly on WhatsApp') ?></a>.</p>
                <?php elseif (isset($errors['form'])): ?>
                  <b><?= e($errors['form']) ?></b>
                <?php else: ?>
                  <b><?= $is_en ? 'Almost there. Please fix ' . (count($errors) === 1 ? 'one field' : count($errors) . ' fields') . ':' : 'כמעט. צריך לתקן ' . (count($errors) === 1 ? 'שדה אחד' : count($errors) . ' שדות') . ':' ?></b>
                  <ul><?php foreach ($errors as $k => $msg): ?><li><a href="#f-<?= e($k) ?>"><?= e($msg) ?></a></li><?php endforeach; ?></ul>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <div class="hp" aria-hidden="true"><label><?= tr('אתר', 'Website') ?> <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

          <div class="fgrid">
            <div class="field fl">
              <label for="f-name"><?= tr('שם מלא', 'Full name') ?> <b class="req" aria-hidden="true">*</b></label>
              <input class="inp" id="f-name" name="name" type="text" autocomplete="name" required minlength="2" value="<?= e($values['name']) ?>"<?= field_attrs('name', $errors) ?>>
              <?= field_error('name', $errors) ?>
            </div>
            <div class="field fl">
              <label for="f-phone"><?= tr('טלפון', 'Phone') ?> <b class="req" aria-hidden="true">*</b></label>
              <input class="inp ltr" id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" dir="ltr" required placeholder="<?= tr('050-1234567', '+972 50 123 4567') ?>" value="<?= e($values['phone']) ?>"<?= field_attrs('phone', $errors) ?>>
              <?= field_error('phone', $errors) ?>
            </div>
            <div class="field fl full">
              <label for="f-email"><?= tr('מייל', 'Email') ?></label>
              <input class="inp ltr" id="f-email" name="email" type="email" autocomplete="email" dir="ltr" placeholder="name@example.com" value="<?= e($values['email']) ?>"<?= field_attrs('email', $errors) ?>>
              <?= field_error('email', $errors) ?>
            </div>
            <fieldset class="fl full">
              <legend><?= tr('במה אפשר לעזור?', 'What can I help you with?') ?></legend>
              <div class="svc-pick">
                <?php foreach ($service_options as $k => $label): if ($k === '') continue; ?>
                  <label>
                    <input type="radio" name="service" value="<?= e($k) ?>"<?= $values['service'] === $k ? ' checked' : '' ?>>
                    <span><?= e($label) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </fieldset>
            <div class="field fl full">
              <label for="f-message"><?= tr('ספרו קצת על העסק ועל מה שאתם צריכים', 'Tell me a bit about your business and what you need') ?></label>
              <textarea class="inp ta" id="f-message" name="message" rows="5" maxlength="3000" placeholder="<?= tr('לדוגמה: יש לי מספרה, הרבה פניות בוואטסאפ ואין לי זמן לענות לכולן...', 'For example: I run a hair salon and get lots of WhatsApp messages, but don’t have time to answer them all…') ?>"<?= field_attrs('message', $errors) ?>><?= e($values['message']) ?></textarea>
              <?= field_error('message', $errors) ?>
            </div>
            <div class="field full">
              <label class="consent">
                <input id="f-consent" type="checkbox" name="consent" value="1" required<?= $values['consent'] === '1' ? ' checked' : '' ?><?= field_attrs('consent', $errors) ?>>
                <span class="box" aria-hidden="true"><?= icon('check') ?></span>
                <span><?= tr('קראתי ואני מסכים/ה ל<a href="' . url('privacy') . '">מדיניות הפרטיות</a>, ומאשר/ת שייצרו איתי קשר בנוגע לפנייה.', 'I have read and agree to the <a href="' . lurl('privacy') . '">privacy policy</a> and agree to be contacted about my inquiry.') ?> <b class="req" aria-hidden="true">*</b></span>
              </label>
              <?= field_error('consent', $errors) ?>
            </div>
          </div>

          <button class="btn btn-acc" type="submit" data-submit>
            <span class="btn-label"><?= tr('שליחת הפנייה', 'Send message') ?></span><span class="spinner" aria-hidden="true"></span><?= icon('arrow') ?>
          </button>
        </form>
      <?php endif; ?>
    </div>

    <aside class="cside">
      <div class="cbox">
        <h2><?= tr('מעדיפים לדבר ישירות?', 'Prefer to talk directly?') ?></h2>
        <a class="cline wa" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">
          <span class="ic"><?= icon('whatsapp') ?></span>
          <span class="tx"><b><?= tr('וואטסאפ', 'WhatsApp') ?></b><span><?= tr('הדרך הכי מהירה להגיע אליי', 'The fastest way to reach me') ?></span></span>
          <?= icon('arrow', 'glyph arr2') ?>
        </a>
        <a class="cline" href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>">
          <span class="ic"><?= icon('phone') ?></span>
          <span class="tx"><b class="ltr" dir="ltr"><?= e($site['phone_display']) ?></b><span><?= tr('טלפון', 'Phone') ?></span></span>
          <?= icon('arrow', 'glyph arr2') ?>
        </a>
        <a class="cline" href="mailto:<?= e($site['email']) ?>">
          <span class="ic"><?= icon('mail') ?></span>
          <span class="tx"><b class="ltr" dir="ltr"><?= e($site['email']) ?></b><span><?= tr('מייל', 'Email') ?></span></span>
          <?= icon('arrow', 'glyph arr2') ?>
        </a>
      </div>
      <div class="after">
        <h2><?= tr('מה קורה אחרי שתשלחו?', 'What happens next?') ?></h2>
        <ol>
          <li><i>1</i><span><?= tr('אני קורא את הפנייה ובודק אם ואיך אפשר לעזור.', 'I read your message and see whether and how I can help.') ?></span></li>
          <li><i>2</i><span><?= tr('חוזר אליכם לשיחת היכרות קצרה בטלפון או בוואטסאפ.', 'I get back to you for a quick intro call by phone or WhatsApp.') ?></span></li>
          <li><i>3</i><span><?= tr('אם יש התאמה, מקבלים תוכנית כתובה עם מחיר ולוח זמנים.', 'If we’re a good fit, you get a written plan with pricing and a timeline.') ?></span></li>
        </ol>
      </div>
    </aside>
  </div>
</section>

<?php
// Practical questions before reaching out. The questions that match a problem to a service are on the services page.
$contact_faq = $is_en ? [
    ['q' => 'I’m not sure which service I need. Should I still get in touch?',
     'a' => 'Yes. Tell me what’s bothering you in the business, and I’ll tell you honestly what I’d build first, and whether you need anything at all.'],
    ['q' => 'Do I need to prepare anything before we talk?',
     'a' => 'No. A short message about what your business does and what you’d like to improve is enough. If you already have a website or run ads, send the link and I’ll take a look before we talk.'],
    ['q' => 'When will I know what it costs?',
     'a' => 'Before anything is built. You get a written plan with the scope, the order of work, the price and the launch date, and nothing starts until you approve it.'],
    ['q' => 'What happens after it goes live?',
     'a' => 'Every website, chatbot and campaign is tracked from day one. I follow the numbers, improve what works and suggest the next step.'],
] : [
    ['q' => 'לא בטוחים איזה שירות אתם צריכים? אפשר לפנות בכל זאת?',
     'a' => 'בטח. ספרו לי מה מפריע לכם בעסק, ואגיד לכם בכנות מה הייתי בונה ראשון, ואם בכלל צריך.'],
    ['q' => 'צריך להכין משהו לפני השיחה?',
     'a' => 'לא. הודעה קצרה על מה העסק עושה ומה הייתם רוצים לשפר מספיקה. אם יש לכם אתר או קמפיין פעיל, שלחו קישור ואעבור עליו לפני שנדבר.'],
    ['q' => 'מתי אדע כמה זה עולה?',
     'a' => 'לפני שמתחילים לבנות. מקבלים תוכנית כתובה עם היקף, סדר עבודה, מחיר ותאריך עלייה לאוויר, ושום דבר לא מתחיל לפני שאישרתם.'],
    ['q' => 'מה קורה אחרי שזה עולה לאוויר?',
     'a' => 'כל אתר, בוט וקמפיין מחוברים למעקב מהיום הראשון. אני עוקב אחרי המספרים, משפר את מה שעובד ומציע את הצעד הבא.'],
];
?>
<section class="faq contact-faq" aria-labelledby="contact-faq-title">
  <div class="wrap">
    <span class="eyebrow"><?= tr('לפני שפונים', 'Before you reach out') ?></span>
    <h2 class="sec" id="contact-faq-title"><?= tr('שאלות נפוצות', 'Common questions') ?></h2>
    <div class="faq-list">
      <?php foreach ($contact_faq as $i => $item): ?>
        <details>
          <summary id="cfaq-q-<?= $i ?>"><span><?= e($item['q']) ?></span></summary>
          <div class="faq-a" role="region" aria-labelledby="cfaq-q-<?= $i ?>"><p><?= e($item['a']) ?></p></div>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn($f) => ['@type' => 'Question', 'name' => $f['q'], 'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']]], $contact_faq),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
