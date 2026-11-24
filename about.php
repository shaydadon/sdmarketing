<?php
require_once __DIR__ . '/includes/config.php';
$page_id    = 'about';
$page_title = tr('אודות | SDmarketing | מפתח, משווק ואיש אוטומציות באדם אחד', 'About Shay Dadon: Developer & Digital Marketer | SDmarketing');
$page_desc  = tr('שי דדון, מייסד SDmarketing: יותר מ־15 שנה כמפתח תוכנה, B.Sc. במדעי המחשב, קורס שיווק ושנתיים בשיווק דיגיטלי.', 'Meet Shay Dadon, founder of SDmarketing: 15+ years as a software developer, a B.Sc. in Computer Science and hands-on experience in digital marketing.');
require __DIR__ . '/includes/header.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap about-hero">
    <div style="padding-bottom:90px">
      <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= tr('אודות', 'About') ?></b></nav>
      <h1 id="page-title"><?= tr('נעים מאוד,<span>אני שי דדון.</span>', 'Hi, I’m<span>Shay Dadon.</span>') ?></h1>
      <p class="lead"><?= tr('מפתח תוכנה עם יותר מ־15 שנות ניסיון, שבונה לעסקים את מה שמחבר בין הלקוח לבין המכירה: הבוט שעונה בוואטסאפ, האתר או האפליקציה שהלקוח נוחת בהם, הקמפיין שמביא אותו, והאוטומציה שדואגת שאף אחד לא ייפול באמצע.', 'A software developer with 15+ years of experience. I build everything that connects your customers to your sales: the WhatsApp chatbot that answers them, the website or app they land on, the campaign that brings them in, and the automation that makes sure no one falls through the cracks.') ?></p>
      <div class="ctas">
        <a class="btn btn-acc" href="<?= e(wa_link($site, tr('היי, קראתי עליך באתר ואשמח לדבר', 'Hi, I read about you on your website and would like to talk'))) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
        <a class="btn btn-ghost-d" href="<?= lurl('projects') ?>"><?= tr('לעבודות שלי', 'See my work') ?></a>
      </div>
    </div>
    <div class="ph">
      <img src="<?= url('assets/img/founder.webp') ?>" alt="<?= tr('שי דדון, מייסד SDmarketing', 'Shay Dadon, founder of SDmarketing') ?>" width="1024" height="1024" decoding="async">
      <div class="badge"><?= tr('המייסד של<br>SDmarketing', 'Founder,<br>SDmarketing') ?></div>
    </div>
  </div>
</section>

<section class="story" id="bio" aria-labelledby="story-title">
  <div class="wrap">
    <div class="split">
      <div>
        <span class="eyebrow"><?= tr('הסיפור', 'My story') ?></span>
        <h2 id="story-title" style="margin-top:16px"><?= tr('מתכנת<br>שלמד <span class="acc">לדבר שיווק.</span>', 'A developer<br>who learned <span class="acc">to speak marketing.</span>') ?></h2>
      </div>
      <div>
        <?php if ($is_en): ?>
        <p>I’ve spent most of my career as a developer: more than 15 years building systems, websites and apps, backed by a B.Sc. in Computer Science.</p>
        <p>Along the way I realized that code is only half the story. A great website is worth little if nobody visits it, and a new lead is worth nothing if nobody follows up. So I completed a marketing course and have spent the past two years working in digital marketing. I founded SDmarketing to bring both worlds together.</p>
        <p class="hl">The result: one person who understands how your campaigns perform, how your website works under the hood, and how to connect both to your business’s WhatsApp.</p>
        <?php else: ?>
        <p>את רוב הקריירה שלי ביליתי בפיתוח: יותר מ־15 שנים של בניית מערכות, אתרים ואפליקציות, על בסיס תואר ראשון במדעי המחשב.</p>
        <p>עם הזמן הבנתי שהקוד הוא רק חצי מהסיפור. אתר מצוין לא שווה הרבה אם אף אחד לא מגיע אליו, וליד שנכנס לא שווה כלום אם אף אחד לא חוזר אליו. אז השלמתי קורס בשיווק, ובשנתיים האחרונות אני עוסק גם בשיווק דיגיטלי. הקמתי את SDmarketing כדי לחבר בין שני העולמות.</p>
        <p class="hl">התוצאה: מישהו שמבין גם איך הקמפיין עובד, גם איך האתר בנוי מבפנים, וגם איך לגרום לשניהם לדבר עם הוואטסאפ של העסק.</p>
        <?php endif; ?>
      </div>
    </div>
    <?php if ($is_en): ?>
    <div class="cred-row" id="creds">
      <div class="c"><b class="ltr">15+</b><span>Years as a software developer</span><small>Systems, websites and apps</small></div>
      <div class="c"><b class="ltr">B.Sc.</b><span>Computer Science</span><small>Bachelor’s degree</small></div>
      <div class="c"><b class="sm">Marketing</b><span>Marketing course graduate</span><small>Strategy, audiences and messaging</small></div>
      <div class="c"><b>2 years</b><span>In digital marketing</span><small>Campaigns, analytics and optimization</small></div>
    </div>
    <?php else: ?>
    <div class="cred-row" id="creds">
      <div class="c"><b class="ltr">15+</b><span>שנות ניסיון כמפתח תוכנה</span><small>מערכות, אתרים ואפליקציות</small></div>
      <div class="c"><b class="ltr">B.Sc.</b><span>במדעי המחשב</span><small>תואר ראשון</small></div>
      <div class="c"><b class="sm">קורס שיווק</b><span>בוגר קורס בשיווק</span><small>אסטרטגיה, קהלים ומסרים</small></div>
      <div class="c"><b>שנתיים</b><span>בשיווק דיגיטלי</span><small>קמפיינים, מדידה ואופטימיזציה</small></div>
    </div>
    <?php endif; ?>
  </div>
</section>

<section class="compare dark" aria-labelledby="compare-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('למה זה חשוב', 'Why it matters') ?></span>
        <h2 class="sec" id="compare-title"><?= tr('למה אדם אחד<br><span class="acc">עדיף על שלושה ספקים.</span>', 'Why one specialist<br><span class="acc">beats three vendors.</span>') ?></h2>
      </div>
      <p class="lead"><?= tr('כשהמתכנת, המשווק ומי ש"מחבר את הוואטסאפ" הם שלושה אנשים שונים, כל העברה ביניהם היא מקום שבו מידע הולך לאיבוד. וכשמשהו לא עובד, כל אחד מצביע על השני.', 'When the developer, the marketer and the person who “sets up the WhatsApp” are three different people, every handoff is a chance for something to get lost. And when something breaks, everyone points at someone else.') ?></p>
    </div>
    <div class="cmp">
      <div class="col old">
        <h3><?= tr('הדרך הרגילה', 'The usual way') ?></h3>
        <div class="nodes"><span><?= tr('מתכנת', 'Developer') ?></span><span><?= tr('משווק', 'Marketer') ?></span><span><?= tr('איש אוטומציות', 'Automation specialist') ?></span></div>
        <ul>
          <li><i><?= icon('close') ?></i><?= tr('שלוש הצעות מחיר, שלושה לוחות זמנים', 'Three quotes, three timelines') ?></li>
          <li><i><?= icon('close') ?></i><?= tr('אתה מתווך בין הספקים', 'You end up managing the vendors') ?></li>
          <li><i><?= icon('close') ?></i><?= tr('כשמשהו נשבר, לא ברור של מי האחריות', 'When something breaks, nobody owns it') ?></li>
        </ul>
      </div>
      <div class="col new">
        <h3><?= tr('עם SDmarketing', 'With SDmarketing') ?></h3>
        <div class="nodes"><span><?= tr('אתר', 'Website') ?></span><span><?= tr('קמפיין', 'Ads') ?></span><span><?= tr('אוטומציה', 'Automation') ?></span></div>
        <ul>
          <li><i><?= icon('check') ?></i><?= tr('תוכנית אחת, מחיר אחד, איש קשר אחד', 'One plan, one price, one point of contact') ?></li>
          <li><i><?= icon('check') ?></i><?= tr('כל חלק נבנה כדי לעבוד עם השאר', 'Every piece is built to work with the rest') ?></li>
          <li><i><?= icon('check') ?></i><?= tr('אחריות מלאה על התוצאה, מקצה לקצה', 'Full ownership of the results, end to end') ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="rules" aria-labelledby="rules-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('איך אני עובד', 'How I work') ?></span>
        <h2 class="sec" id="rules-title"><?= tr('ארבעה כללים.', 'Four principles.') ?></h2>
      </div>
      <p class="lead"><?= tr('ארבעה כללים שמלווים כל פרויקט, מהשיחה הראשונה ועד אחרי שהוא עולה לאוויר.', 'Four principles that guide every project, from the first call to long after launch.') ?></p>
    </div>
    <div class="rule-grid">
      <?php if ($is_en): ?>
      <div class="rule"><span class="n">01</span><div><h3>Understand the business first, then build.</h3><p>I don’t start with technology. I start with where you’re losing time and customers, and build only what solves that.</p></div></div>
      <div class="rule"><span class="n">02</span><div><h3>Everything in writing before we start.</h3><p>Scope, order of work, cost and launch date, all agreed upfront. No surprises along the way.</p></div></div>
      <div class="rule"><span class="n">03</span><div><h3>Measure, then improve.</h3><p>Every website, chatbot and campaign is tracked from day one, so decisions are based on data, not guesswork.</p></div></div>
      <div class="rule"><span class="n">04</span><div><h3>Available when your customers are.</h3><p>We talk on WhatsApp, in plain language, with no forms or ticket systems. You always know where your project stands.</p></div></div>
      <?php else: ?>
      <div class="rule"><span class="n">01</span><div><h3>קודם מבינים את העסק, אחר כך בונים.</h3><p>לא מתחילים מטכנולוגיה. מתחילים מהשאלה איפה הולך לכם זמן ואיפה הולכים לאיבוד לקוחות, ובונים רק את מה שפותר את זה.</p></div></div>
      <div class="rule"><span class="n">02</span><div><h3>הכל בכתב, לפני שמתחילים.</h3><p>מה בונים, באיזה סדר, כמה זה עולה ומתי זה עולה לאוויר. בלי הפתעות באמצע.</p></div></div>
      <div class="rule"><span class="n">03</span><div><h3>מודדים, ואז משפרים.</h3><p>כל אתר, בוט וקמפיין מחוברים למעקב מהיום הראשון, כדי שהחלטות יתקבלו לפי נתונים ולא לפי תחושה.</p></div></div>
      <div class="rule"><span class="n">04</span><div><h3>זמין כמו שהלקוחות שלכם זמינים.</h3><p>מדברים בוואטסאפ, בשפה פשוטה, בלי טפסים ובלי מערכת כרטיסים. אתם יודעים בכל רגע איפה הפרויקט עומד.</p></div></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
$cta_title = tr("שיחה קצרה,\nבלי התחייבות.", "A quick chat,\nno commitment.");
$cta_text  = tr('תספרו לי על העסק, ואגיד לכם בכנות מה הייתי בונה ראשון (ואם בכלל צריך).', 'Tell me about your business and I’ll tell you honestly what I’d build first, and whether you need anything at all.');
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
