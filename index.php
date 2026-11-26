<?php
require_once __DIR__ . '/includes/config.php';
$page_id      = 'index';
$page_title   = tr('צ׳אטבוט לוואטסאפ, אוטומציות ואתרים לעסקים | SDmarketing', 'WhatsApp Chatbots & Business Automation | SDmarketing');
$page_desc    = tr('צ׳אטבוט לוואטסאפ, אוטומציות לעסקים, בניית אתרים וחנויות, אפליקציות PWA, קידום אורגני וקמפיינים ממומנים. הכל מחובר, ואדם אחד אחראי על כולו.', 'WhatsApp chatbots, business automation, web development, PWA apps, SEO and Google Ads management, built as one connected system by one specialist.');
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/services-data.php';
require __DIR__ . '/includes/projects-data.php';

?>

<section class="h3ro" aria-labelledby="hero-title">
  <div class="wrap h3-grid">
    <div class="h3-text hero-in">
      <span class="eyebrow"><?= tr('שי דדון · טכנולוגיה, אוטומציות ושיווק', 'Shay Dadon · Developer, automation & marketing') ?></span>
      <h1 id="hero-title"><?= tr('<span class="l1">העסק שלכם ממשיך לעבוד.</span><span class="l2">גם כשאתם לא.</span>', '<span class="l1">Your business keeps working.</span><span class="l2">Even when you’re not.</span>') ?></h1>
      <p class="lead"><?= tr('אתרים, אוטומציות וכלים דיגיטליים שמתחברים למערכות של העסק שלכם וחוסכים לכם זמן ועבודה.', 'Websites, automations and digital tools that connect to the systems your business already uses and save you time and work.') ?></p>
      <a class="btn btn-main" href="<?= e(wa_link($site, tr('היי שי, אשמח לדבר על העסק שלי', "Hi Shay, I'd like to talk about my business"))) ?>" target="_blank" rel="noopener"><span><?= tr('בואו נדבר על העסק שלכם', 'Let’s talk about your business') ?></span><?= icon('arrow') ?></a>
      <p class="offer"><?= tr('הודעה קצרה בוואטסאפ, ואחזור אליכם עם רעיון ראשון.', 'Send a short WhatsApp message and I’ll reply with a first idea.') ?></p>
    </div>
    <figure class="h3-art" aria-label="<?= tr('עבודות אמיתיות: החנות fisha.shop, אפליקציית הכושר והתזונה Excerly וצ׳אטבוט הוואטסאפ Boardog', 'Live projects: the fisha.shop online store, the Excerly AI fitness and nutrition app and the Boardog WhatsApp chatbot') ?>">
      <div class="browser h3-b">
        <div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div>
        <img src="<?= url('assets/img/projects/fisha/tattoos-1.webp') ?>" alt="" width="1600" height="1000" decoding="async" fetchpriority="high">
      </div>
      <div class="device h3-p"><img src="<?= url('assets/img/projects/excerly/session-m.webp') ?>" alt="" width="780" height="1688" decoding="async"></div>
      <div class="device h3-bd"><img src="<?= url('assets/img/projects/boardog/chat-end.webp') ?>" alt="" width="780" height="1690" decoding="async"></div>
    </figure>
  </div>
</section>

<section class="services lite" aria-labelledby="services-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('מה אני בונה', 'What I build') ?></span>
        <h2 class="sec" id="services-title"><?= tr('חמישה שירותים שבנויים לעבוד יחד.', 'Five services built to work together.') ?></h2>
      </div>
    </div>

    <div class="svc-grid">
      <?php foreach ($services as $i => $s): ?>
        <a class="svc rv" href="<?= e(lurl('services#' . $s['id'])) ?>">
          <h3 class="svc-h"><span class="icon"><?= icon($s['icon']) ?></span><?= e($s['title']) ?></h3>
          <p class="d"><?= e($s['lead']) ?></p>
          <span class="out" aria-hidden="true"><?= icon('arrow') ?></span>
        </a>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<section class="work" aria-labelledby="work-title">
  <div class="wrap">
    <div class="sec-head">
      <div>
        <span class="eyebrow"><?= tr('עבודות אחרונות', 'Recent work') ?></span>
        <h2 class="sec" id="work-title"><?= tr('פרויקטים שאפשר להיכנס אליהם עכשיו.', 'Projects you can open and try today.') ?></h2>
      </div>
      <a class="btn btn-ink" href="<?= lurl('projects') ?>"><?= tr('לכל הפרויקטים', 'View all projects') ?><?= icon('arrow') ?></a>
    </div>
    <?php
    // The home page also shows the Boardog WhatsApp chatbot (on the projects page it is its own section, includes/wa-demo.php).
    $home_projects = $projects;
    $home_projects[] = [
        'name'    => 'Boardog',
        'tag'     => tr('צ׳אטבוט וואטסאפ לבעלי פנסיונים', 'WhatsApp chatbot for dog boarding businesses'),
        'summary' => tr('צ׳אטבוט לוואטסאפ שמקבל פנייה, אוסף את הפרטים וקובע פגישה לבד.', 'A WhatsApp chatbot that handles a new inquiry, collects the details and books the meeting on its own.'),
        'layout'  => 'phones',
        'shots'   => [
            ['src' => 'assets/img/projects/boardog/chat-top.webp', 'alt' => tr('תחילת שיחה עם הצ׳אטבוט Boardog בוואטסאפ', 'The start of a WhatsApp conversation with the Boardog chatbot'), 'w' => 780, 'h' => 1690],
            ['src' => 'assets/img/projects/boardog/chat-end.webp', 'alt' => tr('הצ׳אטבוט Boardog קובע פגישה ושולח סיכום', 'The Boardog chatbot books a meeting and sends a summary'), 'w' => 780, 'h' => 1690],
        ],
    ];
    ?>
    <div class="proj-grid" data-carousel id="home-projects" data-carousel-label="<?= tr('פרויקטים, אפשר לגלול הצידה', 'Projects, scrollable') ?>">
      <?php foreach ($home_projects as $n => $p): ?>
        <article class="proj big<?= $p['layout'] === 'phones' ? ' rev' : '' ?><?= $n % 2 === 0 && $p['layout'] === 'phones' ? ' flip' : '' ?>">
          <?php if ($p['layout'] === 'phones'): ?>
            <div class="media media-ex">
              <?php foreach ($p['shots'] as $shot): ?>
                <div class="mphone"><img src="<?= e(url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async"></div>
              <?php endforeach; ?>
            </div>
          <?php else: $shot = $p['shots'][0]; ?>
            <div class="media media-fisha">
              <div class="browser">
                <div class="bar"><i></i><i></i><i></i><u></u></div>
                <img src="<?= e(url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async">
              </div>
            </div>
          <?php endif; ?>
          <div class="body">
            <div class="row"><h3 lang="en"><?= e($p['name']) ?></h3><span class="tag acc"><?= e($p['tag']) ?></span></div>
            <p><?= e($p['summary']) ?></p>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
    <div class="proj-dots" role="group" aria-label="<?= tr('מעבר בין הפרויקטים', 'Move between projects') ?>" data-carousel-dots="home-projects">
      <?php foreach ($home_projects as $i => $p): ?>
        <button type="button" aria-controls="home-projects" aria-label="<?= e(tr('פרויקט ' . ($i + 1) . ' מתוך ' . count($home_projects) . ': ', 'Project ' . ($i + 1) . ' of ' . count($home_projects) . ': ') . $p['name']) ?>"<?= $i === 0 ? ' aria-current="true"' : '' ?>></button>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="approach" aria-labelledby="about-title">
  <div class="wrap ap-grid">
    <div class="ap-photo rv">
      <img src="<?= url('assets/img/founder.webp') ?>" alt="<?= tr('שי דדון, מייסד SDmarketing', 'Shay Dadon, founder of SDmarketing') ?>" width="1024" height="1024" loading="lazy" decoding="async">
      <div class="cap"><b><?= tr('שי דדון', 'Shay Dadon') ?></b><span><?= tr('מפתח תוכנה, B.Sc. מדעי המחשב, שיווק&nbsp;דיגיטלי', 'Software developer · B.Sc. Computer Science · Digital marketing') ?></span></div>
    </div>
    <div>
      <span class="eyebrow"><?= tr('למה אני', 'Why work with me') ?></span>
      <h2 class="sec" id="about-title"><?= tr('<span class="count" data-count="15">15</span>+ שנות ניסיון בטכנולוגיה.<span class="acc">קודם מבינים את הבעיה.</span>', '<span class="count" data-count="15">15</span>+ years in tech.<span class="acc">The problem comes first.</span>') ?></h2>
      <p class="lead"><?= tr('רק אחרי שברור מה לא עובד בעסק שלכם, אני בוחר קוד, עיצוב או מערכת.', 'Only once it’s clear what isn’t working in your business do I choose the code, the design or the tools.') ?></p>
      <a class="link" href="<?= lurl('about') ?>"><?= tr('הסיפור המלא', 'Read my story') ?> <?= icon('arrow') ?></a>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/includes/cta.php';
require __DIR__ . '/includes/footer.php';
