<?php
// Article cover composer (not deployed: content/ is excluded). Renders one 1200x630 cover per article
// from the site's own visuals. content/covers/render.js screenshots it into assets/img/articles/<slug>.webp.
// Open: /content/covers/cover.php?slug=whatsapp-chatbot
require __DIR__ . '/../../includes/icons.php';
$slug = $_GET['slug'] ?? 'whatsapp-chatbot';
$en = ($_GET['lang'] ?? 'he') === 'en';   // English covers: assets/img/articles/en/<slug>.webp
$A = '../../assets/img/';
function card(string $ic, string $title, string $sub, string $cls = '', string $style = ''): string
{
    return '<div class="card ' . $cls . '" style="' . $style . '"><span class="ic">' . icon($ic) . '</span><div><b>' . $title . '</b><small>' . $sub . '</small></div></div>';
}
?><!doctype html>
<html lang="<?= $en ? 'en' : 'he' ?>" dir="<?= $en ? 'ltr' : 'rtl' ?>">
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@500;700;800&family=IBM+Plex+Mono:wght@500&display=swap" rel="stylesheet">
<style>
  *{box-sizing:border-box;margin:0}
  :root{--ink:#0A0A0A;--accent:#C8864F;--accent2:#E8A374;--paper:#F5F4F0}
  html,body{width:1200px;height:630px;overflow:hidden;background:var(--ink);font-family:Heebo,sans-serif}
  .stage{position:relative;width:1200px;height:630px;overflow:hidden;isolation:isolate}
  .stage::before{content:"";position:absolute;inset:0;z-index:-1;background-image:linear-gradient(#ffffff0c 1px,transparent 1px),linear-gradient(90deg,#ffffff0c 1px,transparent 1px);background-size:60px 60px;mask-image:radial-gradient(ellipse at 50% 55%,#000 25%,transparent 78%)}
  .stage::after{content:"";position:absolute;z-index:-1;width:900px;height:900px;left:50%;top:60%;transform:translate(-50%,-50%);background:radial-gradient(circle,#C8864F38,transparent 60%)}
  .brand{position:absolute;bottom:34px;inset-inline-start:44px;display:flex;align-items:center;gap:10px;color:#fff;font-weight:800;font-size:22px;letter-spacing:-.02em}
  .brand .mk{width:34px;height:34px;border:1.5px solid var(--accent);border-radius:8px;display:grid;place-items:center}
  .brand .mk svg{width:20px;height:20px;color:var(--accent)}
  .brand small{font-weight:500;color:#9A9893;font-size:22px}
  .tag{position:absolute;top:36px;inset-inline-start:44px;font:500 15px 'IBM Plex Mono',monospace;color:#9A9893;letter-spacing:.06em}
  svg.glyph{width:100%;height:100%}
  .device{position:absolute;background:#0b0b0b;border-radius:44px;padding:9px;box-shadow:0 0 0 2px #3a3a3a,0 0 0 4px #1c1c1c,0 0 0 5.5px #4a4a4a,0 50px 80px -20px #000}
  .device img{display:block;width:100%;border-radius:36px;aspect-ratio:780/1690;object-fit:cover;object-position:top}
  .device::before{content:"";position:absolute;top:22px;left:50%;width:30%;height:14px;transform:translateX(-50%);background:#000;border-radius:99px;z-index:2}
  .browser{position:absolute;background:#fff;border-radius:14px;overflow:hidden;box-shadow:0 50px 90px -30px #000,0 0 0 1px #ffffff14}
  .browser .bar{height:36px;background:#1b1b1b;display:flex;align-items:center;gap:8px;padding:0 16px;direction:ltr}
  .browser .bar i{width:11px;height:11px;border-radius:50%;background:#3a3a3a}
  .browser .bar u{text-decoration:none;flex:1;margin:0 60px;height:22px;border-radius:6px;background:#2a2a2a;color:#9a9a9a;font:500 12px 'IBM Plex Mono',monospace;display:grid;place-items:center}
  .browser img{display:block;width:100%}
  .card{position:absolute;display:flex;align-items:center;gap:14px;background:#fff;border-radius:18px;padding:16px 22px 16px 26px;box-shadow:0 30px 50px -20px #000;min-width:300px}
  .card .ic{width:46px;height:46px;border-radius:50%;background:#F7E6DA;display:grid;place-items:center;flex:none;padding:11px;color:#8E4A1E}
  .card .ic.wa{background:#DCF8C6;color:#128C4B}
  .card b{display:block;font-weight:800;font-size:20px;color:var(--ink);line-height:1.2}
  .card small{font-size:15px;color:#66645F}
  .card.dk{background:#1b1b1b;box-shadow:0 0 0 1px #2f2f2f,0 30px 50px -20px #000}
  .card.dk b{color:#fff} .card.dk small{color:#9A9893}
  .card.on .ic{background:var(--accent);color:var(--ink)}
  .card.wa .ic{background:#DCF8C6;color:#128C4B}
  .wire{position:absolute;border-inline-start:2px dashed #C8864F88}
  .node{position:absolute;width:150px;height:150px;border-radius:28px;background:#161616;box-shadow:0 0 0 1px #2c2c2c,0 30px 60px -24px #000;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:12px;color:#fff;font-weight:700;font-size:17px;text-align:center}
  .node .ic{width:54px;height:54px;border-radius:16px;background:#222;padding:13px;color:var(--accent2)}
  .node.hot{background:var(--accent);color:var(--ink);box-shadow:0 30px 60px -20px #C8864F88}
  .node.hot .ic{background:#0000001a;color:var(--ink)}
  .arrow{position:absolute;height:2px;background:linear-gradient(90deg,#C8864F,#C8864F55)}
  .report{position:absolute;background:#fff;border-radius:22px;padding:28px 32px;box-shadow:0 50px 90px -30px #000;width:520px}
  .report h4{font-weight:800;font-size:22px;color:var(--ink)}
  .report .sub{font-size:15px;color:#66645F;margin-top:2px}
  .bar-row{display:grid;grid-template-columns:110px 1fr;align-items:center;gap:16px;margin-top:20px;font-weight:700;font-size:17px;color:#2e2d2b}
  .bar-row span{height:22px;border-radius:99px;background:#ECEAE4;overflow:hidden;display:block}
  .bar-row span i{display:block;height:100%;border-radius:99px;background:var(--ink)}
  .bar-row.best span i{background:var(--accent)}
  .demo{position:absolute;font-size:14px;color:#9A9893}
  .form{position:absolute;background:#fff;border-radius:20px;padding:24px;width:300px;box-shadow:0 40px 70px -25px #000}
  .form b{font-weight:800;font-size:20px;color:var(--ink)}
  .form .fld{height:44px;border:1.5px solid #E2E0DA;border-radius:12px;margin-top:12px;display:flex;align-items:center;padding:0 14px;color:#8a8883;font-size:15px}
  .form .go{height:48px;border-radius:99px;background:var(--accent);margin-top:16px;display:grid;place-items:center;font-weight:800;font-size:17px;color:var(--ink)}
  .chip{position:absolute;background:#fff;border-radius:99px;padding:12px 20px;font-weight:800;font-size:17px;color:var(--ink);display:flex;align-items:center;gap:10px;box-shadow:0 24px 40px -18px #000}
  .chip .ic{width:28px;height:28px;border-radius:50%;background:var(--accent);padding:6px;color:var(--ink)}
  .serp{position:absolute;background:#fff;border-radius:22px;padding:22px 26px 26px;box-shadow:0 50px 90px -30px #000;width:560px}
  .serp .q{display:flex;align-items:center;gap:12px;height:50px;border:1.5px solid #E2E0DA;border-radius:99px;padding:0 20px;font-weight:700;font-size:18px;color:var(--ink)}
  .serp .q svg{width:22px;height:22px;color:#8a8883;flex:none}
  .serp .res{margin-top:20px;padding:16px 18px;border-radius:16px;background:#FBF6F1;box-shadow:inset 0 0 0 1.5px #C8864F66}
  .serp .site{font:500 14px 'IBM Plex Mono',monospace;color:#66645F;direction:ltr;text-align:start}
  .serp .t{font-weight:800;font-size:21px;color:#7A4E2A;margin-top:4px;line-height:1.3}
  .serp .d{font-size:15px;color:#55534e;margin-top:6px;line-height:1.45}
  .serp .ghost{margin-top:16px;padding:0 18px}
  .serp .ghost i{display:block;height:12px;border-radius:99px;background:#ECEAE4;margin-top:10px}
  .gsc{position:absolute;background:#1b1b1b;border-radius:20px;padding:20px 22px;width:300px;box-shadow:0 0 0 1px #2f2f2f,0 40px 70px -25px #000;color:#fff}
  .gsc b{font-weight:800;font-size:17px}.gsc small{display:block;color:#9A9893;font-size:14px;margin-top:2px}
  .gsc svg.ln{display:block;width:100%;height:90px;margin-top:14px}
</style>
</head>
<body>
<div class="stage">
  <span class="brand"><span class="mk"><?= icon('logo') ?></span><span>SD<small>marketing</small></span></span>
<?php if ($slug === 'whatsapp-chatbot'): ?>
  <span class="tag">WHATSAPP CHATBOT</span>
  <div class="device" style="left:450px;top:60px;width:300px"><img src="<?= $A ?>projects/boardog/chat-end.webp" alt=""></div>
  <?= card('whatsapp', 'היי, אפשר לקבוע?', 'הודעה חדשה · 02:14', 'wa', 'left:800px;top:120px') ?>
  <?= card('calendar', 'הפגישה נקבעה', 'יום ג׳ · 16:00', 'on', 'left:110px;top:230px') ?>
  <?= card('database', 'ליד חדש נשמר', 'סיכום קליטה נשלח', '', 'left:800px;top:360px') ?>
<?php elseif ($slug === 'stop-losing-leads'): ?>
  <span class="tag">LEADS</span>
  <div class="wire" style="left:599px;top:80px;height:450px"></div>
  <?= card('whatsapp', 'הודעה חדשה בוואטסאפ', 'היי, כמה זה עולה? · 23:40', 'dk wa', 'left:640px;top:84px;min-width:380px') ?>
  <?= card('mail', 'טופס מהאתר', 'שם וטלפון התקבלו', 'dk', 'left:180px;top:190px;min-width:380px') ?>
  <?= card('check', 'מענה נשלח תוך דקה', 'אישור אוטומטי ללקוח', 'on', 'left:640px;top:296px;min-width:380px') ?>
  <?= card('database', 'הליד נשמר בטבלה', 'מקור: קמפיין בגוגל', '', 'left:180px;top:402px;min-width:380px') ?>
<?php elseif ($slug === 'small-business-automations'): ?>
  <span class="tag">AUTOMATIONS</span>
  <div class="node" style="left:955px;top:220px"><span class="ic"><?= icon('mail') ?></span>טופס באתר</div>
  <div class="arrow" style="left:815px;top:295px;width:130px"></div>
  <div class="node hot" style="left:655px;top:220px"><span class="ic"><?= icon('flow') ?></span>אוטומציה</div>
  <div class="arrow" style="left:515px;top:295px;width:130px"></div>
  <div class="node" style="left:355px;top:110px"><span class="ic"><?= icon('database') ?></span>נשמר ב-CRM</div>
  <div class="node" style="left:355px;top:330px"><span class="ic"><?= icon('calendar') ?></span>תזכורת לפגישה</div>
  <div class="node" style="left:95px;top:220px"><span class="ic"><?= icon('check') ?></span>מייל המשך</div>
  <div class="arrow" style="left:255px;top:295px;width:90px"></div>
<?php elseif ($slug === 'pwa-vs-app-store'): ?>
  <span class="tag">PWA</span>
  <div class="device" style="left:330px;top:90px;width:250px"><img src="<?= $A ?>projects/excerly/home-m.webp" alt=""></div>
  <div class="device" style="left:620px;top:40px;width:280px"><img src="<?= $A ?>projects/excerly/session-m.webp" alt=""></div>
  <span class="chip" style="left:90px;top:300px"><span class="ic"><?= icon('phone') ?></span>הוספה למסך הבית</span>
  <span class="chip" style="left:930px;top:210px"><span class="ic"><?= icon('check') ?></span>בלי חנות</span>
<?php elseif ($slug === 'landing-page'): ?>
  <span class="tag">LANDING PAGE</span>
  <div class="browser" style="left:400px;top:80px;width:640px"><div class="bar"><i></i><i></i><i></i><u>fisha.shop</u></div><img src="<?= $A ?>projects/fisha/originals-main.webp" alt=""></div>
  <div class="form" style="left:150px;top:200px"><b>השאירו פרטים</b><div class="fld">שם מלא</div><div class="fld">טלפון</div><div class="go">שלחו</div></div>
<?php elseif ($slug === 'conversion-tracking'): ?>
  <span class="tag">CONVERSION TRACKING</span>
  <div class="report" style="left:340px;top:110px">
    <h4>פניות לפי מקור</h4><div class="sub">החודש · כל פנייה נספרת</div>
    <div class="bar-row best"><b>חיפוש בגוגל</b><span><i style="width:86%"></i></span></div>
    <div class="bar-row"><b>אינסטגרם</b><span><i style="width:58%"></i></span></div>
    <div class="bar-row"><b>פייסבוק</b><span><i style="width:34%"></i></span></div>
    <div class="bar-row"><b>אורגני</b><span><i style="width:47%"></i></span></div>
  </div>
  <span class="chip" style="left:880px;top:420px"><span class="ic"><?= icon('chart') ?></span>מה מביא לקוחות</span>
  <span class="demo" style="left:360px;top:470px">הדגמה להמחשה</span>
<?php elseif ($slug === 'seo-for-small-business'): ?>
  <span class="tag">SEO</span>
  <div class="serp" style="<?= $en ? 'left:110px' : 'left:530px' ?>;top:96px">
    <div class="q"><?= icon('search') ?><?= $en ? 'plumber near me' : 'חשמלאי בחולון' ?></div>
    <div class="res"><div class="site"><?= $en ? 'yourbusiness.com' : 'yourbusiness.co.il' ?> › services</div><div class="t"><?= $en ? 'Emergency Plumber · Same-Day Service' : 'חשמלאי מוסמך בחולון · מגיע עוד היום' ?></div><div class="d"><?= $en ? 'Licensed plumber serving your area. Call or message us on WhatsApp.' : 'חשמלאי מוסמך באזור חולון ובת ים. התקשרו או שלחו הודעה בוואטסאפ.' ?></div></div>
    <div class="ghost"><i style="width:40%"></i><i style="width:85%"></i><i style="width:70%"></i></div>
  </div>
  <div class="gsc" style="<?= $en ? 'left:740px' : 'left:150px' ?>;top:150px"><b><?= $en ? 'Clicks from Google' : 'קליקים מגוגל' ?></b><small><?= $en ? 'Last 6 months' : '6 חודשים אחרונים' ?></small>
    <svg class="ln" viewBox="0 0 260 90" preserveAspectRatio="none" aria-hidden="true"><polyline points="0,82 40,78 80,72 120,64 160,50 200,38 260,14" fill="none" stroke="#C8864F" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><polyline points="0,86 40,84 80,82 120,78 160,72 200,66 260,56" fill="none" stroke="#555" stroke-width="3" stroke-linecap="round"/></svg>
  </div>
  <span class="chip" style="<?= $en ? 'left:760px' : 'left:170px' ?>;top:400px"><span class="ic"><?= icon('check') ?></span>Core Web Vitals</span>
  <span class="demo" style="<?= $en ? 'left:740px' : 'left:150px' ?>;top:470px"><?= $en ? 'Illustration' : 'הדגמה להמחשה' ?></span>
<?php endif; ?>
</div>
</body>
</html>
