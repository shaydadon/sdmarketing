</main>

<footer>
  <div class="wrap">
    <div class="f-cols">
      <div>
        <a class="logo" href="<?= lurl('') ?>" aria-label="<?= tr('SDmarketing, לדף הבית', 'SDmarketing, home page') ?>">
          <?= logo_mark() ?>
          <span class="lt"><b>SD</b><small>marketing</small></span>
        </a>
        <p class="about"><?= tr('אוטומציות, אתרים, אפליקציות, קידום אורגני וקמפיינים ממומנים לעסקים. מתוכנן, בנוי ומנוהל על ידי אדם אחד.', 'Automations, websites, apps, SEO and paid campaigns for businesses. Planned, built and run by one person.') ?></p>
      </div>

      <nav aria-label="<?= tr('ניווט בתחתית', 'Footer') ?>">
        <h2><?= tr('ניווט', 'Pages') ?></h2>
        <ul>
          <?php foreach ($nav as $item): ?>
            <li><a href="<?= e(lurl($item['href'])) ?>"><?= e($item['label']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </nav>

      <div>
        <h2><?= tr('יצירת קשר', 'Get in touch') ?></h2>
        <ul>
          <li><a href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= tr('וואטסאפ', 'WhatsApp') ?></a></li>
          <li><a href="tel:<?= e(preg_replace('/\D/', '', $site['phone'])) ?>" class="ltr"><?= e($site['phone_display']) ?></a></li>
          <li><a href="mailto:<?= e($site['email']) ?>" class="ltr"><?= e($site['email']) ?></a></li>
        </ul>
      </div>
    </div>
    <div class="f-bot">
      <span><span class="ltr">© <?= date('Y') ?> SDmarketing</span>. <?= tr('כל הזכויות שמורות.', 'All rights reserved.') ?></span>
      <nav aria-label="<?= tr('מסמכים', 'Legal') ?>">
        <a href="<?= lurl('terms') ?>"><?= tr('תקנון ותנאי שימוש', 'Terms of use') ?></a>
        <a href="<?= lurl('privacy') ?>"><?= tr('מדיניות פרטיות', 'Privacy policy') ?></a>
        <a href="<?= lurl('accessibility') ?>"><?= tr('הצהרת נגישות', 'Accessibility') ?></a>
      </nav>
    </div>
  </div>
</footer>

<aside aria-label="<?= tr('יצירת קשר מהירה', 'Quick contact') ?>"><a class="wa-float" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener" aria-label="<?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?>"><?= icon('whatsapp') ?></a></aside>

<script src="<?= url('assets/js/main.js?v=120') ?>" defer></script>
</body>
</html>
