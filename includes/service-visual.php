<?php
// Illustrative and real visuals for the services page. Demos stay labelled.
function service_visual(string $id): void
{
    if ($id === 'automations'): ?>
      <div class="visual real ex wad-svc">
        <video class="wad-video" width="382" height="532" autoplay muted loop playsinline preload="auto" poster="<?= url('assets/video/boardog-chat-poster.jpg') ?>">
          <source src="<?= url('assets/video/boardog-chat.webm') ?>" type="video/webm">
          <source src="<?= url('assets/video/boardog-chat.mp4') ?>" type="video/mp4">
        </video>
        <span class="note"><?= tr('הדגמה: צ׳אטבוט לוואטסאפ לעסקים', 'Demo: a WhatsApp chatbot in action (conversation in Hebrew)') ?></span>
      </div>
    <?php elseif ($id === 'websites'): ?>
      <div class="visual real">
        <div class="browser" style="width:100%">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img src="<?= url('assets/img/projects/fisha/shop-hq-c.webp') ?>" alt="<?= tr('צילום מסך של החנות fisha.shop', 'Screenshot of the fisha.shop store') ?>" width="1600" height="929" loading="lazy" decoding="async">
        </div>
        <div class="mphone"><img src="<?= url('assets/img/projects/fisha/collectibles-mc.webp') ?>" alt="<?= tr('החנות fisha.shop במובייל', 'The fisha.shop store on mobile') ?>" width="780" height="1568" loading="lazy" decoding="async"></div>
        <span class="note"><?= tr('צילום מסך אמיתי', 'Real screenshot') ?> · fisha.shop</span>
      </div>
    <?php elseif ($id === 'seo'): ?>
      <div class="visual">
        <div class="vrep">
          <p class="rep-title"><?= tr('תוכנית קידום · הדגמה', 'SEO plan · Demo') ?></p>
          <div class="rw"><span><?= tr('מילת מפתח', 'Keyword research') ?></span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: מילת מפתח ראשית, בלי נתון אמיתי', 'Demo: main keyword, no real data') ?>"><i style="width:72%"></i></div></div>
          <div class="rw"><span><?= tr('מאמר לאתר', 'Content') ?></span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: מאמר לאתר, בלי נתון אמיתי', 'Demo: site article, no real data') ?>"><i style="width:54%"></i></div></div>
          <div class="rw"><span><?= tr('SEO טכני', 'Technical SEO') ?></span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: בדיקת מהירות ומובייל, בלי נתון אמיתי', 'Demo: speed and mobile check, no real data') ?>"><i class="a" style="width:40%"></i></div></div>
          <div class="ft"><span><?= tr('השלב הבא', 'Next step') ?></span><span class="acc"><?= tr('מאמר לעמוד השירות', 'Service page article') ?></span></div>
        </div>
        <span class="note"><?= tr('הדגמה להמחשה · ללא נתונים אמיתיים', 'Illustration only · No real data') ?></span>
      </div>
    <?php elseif ($id === 'pwa'): ?>
      <div class="visual real ex">
        <div class="mphone"><img src="<?= url('assets/img/projects/excerly/home-m.webp') ?>" alt="<?= tr('צילום מסך של האפליקציה Excerly', 'Screenshot of the Excerly app') ?>" width="780" height="1688" loading="lazy" decoding="async"></div>
        <div class="mphone"><img src="<?= url('assets/img/projects/excerly/workouts-m.webp') ?>" alt="<?= tr('צילום מסך נוסף של האפליקציה Excerly', 'Another screenshot of the Excerly app') ?>" width="780" height="1688" loading="lazy" decoding="async"></div>
        <span class="note"><?= tr('צילום מסך אמיתי', 'Real screenshot') ?> · Excerly</span>
      </div>
    <?php elseif ($id === 'campaigns'): ?>
      <div class="visual">
        <div class="vrep">
          <p class="rep-title"><?= tr('קמפיינים ממומנים · הדגמה', 'Paid ads · Demo') ?></p>
          <div class="rw"><span>Google Ads</span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: Google Ads, העמודה הארוכה, בלי נתון אמיתי', 'Demo: Google Ads, the longest bar, no real data') ?>"><i class="a" style="width:78%"></i></div></div>
          <div class="rw"><span><?= tr('פייסבוק', 'Facebook') ?></span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: קמפיין פייסבוק, עמודה בינונית, בלי נתון אמיתי', 'Demo: Facebook campaign, a medium bar, no real data') ?>"><i style="width:52%"></i></div></div>
          <div class="rw"><span><?= tr('אינסטגרם', 'Instagram') ?></span><div class="bar2" role="img" aria-label="<?= tr('הדגמה: קמפיין אינסטגרם, העמודה הקצרה, בלי נתון אמיתי', 'Demo: Instagram campaign, the shortest bar, no real data') ?>"><i style="width:34%"></i></div></div>
          <div class="ft"><span><?= tr('מה בודקים', 'What we measure') ?></span><span class="acc"><?= tr('פניות, לא לייקים', 'Leads, not likes') ?></span></div>
        </div>
        <span class="note"><?= tr('הדגמה להמחשה · ללא נתונים אמיתיים', 'Illustration only · No real data') ?></span>
      </div>
    <?php endif;
}
