<?php
// Small illustrated scene for each service, drawn in HTML/CSS (used on the homepage tabs and services.php).
function service_visual(string $id): void
{
    if ($id === 'automations'): ?>
      <div class="viz-flow">
        <span class="vf vf-a"><?= icon('whatsapp') ?>הודעה נכנסת</span>
        <span class="vf vf-b"><?= icon('bot') ?>הבוט מסנן</span>
        <span class="vf vf-c"><?= icon('database') ?>ליד ב־CRM</span>
        <span class="vf vf-d"><?= icon('mail') ?>מייל המשך</span>
      </div>
    <?php elseif ($id === 'websites'): ?>
      <div class="viz-browser">
        <div class="vb-bar"><i></i><i></i><i></i><span dir="ltr">yourbusiness.co.il</span></div>
        <div class="vb-body">
          <div class="vb-hero"><b></b><b></b><span>השאירו פרטים</span></div>
          <div class="vb-row"><i></i><i></i><i></i></div>
        </div>
      </div>
    <?php elseif ($id === 'pwa'): ?>
      <div class="viz-pwa">
        <div class="vp-phone">
          <div class="vp-grid"><i></i><i></i><i></i><i></i><i class="is-app"><?= logo_mark('vp-mark') ?></i><i></i><i></i><i></i></div>
          <div class="vp-toast"><b>להוסיף למסך הבית?</b><span>התקנה</span></div>
        </div>
      </div>
    <?php else: ?>
      <div class="viz-chart">
        <div class="vc-bars"><i style="--h:28%"></i><i style="--h:40%"></i><i style="--h:36%"></i><i style="--h:55%"></i><i style="--h:68%"></i><i style="--h:86%"></i></div>
        <svg viewBox="0 0 300 160" class="vc-line" preserveAspectRatio="none"><path d="M0 140 C 80 130, 140 100, 300 18"/></svg>
      </div>
    <?php endif;
}
