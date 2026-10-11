</main>

<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="brand" href="index.php" aria-label="SDmarketing, לדף הבית">
        <?= logo_mark() ?>
        <span class="brand-word"><b>SD</b>marketing</span>
      </a>
      <p>אוטומציות, אתרים, אפליקציות ושיווק דיגיטלי לעסקים: מתוכנן, בנוי ומנוהל על ידי אדם אחד.</p>
    </div>

    <nav class="footer-col" aria-label="ניווט בתחתית">
      <h2>ניווט</h2>
      <ul>
        <?php foreach ($nav as $item): ?>
          <li><a href="<?= e($item['href']) ?>"><?= e($item['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </nav>


    <div class="footer-col">
      <h2>יצירת קשר</h2>
      <ul class="footer-contact">
        <li><a href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>וואטסאפ</a></li>
        <li><a href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>"><?= icon('phone') ?><span dir="ltr"><?= e($site['phone']) ?></span></a></li>
        <li><a href="mailto:<?= e($site['email']) ?>"><?= icon('mail') ?><span dir="ltr"><?= e($site['email']) ?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="container footer-base">
    <p>© <?= date('Y') ?> SDmarketing. כל הזכויות שמורות.</p>
    <ul class="footer-legal">
      <li><a href="terms.php">תקנון ותנאי שימוש</a></li>
      <li><a href="privacy.php">מדיניות פרטיות</a></li>
      <li><a href="accessibility.php">הצהרת נגישות</a></li>
    </ul>
  </div>
</footer>

<a class="wa-float" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener" aria-label="דברו איתי בוואטסאפ"><?= icon('whatsapp') ?></a>

<script src="assets/js/main.js?v=15" defer></script>
</body>
</html>
