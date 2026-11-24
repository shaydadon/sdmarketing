<?php
require_once __DIR__ . '/includes/config.php';
$page_id    = 'projects';
$page_title = tr('פרויקטים: חנות אונליין, אפליקציית PWA וצ׳אטבוט | SDmarketing', 'Projects: Online Store, PWA & WhatsApp Chatbot | SDmarketing');
$page_desc  = tr('עבודות של SDmarketing: בניית חנות אונליין, אתרי תדמית ואפליקציית PWA ללא צורך בחנות האפליקציות, עם צילומי מסך אמיתיים.', 'Real work by SDmarketing: an e-commerce store, a progressive web app that installs without an app store, and a WhatsApp chatbot that books appointments.');
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/projects-data.php';
?>

<section class="hero dark">
  <div class="glow" style="top:-100px;left:-200px" aria-hidden="true"></div>
  <div class="wrap p-hero">
    <nav class="crumb" aria-label="<?= tr('מיקום בעמוד', 'Breadcrumb') ?>"><a href="<?= lurl('') ?>"><?= tr('בית', 'Home') ?></a> / <b><?= tr('פרויקטים', 'Projects') ?></b></nav>
    <div class="row">
      <h1 id="page-title"><?= tr('לא מצגות.<span>דברים שעובדים באוויר.</span>', 'No mockups.<span>Just work that’s live.</span>') ?></h1>
    </div>
    <div class="row" style="align-items:center;margin-top:36px">
      <p class="lead" style="margin:0;max-width:560px"><?= tr('חנויות, אתרים ואפליקציות שבניתי ושלקוחות משתמשים בהם עכשיו. אפשר להיכנס ולנסות בעצמכם.', 'Online stores, websites and apps I’ve built that real customers are using right now. Take a look and try them yourself.') ?></p>
      <div class="filters" role="group" aria-label="<?= tr('סינון לפי סוג', 'Filter by type') ?>" data-filters>
        <?php foreach ($project_cats as $key => $label):
          $count = $key === 'all'
              ? count($projects) + array_sum($extra_cases)
              : count(array_filter($projects, fn($p) => $p['cat'] === $key)) + ($extra_cases[$key] ?? 0); ?>
          <button type="button" class="chip<?= $key === 'all' ? ' on' : '' ?>" data-filter="<?= e($key) ?>" aria-pressed="<?= $key === 'all' ? 'true' : 'false' ?>">
            <?= e($label) ?> <i><?= $count ?></i>
          </button>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<div data-showcase>
<?php foreach ($projects as $i => $p): ?>
<section class="case" id="case-<?= e($p['slug']) ?>" data-cat="<?= e($p['cat']) ?>" aria-labelledby="case-title-<?= e($p['slug']) ?>">
  <div class="wrap">
    <div class="case-head">
      <div>
        <h2 id="case-title-<?= e($p['slug']) ?>" lang="en"><?= e($p['name']) ?></h2>
        <div class="tags"><span class="tag acc"><?= e($p['tag']) ?></span></div>
      </div>
      <div>
        <p class="desc"><?= e($p['summary']) ?></p>
      </div>
    </div>

    <?php if ($p['slug'] === 'excerly'): ?>
      <div class="stage stage-ex-nice">
        <?php foreach ([
          ['assets/img/projects/excerly/home-m.webp', tr('מסך היום באפליקציית Excerly', 'The Today screen in the Excerly app')],
          ['assets/img/projects/excerly/workouts-m.webp', tr('מסך האימונים באפליקציית Excerly', 'The Workouts screen in the Excerly app')],
          ['assets/img/projects/excerly/session-m.webp', tr('מסך אימון באפליקציית Excerly', 'A workout session in the Excerly app')],
          ['assets/img/projects/excerly/nutrition-m.webp', tr('מסך התזונה באפליקציית Excerly', 'The Nutrition screen in the Excerly app')],
        ] as $shot): ?>
          <div class="mphone"><img src="<?= e(url($shot[0])) ?>" alt="<?= e($shot[1]) ?>" width="780" height="1688" loading="lazy" decoding="async"></div>
        <?php endforeach; ?>
      </div>
    <?php elseif ($p['slug'] === 'fisha'): ?>
      <div class="stage stage-fisha">
        <div class="browser main">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img class="tall" src="<?= url('assets/img/projects/fisha/originals-main.webp') ?>" alt="<?= tr('עמוד Originals בחנות fisha.shop', 'The Originals page on fisha.shop') ?>" width="1600" height="1133" loading="lazy" decoding="async">
        </div>
        <div class="side">
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="<?= url('assets/img/projects/fisha/shop-hq-c.webp') ?>" alt="<?= tr('עמוד החנות fisha.shop', 'The fisha.shop shop page') ?>" width="1600" height="929" loading="lazy" decoding="async"></div>
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="<?= url('assets/img/projects/fisha/tattoos-2.webp') ?>" alt="<?= tr('Flash sheet בחנות fisha.shop', 'A flash sheet on fisha.shop') ?>" width="1600" height="1000" loading="lazy" decoding="async"></div>
          <div class="browser"><div class="bar"><i></i><i></i><i></i><u></u></div><img src="<?= url('assets/img/projects/fisha/tattoos-1.webp') ?>" alt="<?= tr('עמוד הקעקועים של fisha.shop', 'The tattoos page on fisha.shop') ?>" width="1600" height="1000" loading="lazy" decoding="async"></div>
        </div>
      </div>
    <?php else: $shot = $p['shots'][0]; ?>
      <div class="stage stage-one">
        <div class="browser">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img src="<?= e(url($shot['src'])) ?>" alt="<?= e($shot['alt']) ?>" width="<?= (int) $shot['w'] ?>" height="<?= (int) $shot['h'] ?>" loading="lazy" decoding="async">
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php endforeach; ?>
<?php require __DIR__ . '/includes/wa-demo.php'; ?>
</div>

<section class="next" style="padding-top:0">
  <div class="wrap">
    <div class="box">
      <div>
        <h2><?= tr('הפרויקט הבא<br><span>יכול להיות שלך.</span>', 'Your project<br><span>could be next.</span>') ?></h2>
        <p><?= tr('חנות, אתר, אפליקציה, בוט, קידום אורגני או קמפיין ממומן? כל פרויקט כאן התחיל בהודעה אחת. ספרו לי מה אתם צריכים ואחזור עם הצעה.', 'An online store, a website, an app, a chatbot, SEO or a paid campaign? Every project here started with a single message. Tell me what you need and I’ll get back to you with a proposal.') ?></p>
      </div>
      <div class="ctas">
        <a class="btn btn-acc" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
        <a class="btn btn-ghost-d" href="<?= lurl('contact') ?>"><?= tr('לטופס יצירת קשר', 'Fill out the contact form') ?></a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
