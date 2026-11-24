</main>

<footer>
  <div class="wrap">
    <div class="f-cols">
      <div>
        <a class="logo" href="index.php" aria-label="SDmarketing, לדף הבית">
          <?= logo_mark() ?>
          <span class="lt"><b>SD</b><small>marketing</small></span>
        </a>
        <p class="about">אוטומציות, אתרים, אפליקציות ושיווק דיגיטלי לעסקים. מתוכנן, בנוי ומנוהל על ידי אדם אחד.</p>
      </div>

      <nav aria-label="ניווט בתחתית">
        <h2>ניווט</h2>
        <ul>
          <?php foreach ($nav as $item): ?>
            <li><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <div>
        <h2>יצירת קשר</h2>
        <ul>
          <li><a href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">וואטסאפ</a></li>
          <li><a href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>" class="ltr"><?= e($site['phone']) ?></a></li>
          <li><a href="mailto:<?= e($site['email']) ?>" class="ltr"><?= e($site['email']) ?></a></li>
        </ul>
      </div>
    </div>
    <div class="f-bot">
      <span><span class="ltr">© <?= date('Y') ?> SDmarketing</span>. כל הזכויות שמורות.</span>
      <nav aria-label="מסמכים">
        <a href="terms.php">תקנון ותנאי שימוש</a>
        <a href="privacy.php">מדיניות פרטיות</a>
        <a href="accessibility.php">הצהרת נגישות</a>
      </nav>
    </div>
  </div>
</footer>

<aside aria-label="יצירת קשר מהירה"><a class="wa-float" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener" aria-label="דברו איתי בוואטסאפ"><?= icon('whatsapp') ?></a></aside>

<script src="assets/js/main.js?v=80" defer></script>
</body>
</html>
