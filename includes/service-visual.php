<?php
// Illustrative and real visuals for the services page. Demos stay labelled.
function service_visual(string $id): void
{
    if ($id === 'automations'): ?>
      <div class="visual real ex wad-svc">
        <video class="wad-video" autoplay muted loop playsinline preload="auto" poster="assets/video/boardog-chat-poster.jpg">
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
    <?php elseif ($id === 'pwa'): ?>
      <div class="visual real ex">
        <div class="mphone"><img src="assets/img/projects/excerly/home-m.webp" alt="צילום מסך של האפליקציה Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        <div class="mphone"><img src="assets/img/projects/excerly/workouts-m.webp" alt="צילום מסך נוסף של האפליקציה Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        <span class="note">צילום מסך אמיתי · Excerly</span>
      </div>
    <?php else: ?>
      <div class="visual">
        <div class="vrep">
          <p class="rep-title">דוח חודשי · מה עבד, מה לא ומה הלאה</p>
          <div class="rw"><span>קמפיין גוגל</span><div class="bar2" role="img" aria-label="הדגמה: קמפיין גוגל, העמודה הארוכה"><i class="a" style="width:78%"></i></div></div>
          <div class="rw"><span>קמפיין מטא</span><div class="bar2" role="img" aria-label="הדגמה: קמפיין מטא, עמודה בינונית"><i style="width:52%"></i></div></div>
          <div class="rw"><span>ריטרגטינג</span><div class="bar2" role="img" aria-label="הדגמה: ריטרגטינג, העמודה הקצרה"><i style="width:34%"></i></div></div>
          <div class="ft"><span>פניות לפי מקור</span><span class="acc">החודש הבא: להגדיל את גוגל</span></div>
        </div>
        <span class="note">הדגמה להמחשה · ללא נתונים אמיתיים</span>
      </div>
    <?php endif;
}
