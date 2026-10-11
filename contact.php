<?php
require_once __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/services-data.php';

session_start();

$service_options = ['' => 'בחרו תחום (לא חובה)'];
foreach ($services as $s) $service_options[$s['id']] = $s['title'];
$service_options['other'] = 'משהו אחר / עוד לא בטוח';

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
    if (!hash_equals($_SESSION['csrf'], (string)($_POST['csrf'] ?? ''))) $errors['form'] = 'פג תוקף הטופס. רעננו את העמוד ונסו שוב.';

    if (mb_strlen($values['name']) < 2)  $errors['name'] = 'כתבו את השם שלכם.';
    $digits = preg_replace('/\D/', '', $values['phone']);
    if (strlen($digits) < 9 || strlen($digits) > 13) $errors['phone'] = 'מספר הטלפון לא נראה תקין. לדוגמה: 050-1234567';
    if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) $errors['email'] = 'כתובת המייל לא נראית תקינה.';
    if (!isset($service_options[$values['service']])) $values['service'] = '';
    if (mb_strlen($values['message']) > 3000) $errors['message'] = 'ההודעה ארוכה מדי. אפשר עד 3,000 תווים.';
    if ($values['consent'] !== '1') $errors['consent'] = 'כדי שנוכל לחזור אליכם יש לאשר את מדיניות הפרטיות.';

    if (!$errors && ($bot || $too_fast)) {
        // Quietly pretend it worked so bots learn nothing.
        header('Location: contact.php?sent=1#sent');
        exit;
    }
    if (!$errors && $too_often) $errors['form'] = 'כבר קיבלנו ממך הודעה לפני רגע. אפשר לשלוח שוב בעוד חצי דקה.';

    if (!$errors) {
        $clean = fn($v) => str_replace(["\r", "\n"], ' ', $v);
        $lines = [
            'שם: '      . $values['name'],
            'טלפון: '   . $values['phone'],
            'מייל: '    . ($values['email'] ?: '—'),
            'תחום: '    . ($values['service'] ? $service_options[$values['service']] : '—'),
            '',
            'הודעה:',
            $values['message'] ?: '—',
            '',
            '— נשלח מטופס יצירת הקשר ב-' . $site['domain'] . ' · ' . date('d/m/Y H:i'),
        ];
        $subject = '=?UTF-8?B?' . base64_encode('פנייה חדשה מהאתר: ' . $clean($values['name'])) . '?=';
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
            header('Location: contact.php?sent=1#sent');
            exit;
        }
        $send_failed = true;
    }
}
$_SESSION['form_shown'] = time();
$sent = isset($_GET['sent']);

$page_id      = 'contact';
$page_title   = 'צור קשר | SDmarketing';
$page_desc    = 'דברו עם שי דדון מ-SDmarketing: וואטסאפ, טלפון, מייל או טופס קצר, על אוטומציות, צ\'אטבוטים, אתרים, אפליקציות וקמפיינים.';
$header_theme = 'dark';
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

<!-- ============ PAGE HERO ============ -->
<section class="page-hero page-hero--short" aria-labelledby="page-title">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container">
    <nav class="breadcrumbs" aria-label="מיקום בעמוד">
      <a href="index.php">בית</a><span aria-hidden="true">/</span><span aria-current="page">צור קשר</span>
    </nav>
    <h1 id="page-title">בואו נדבר. <span>הודעה אחת מספיקה.</span></h1>
    <p class="page-lead">ספרו בכמה מילים מה העסק עושה ומה הייתם רוצים לשפר. אחזור אליכם עם רעיון אחד שאפשר להתחיל ממנו, בלי התחייבות.</p>
  </div>
</section>

<section class="section contact" aria-label="פרטי התקשרות וטופס">
  <div class="container contact-grid">

    <!-- ===== Form / success ===== -->
    <div class="contact-main">
      <?php if ($sent): ?>
        <div class="sent-card" id="sent" tabindex="-1" role="status">
          <span class="sent-ico"><?= icon('check') ?></span>
          <h2>ההודעה התקבלה. תודה.</h2>
          <p>אעבור עליה ואחזור אליכם לטלפון או לוואטסאפ שהשארתם. אם זה דחוף, אפשר גם לכתוב לי ישירות.</p>
          <div class="sent-actions">
            <a class="btn btn-primary" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
            <a class="btn btn-outline" href="projects.php"><span>בינתיים, לעבודות שלי</span><?= icon('arrow') ?></a>
          </div>
        </div>
      <?php else: ?>
        <form class="contact-form" method="post" action="contact.php" novalidate data-contact-form>
          <h2>השאירו פרטים</h2>
          <p class="form-intro">שדות עם <span class="req" aria-hidden="true">*</span> הם חובה. השאר עוזר לי להגיע לשיחה מוכן.</p>

          <?php if ($errors || $send_failed): ?>
            <div class="form-alert" role="alert" tabindex="-1" data-form-alert>
              <?= icon('close') ?>
              <div>
                <?php if ($send_failed): ?>
                  <b>ההודעה לא נשלחה בגלל תקלה אצלנו.</b>
                  <p>הפרטים שמילאתם נשמרו בטופס. אפשר לנסות שוב, או לשלוח לי אותם <a href="<?= e(wa_link($site, 'היי, ניסיתי לשלוח את הטופס באתר: ' . $values['message'])) ?>" target="_blank" rel="noopener">ישירות בוואטסאפ</a>.</p>
                <?php elseif (isset($errors['form'])): ?>
                  <b><?= e($errors['form']) ?></b>
                <?php else: ?>
                  <b>כמעט. צריך לתקן <?= count($errors) === 1 ? 'שדה אחד' : count($errors) . ' שדות' ?>:</b>
                  <ul><?php foreach ($errors as $k => $msg): ?><li><a href="#f-<?= e($k) ?>"><?= e($msg) ?></a></li><?php endforeach; ?></ul>
                <?php endif; ?>
              </div>
            </div>
          <?php endif; ?>

          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
          <div class="hp" aria-hidden="true"><label>אתר <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

          <div class="form-row">
            <div class="field">
              <label for="f-name">שם מלא <span class="req" aria-hidden="true">*</span></label>
              <input id="f-name" name="name" type="text" autocomplete="name" required minlength="2" value="<?= e($values['name']) ?>"<?= field_attrs('name', $errors) ?>>
              <?= field_error('name', $errors) ?>
            </div>
            <div class="field">
              <label for="f-phone">טלפון <span class="req" aria-hidden="true">*</span></label>
              <input id="f-phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" dir="ltr" required placeholder="050-1234567" value="<?= e($values['phone']) ?>"<?= field_attrs('phone', $errors) ?>>
              <?= field_error('phone', $errors) ?>
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="f-email">מייל</label>
              <input id="f-email" name="email" type="email" autocomplete="email" dir="ltr" placeholder="name@example.com" value="<?= e($values['email']) ?>"<?= field_attrs('email', $errors) ?>>
              <?= field_error('email', $errors) ?>
            </div>
            <div class="field">
              <label for="f-service">במה אפשר לעזור?</label>
              <div class="select">
                <select id="f-service" name="service">
                  <?php foreach ($service_options as $k => $label): ?>
                    <option value="<?= e($k) ?>"<?= $values['service'] === $k ? ' selected' : '' ?>><?= e($label) ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label for="f-message">ספרו קצת על העסק ועל מה שאתם צריכים</label>
            <textarea id="f-message" name="message" rows="5" maxlength="3000" placeholder="לדוגמה: יש לי מספרה, הרבה פניות בוואטסאפ ואין לי זמן לענות לכולן..."<?= field_attrs('message', $errors) ?>><?= e($values['message']) ?></textarea>
            <?= field_error('message', $errors) ?>
          </div>

          <div class="field field--check">
            <label class="check">
              <input id="f-consent" type="checkbox" name="consent" value="1" required<?= $values['consent'] === '1' ? ' checked' : '' ?><?= field_attrs('consent', $errors) ?>>
              <span class="check-box" aria-hidden="true"><?= icon('check') ?></span>
              <span>קראתי ואני מסכים/ה ל<a href="privacy.php" target="_blank">מדיניות הפרטיות</a>, ומאשר/ת שייצרו איתי קשר בנוגע לפנייה. <span class="req" aria-hidden="true">*</span></span>
            </label>
            <?= field_error('consent', $errors) ?>
          </div>

          <button class="btn btn-primary btn-lg btn-submit" type="submit" data-submit>
            <span class="btn-label">שליחת הפנייה</span><span class="spinner" aria-hidden="true"></span><?= icon('arrow') ?>
          </button>
        </form>
      <?php endif; ?>
    </div>

    <!-- ===== Direct channels ===== -->
    <aside class="contact-side" aria-labelledby="direct-title">
      <h2 id="direct-title">מעדיפים לדבר ישירות?</h2>
      <ul class="channels">
        <li>
          <a class="channel channel--wa" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">
            <span class="channel-ico"><?= icon('whatsapp') ?></span>
            <span class="channel-text"><b>וואטסאפ</b><small>הדרך הכי מהירה להגיע אליי</small></span>
            <?= icon('arrow', 'icon channel-arrow') ?>
          </a>
        </li>
        <li>
          <a class="channel" href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>">
            <span class="channel-ico"><?= icon('phone') ?></span>
            <span class="channel-text"><b>טלפון</b><small dir="ltr"><?= e($site['phone']) ?></small></span>
            <?= icon('arrow', 'icon channel-arrow') ?>
          </a>
        </li>
        <li>
          <a class="channel" href="mailto:<?= e($site['email']) ?>">
            <span class="channel-ico"><?= icon('mail') ?></span>
            <span class="channel-text"><b>מייל</b><small dir="ltr"><?= e($site['email']) ?></small></span>
            <?= icon('arrow', 'icon channel-arrow') ?>
          </a>
        </li>
      </ul>

      <div class="next-steps">
        <h3>מה קורה אחרי שתשלחו?</h3>
        <ol>
          <li><span>1</span><p>אני קורא את הפנייה ובודק אם ואיך אפשר לעזור.</p></li>
          <li><span>2</span><p>חוזר אליכם לשיחת היכרות קצרה בטלפון או בוואטסאפ.</p></li>
          <li><span>3</span><p>אם יש התאמה, מקבלים תוכנית כתובה עם מחיר ולוח זמנים.</p></li>
        </ol>
      </div>
    </aside>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
