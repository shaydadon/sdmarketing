<?php
// Illustrative and real visuals for the services page. Demos stay labelled.
function service_visual(string $id): void
{
    if ($id === 'automations'): ?>
      <div class="visual real ex wad-svc">
        <video class="wad-video" width="382" height="532" autoplay muted loop playsinline preload="auto" poster="assets/video/boardog-chat-poster.jpg">
          <source src="assets/video/boardog-chat.webm" type="video/webm">
          <source src="assets/video/boardog-chat.mp4" type="video/mp4">
        </video>
        <span class="note">הדגמה: צ׳אטבוט לוואטסאפ לעסקים</span>
      </div>
    <?php elseif ($id === 'websites'): ?>
      <div class="visual real">
        <div class="browser" style="width:100%">
          <div class="bar"><i></i><i></i><i></i><u></u></div>
          <img src="assets/img/projects/fisha/shop-hq-c.webp" alt="צילום מסך של החנות fisha.shop" width="1600" height="929" loading="lazy" decoding="async">
        </div>
        <div class="mphone"><img src="assets/img/projects/fisha/collectibles-mc.webp" alt="החנות fisha.shop במובייל" width="780" height="1568" loading="lazy" decoding="async"></div>
        <span class="note">צילום מסך אמיתי · fisha.shop</span>
      </div>
    <?php elseif ($id === 'seo'): ?>
      <div class="visual">
        <div class="vrep">
          <p class="rep-title">תוכנית קידום · הדגמה</p>
          <div class="rw"><span>מילת מפתח</span><div class="bar2" role="img" aria-label="הדגמה: מילת מפתח ראשית, בלי נתון אמיתי"><i style="width:72%"></i></div></div>
          <div class="rw"><span>מאמר לאתר</span><div class="bar2" role="img" aria-label="הדגמה: מאמר לאתר, בלי נתון אמיתי"><i style="width:54%"></i></div></div>
          <div class="rw"><span>SEO טכני</span><div class="bar2" role="img" aria-label="הדגמה: בדיקת מהירות ומובייל, בלי נתון אמיתי"><i class="a" style="width:40%"></i></div></div>
          <div class="ft"><span>השלב הבא</span><span class="acc">מאמר לעמוד השירות</span></div>
        </div>
        <span class="note">הדגמה להמחשה · ללא נתונים אמיתיים</span>
      </div>
    <?php elseif ($id === 'pwa'): ?>
      <div class="visual real ex">
        <div class="mphone"><img src="assets/img/projects/excerly/home-m.webp" alt="צילום מסך של האפליקציה Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        <div class="mphone"><img src="assets/img/projects/excerly/workouts-m.webp" alt="צילום מסך נוסף של האפליקציה Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        <span class="note">צילום מסך אמיתי · Excerly</span>
      </div>
    <?php elseif ($id === 'campaigns'): ?>
      <div class="visual">
        <div class="vrep">
          <p class="rep-title">קמפיינים ממומנים · הדגמה</p>
          <div class="rw"><span>Google Ads</span><div class="bar2" role="img" aria-label="הדגמה: Google Ads, העמודה הארוכה, בלי נתון אמיתי"><i class="a" style="width:78%"></i></div></div>
          <div class="rw"><span>פייסבוק</span><div class="bar2" role="img" aria-label="הדגמה: קמפיין פייסבוק, עמודה בינונית, בלי נתון אמיתי"><i style="width:52%"></i></div></div>
          <div class="rw"><span>אינסטגרם</span><div class="bar2" role="img" aria-label="הדגמה: קמפיין אינסטגרם, העמודה הקצרה, בלי נתון אמיתי"><i style="width:34%"></i></div></div>
          <div class="ft"><span>מה בודקים</span><span class="acc">פניות, לא לייקים</span></div>
        </div>
        <span class="note">הדגמה להמחשה · ללא נתונים אמיתיים</span>
      </div>
    <?php endif;
}
