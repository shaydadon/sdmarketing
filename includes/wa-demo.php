<?php
// Illustrative WhatsApp bot. Rendered only on the projects page, after Excerly.
$wa_msgs = [
    ['c', 'היי'],
    ['b', 'ברוכים הבאים לפנסיון של ג׳רי! איזה כיף שפנית אלינו 🐾 איך קוראים לך?'],
    ['c', 'הי נעים להכיר שמי יפה מרחובות'],
    ['b', 'נעים מאוד יפה! איך קוראים לכלב שלך?'],
    ['c', 'לכלבה שלי קוראים ג׳וי'],
    ['b', 'מקסים השם ג׳וי! לאילו תאריכים את מחפשת עבורה שהייה אצלנו?'],
    ['c', 'מה 12 עד ה 30 לדצמבר'],
    ['b', 'מעולה, יש מקום בתאריכים האלה! ג׳וי זכר או נקבה?'],
    ['c', 'נקבה'],
    ['b', 'נקבה, נהדר. ואיזה גזע היא?'],
    ['c', 'מעורבת'],
    ['b', 'יופי. ובת כמה ג׳וי?'],
    ['c', 'בת 9'],
    ['b', 'בסדר גמור. ומה הגודל שלה, קטנה, בינונית או גדולה?'],
    ['c', 'קטנה'],
    ['b', 'כיף, בדיוק מתאים לנו. היא מעוקרת?'],
    ['c', 'אכן'],
    ['b', 'יש לה חיסונים בתוקף?'],
    ['c', 'כן'],
    ['b', 'והאם יש לה טיפול עדכני נגד פרעושים וקרציות?'],
    ['c', 'כמובן'],
    ['b', 'יש לה אלרגיות כלשהן?'],
    ['c', 'לא'],
    ['b', 'מצוין. יש משהו לגבי מצב בריאותה או תרופות קבועות שהיא לוקחת?'],
    ['c', 'לא רק אוכל דיאטטי'],
    ['b', 'בסדר, אני רושמת שהיא אוכלת אוכל דיאטטי. איך היא מסתדרת עם כלבים אחרים?'],
    ['c', 'מעולה אין בעיות'],
    ['b', 'טוב לשמוע! והאם היה לה אי פעם איזשהו אירוע של תוקפנות?'],
    ['c', 'לא חלילה'],
    ['b', 'מעולה. ואיך נראה הלו״ז והרגלים שלה בבית, בגדול?'],
    ['c', '3 טיולים ביום הרבה פריקות אנרגיה ומשחקים'],
    ['b', 'מעולה, נשמע שג׳וי כלבה כיפית ואנרגטית! בוא נקבע פגישת היכרות - יש לי מועדים ביום שלישי 24/11 ב-16:00 או 18:00, רביעי 25/11 ב-16:00 או 18:00, וחמישי 26/11 ב-16:00 או 18:00. מה מתאים לך?'],
    ['c', 'שלישי טוב'],
    ['b', 'באיזו שעה נוח לך, 16:00 או 18:00?'],
    ['c', '4 טוב'],
    ['b', 'נהדר, קבענו פגישת היכרות ליום שלישי 24/11 בשעה 16:00. שיריון תאריכי השהייה יבוצע לאחר פגישת ההיכרות, אחרי שנכיר את ג׳וי ונראה שהכל מסתדר יפה. מחכים לראותכן, שיהיה יום נעים! 🐾'],
    ['card', ''],
];
$wa_n = count($wa_msgs);
?>
<section class="case" id="case-bot" aria-labelledby="case-bot-title">
  <div class="wrap">
    <div class="case-head">
      <div>
        <div class="case-idx"><b>03</b></div>
        <h2 id="case-bot-title" lang="en">Boardog</h2>
        <div class="tags"><span class="tag acc">אפליקציית צ׳אטבוט לבעלי פנסיונים</span></div>
      </div>
      <div>
        <p class="desc">דוגמה לצ׳אטבוט לוואטסאפ שמקבל פנייה, אוסף את הפרטים וקובע פגישה לבד.</p>
        <div class="acts">
          <a class="btn btn-ink" href="<?= e(wa_link($site, 'היי, אשמח לשמוע על צ׳אטבוט לוואטסאפ')) ?>" target="_blank" rel="noopener">לשיחה על בוט<?= icon('external') ?></a>
        </div>
      </div>
    </div>

    <div class="stage wad-stage">
      <video class="wad-video" autoplay muted loop playsinline preload="auto" poster="assets/video/boardog-chat-poster.jpg">
        <source src="assets/video/boardog-chat.webm" type="video/webm">
        <source src="assets/video/boardog-chat.mp4" type="video/mp4">
      </video>
      <div class="wad-phone" data-wa-demo>
        <div class="wad-top">
          <div class="wad-who">
            <span class="wad-av" aria-hidden="true">🐶</span>
            <span class="wad-name"><b>הפנסיון של ג׳רי</b><small>מחובר/ת</small></span>
          </div>
          <span class="wad-gear" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.7"><circle cx="12" cy="12" r="3"/><path d="M12 3.5v2.2M12 18.3v2.2M3.5 12h2.2M18.3 12h2.2M6 6l1.6 1.6M16.4 16.4 18 18M18 6l-1.6 1.6M7.6 16.4 6 18"/></svg>
          </span>
        </div>
        <div class="wad-log" data-wa-log>
          <?php foreach ($wa_msgs as $i => $m):
            $who = $m[0] === 'c' ? 'c' : 'b';
            $tail = $i === 0 || $wa_msgs[$i - 1][0] !== $m[0];
            $minute = 30 + (int) floor($i * 4 / max($wa_n - 1, 1));
            $time = sprintf('09:%02d', $minute);
          ?>
            <div class="wad-msg wad-<?= $who ?><?= $tail ? ' tail' : '' ?><?= $m[0] === 'card' ? ' card' : '' ?>" data-msg="<?= $who ?>">
              <?php if ($m[0] === 'card'): ?>
                <div class="wad-sum">
                  <b>📋 סיכום קליטה</b>
                  <p>ג׳וי · נקבה · 9 · קטנה · מעורבת</p>
                  <p>אלרגיות: אין</p>
                  <p>תאריכים מבוקשים <span class="ltr">12/12/2026–30/12/2026</span></p>
                  <p>פגישת היכרות: שלישי <span class="ltr">24/11 16:00</span></p>
                </div>
              <?php else: ?>
                <p><?= e($m[1]) ?></p>
              <?php endif; ?>
              <span class="wad-time"><?= e($time) ?><?php if ($who === 'c'): ?><svg class="wad-tick" viewBox="0 0 18 12" aria-hidden="true"><path d="M1 6.2 4.2 9.5 10.5 2.2" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/><path d="M6.2 6.2 9.4 9.5 15.7 2.2" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg><?php endif; ?></span>
            </div>
          <?php endforeach; ?>
          <div class="wad-msg wad-b typing" data-typing hidden aria-hidden="true"><span class="wad-dots"><i></i><i></i><i></i></span></div>
        </div>
        <div class="wad-compose" aria-hidden="true">
          <div class="wad-pill">
            <svg class="wad-ico" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.6"/><path d="M8.5 13.5c.8 1.2 2 1.8 3.5 1.8s2.7-.6 3.5-1.8" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="9" cy="10" r="0.8" fill="currentColor"/><circle cx="15" cy="10" r="0.8" fill="currentColor"/></svg>
            <span class="wad-ph">הקלדה...</span>
            <svg class="wad-ico" viewBox="0 0 24 24"><path d="M8 12.5 14.8 6a2 2 0 0 1 2.8 2.8L9.2 17.2a3.2 3.2 0 0 1-4.5-4.5l8.2-8.2" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            <svg class="wad-ico" viewBox="0 0 24 24"><path d="M8 8.5h8l1.2 2H19a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2h1.8l1.2-2z" fill="none" stroke="currentColor" stroke-width="1.6"/><circle cx="12" cy="14" r="2.4" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
          </div>
          <span class="wad-mic"><svg viewBox="0 0 24 24" width="20" height="20"><rect x="9" y="3" width="6" height="11" rx="3" fill="#fff"/><path d="M6.5 11.5a5.5 5.5 0 0 0 11 0M12 17.2V21" fill="none" stroke="#fff" stroke-width="1.7" stroke-linecap="round"/></svg></span>
        </div>
      </div>
    </div>
  </div>
</section>
