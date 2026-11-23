<?php
// Illustrative and real visuals for the services page. Demos stay labelled.
function service_visual(string $id): void
{
    if ($id === 'automations'): ?>
      <div class="visual">
        <div class="vflow">
          <div class="node"><i><?= icon('whatsapp') ?></i><div>הודעה נכנסת<small>וואטסאפ · 02:14 בלילה</small></div></div>
          <div class="wire"></div>
          <div class="node"><i><?= icon('flow') ?></i><div>הבוט מסנן<small>שואל, מבין, קובע תור</small></div></div>
          <div class="wire"></div>
          <div class="node"><i><?= icon('database') ?></i><div>ליד ב־CRM<small>מתויג לפי מקור</small></div></div>
          <div class="wire"></div>
          <div class="node hl"><i><?= icon('mail') ?></i><div>מייל המשך<small>נשלח אוטומטית</small></div></div>
        </div>
        <span class="note">הדגמה להמחשה</span>
      </div>
    <?php elseif ($id === 'websites'): ?>
      <div class="visual real">
        <div class="browser" style="width:100%">
          <div class="bar"><i></i><i></i><i></i><u>fisha.shop/shop</u></div>
          <img src="assets/img/projects/fisha/shop-hq-c.webp" alt="עמוד החנות של fisha.shop" width="1600" height="929" loading="lazy" decoding="async">
        </div>
        <div class="mphone"><img src="assets/img/projects/fisha/collectibles-mc.webp" alt="fisha.shop במובייל, קטגוריית Collectibles" width="780" height="1568" loading="lazy" decoding="async"></div>
        <span class="note">צילום מסך אמיתי · fisha.shop</span>
      </div>
    <?php elseif ($id === 'pwa'): ?>
      <div class="visual real ex">
        <div class="mphone"><img src="assets/img/projects/excerly/home-m.webp" alt="מסך היום באפליקציית Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
        <div class="mphone"><img src="assets/img/projects/excerly/workouts-m.webp" alt="מסך האימונים באפליקציית Excerly" width="780" height="1688" loading="lazy" decoding="async"></div>
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
