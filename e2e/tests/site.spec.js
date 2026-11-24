// @ts-check
const { test, expect } = require('@playwright/test');
const AxeBuilder = require('@axe-core/playwright').default;

const PAGES = [
  { path: '/', name: 'home' },
  { path: '/services', name: 'services' },
  { path: '/projects', name: 'projects' },
  { path: '/about', name: 'about' },
  { path: '/contact', name: 'contact' },
  { path: '/articles', name: 'articles' },
  { path: '/articles/whatsapp-chatbot', name: 'article' },
  { path: '/terms', name: 'terms' },
  { path: '/privacy', name: 'privacy' },
  { path: '/accessibility', name: 'accessibility' },
];
const WA_NUMBER = '972526203423';

/** Collect console errors and failed requests while a page is open. */
function watchErrors(page) {
  const errors = [];
  page.on('console', (msg) => { if (msg.type() === 'error') errors.push(`console: ${msg.text()}`); });
  page.on('pageerror', (err) => errors.push(`pageerror: ${err.message}`));
  page.on('response', (res) => {
    if (res.status() >= 400 && res.url().startsWith('http://localhost')) errors.push(`${res.status()} ${res.url()}`);
  });
  return errors;
}

/** Reveal-on-scroll hides sections until they enter the viewport; show everything for checks/screenshots. */
async function revealAll(page) {
  await page.evaluate(async () => {
    document.querySelectorAll('.reveal').forEach((el) => el.classList.add('is-in'));
    // lazy images only load when scrolled into view; load them now so checks and screenshots see them
    const lazy = [...document.querySelectorAll('img[loading="lazy"]')];
    lazy.forEach((img) => { img.loading = 'eager'; });
    await Promise.all(lazy.map((img) => (img.complete ? null : new Promise((r) => { img.onload = img.onerror = r; }))));
  });
  await page.waitForTimeout(700);
}

test.describe('every page', () => {
  for (const p of PAGES) {
    test(`${p.name}: loads cleanly`, async ({ page }) => {
      const errors = watchErrors(page);
      const res = await page.goto(p.path);
      expect(res?.status()).toBe(200);

      await expect(page.locator('html')).toHaveAttribute('lang', 'he');
      await expect(page.locator('html')).toHaveAttribute('dir', 'rtl');
      await expect(page).toHaveTitle(/SDmarketing/);
      await expect(page.locator('h1')).toHaveCount(1);
      if (!['home', 'projects', 'article'].includes(p.name)) await expect(page.locator('body')).not.toContainText('Boardog');
      await expect(page.locator('body')).not.toContainText('10+');
      await expect(page.locator('body')).not.toContainText('יותר מעשר');
      await expect(page.locator('meta[name="description"]')).toHaveAttribute('content', /.{20,}/);
      await expect(page.locator('.skip-link')).toHaveAttribute('href', '#main');

      await revealAll(page);
      const overflow = await page.evaluate(() => document.documentElement.scrollWidth - document.documentElement.clientWidth);
      expect(overflow, 'page scrolls sideways').toBe(0);

      const brokenImages = await page.evaluate(() =>
        [...document.images].filter((img) => img.complete && img.naturalWidth === 0).map((img) => img.src));
      expect(brokenImages).toEqual([]);

      expect(errors, errors.join('\n')).toEqual([]);
    });

    test(`${p.name}: internal links resolve`, async ({ page, request }) => {
      await page.goto(p.path);
      const hrefs = await page.evaluate(() => [...new Set(
        [...document.querySelectorAll('a[href]')]
          .map((a) => a.getAttribute('href'))
          .filter((h) => h && !/^(https?:|mailto:|tel:|#)/.test(h))
          .map((h) => h.split('#')[0])
          .filter(Boolean),
      )]);
      for (const href of hrefs) {
        const res = await request.get(`/${href.replace(/^\//, '')}`);
        expect(res.status(), `${href} on ${p.path}`).toBe(200);
      }
    });

    test(`${p.name}: no serious accessibility violations`, async ({ page }) => {
      await page.goto(p.path);
      await revealAll(page);
      const results = await new AxeBuilder({ page })
        .withTags(['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa'])
        .exclude('.hp') // contact-form honeypot, hidden from people on purpose
        .analyze();
      const serious = results.violations.filter((v) => ['serious', 'critical'].includes(v.impact || ''));
      const summary = serious.map((v) => `${v.id} (${v.impact}): ${v.help}\n  ${v.nodes.slice(0, 3).map((n) => n.target.join(' ')).join('\n  ')}`);
      expect(serious, summary.join('\n')).toEqual([]);
    });

    test(`${p.name}: full-page screenshot`, async ({ page }, testInfo) => {
      await page.emulateMedia({ reducedMotion: 'reduce' });
      await page.goto(p.path);
      await revealAll(page);
      await page.screenshot({ path: `screenshots/${testInfo.project.name}/${p.name}.png`, fullPage: true });
    });
  }

  test('unknown page shows the branded 404', async ({ page }) => {
    const res = await page.goto('/404.php');
    expect(res?.status()).toBe(404);
    await expect(page.locator('h1')).toContainText('העמוד הזה לא קיים');
    await expect(page.locator('meta[name="robots"]')).toHaveAttribute('content', 'noindex');
  });
});

test.describe('navigation', () => {
  test('current page is marked in the menu', async ({ page, isMobile }) => {
    await page.goto('/services');
    const nav = isMobile ? page.locator('[data-mobile-nav]') : page.locator('[data-nav]');
    if (isMobile) await page.locator('[data-nav-toggle]').click();
    await expect(nav.locator('a[aria-current="page"]')).toHaveText(/שירותים/);
  });

  test('mobile menu opens, focuses, and closes with Escape', async ({ page, isMobile }) => {
    test.skip(!isMobile, 'mobile only');
    await page.goto('/');
    const toggle = page.locator('[data-nav-toggle]');
    const menu = page.locator('[data-mobile-nav]');
    await expect(menu).toBeHidden();
    await toggle.click();
    await expect(menu).toBeVisible();
    await expect(toggle).toHaveAttribute('aria-expanded', 'true');
    await expect(menu.locator('a').first()).toBeFocused();
    await page.keyboard.press('Escape');
    await expect(menu).toBeHidden();
    await expect(toggle).toBeFocused();
  });

  test('every WhatsApp link goes to the business number', async ({ page }) => {
    for (const p of PAGES) {
      await page.goto(p.path);
      const links = await page.locator('a[href*="wa.me"]').evaluateAll((as) => as.map((a) => a.getAttribute('href')));
      expect(links.length, p.path).toBeGreaterThan(0);
      for (const href of links) expect(href).toContain(`wa.me/${WA_NUMBER}?text=`);
    }
  });
});

test.describe('clean URLs', () => {
  const OLD_TO_NEW = [
    ['/index.php', '/'],
    ['/services.php', '/services'],
    ['/projects.php', '/projects'],
    ['/articles.php', '/articles'],
    ['/about.php', '/about'],
    ['/contact.php', '/contact'],
    ['/terms.php', '/terms'],
    ['/privacy.php', '/privacy'],
    ['/accessibility.php', '/accessibility'],
    ['/article.php?slug=landing-page', '/articles/landing-page'],
    ['/services/', '/services'],
  ];
  for (const [from, to] of OLD_TO_NEW) {
    test(`${from} moves permanently to ${to}`, async ({ request }) => {
      const res = await request.get(from, { maxRedirects: 0 });
      expect(res.status()).toBe(301);
      expect(new URL(res.headers()['location'], 'http://x').pathname).toBe(to);
    });
  }

  test('every internal link on every page is clean (no .php, no ?slug=)', async ({ page }) => {
    for (const path of ['/', '/services', '/projects', '/articles', '/articles/whatsapp-chatbot', '/about', '/contact', '/terms']) {
      await page.goto(path);
      const bad = await page.evaluate(() => [...document.querySelectorAll('a[href]')]
        .map((a) => a.getAttribute('href'))
        .filter((h) => !/^(https?:|mailto:|tel:|#)/.test(h) && (/\.php/.test(h) || /\?slug=/.test(h))));
      expect(bad, path).toEqual([]);
      const canonical = await page.locator('link[rel="canonical"]').getAttribute('href');
      expect(canonical, path).not.toMatch(/\.php|\?slug=/);
    }
  });
});

test.describe('articles', () => {
  test('the list links to every article, and each article has its FAQ and structured data', async ({ page }) => {
    await page.goto('/articles');
    const cards = page.locator('.post-card a');
    await expect(cards).toHaveCount(6);
    const hrefs = await cards.evaluateAll((as) => as.map((a) => a.getAttribute('href')));
    for (const href of hrefs) {
      const res = await page.goto(href);
      expect(res.status()).toBe(200);
      await expect(page.locator('h1')).toBeVisible();
      await expect(page.locator('.post-body h2').first()).toBeVisible();
      const types = await page.locator('script[type="application/ld+json"]').evaluateAll((ss) => ss.map((x) => JSON.parse(x.textContent)['@type']));
      expect(types).toEqual(expect.arrayContaining(['Article', 'BreadcrumbList', 'FAQPage']));
      await expect(page.locator('body')).not.toContainText('—');
    }
  });

  test('the menu starts with Services, has no Home item, and Articles is a plain link', async ({ page, isMobile }) => {
    await page.goto('/');
    if (isMobile) await page.locator('[data-nav-toggle]').click();
    const links = page.locator(isMobile ? '.mobile-nav > ul > li > a' : '[data-nav] a');
    await expect(links).toHaveText([/שירותים/, /פרויקטים/, /מאמרים/, /אודות/, /צור קשר/]);
    await expect(page.locator('.mobile-nav .mn-sub')).toHaveCount(0);
    await links.nth(2).click();
    await expect(page).toHaveURL(/\/articles$/);
    await expect(page.locator('header a.logo')).toHaveAttribute('href', '/');
  });

  test('topic filters show only that topic, and each article names its author and date', async ({ page }) => {
    await page.goto('/articles');
    const visible = page.locator('.post-card:visible');
    await expect(visible).toHaveCount(6);
    await page.getByRole('button', { name: /אפליקציות/ }).click();
    await expect(visible).toHaveCount(1);
    await page.getByRole('button', { name: /אוטומציות/ }).click();
    await expect(visible).toHaveCount(3);
    await page.getByRole('button', { name: /הכל/ }).click();
    await expect(visible).toHaveCount(6);

    await page.goto('/articles/landing-page');
    await expect(page.locator('.byline')).toContainText('שי דדון');
    await expect(page.locator('.byline time')).toHaveAttribute('datetime', /^\d{4}-\d{2}-\d{2}$/);
    await expect(page.locator('.author-box')).toContainText('SEO');
    const art = await page.locator('script[type="application/ld+json"]').evaluateAll((ss) => ss.map((x) => JSON.parse(x.textContent)).find((d) => d['@type'] === 'Article'));
    expect(art.author.name).toBe('שי דדון');
    expect(art.datePublished).toMatch(/^\d{4}-\d{2}-\d{2}$/);
  });

  test('an unknown article returns 404', async ({ page }) => {
    const res = await page.goto('/articles/does-not-exist');
    expect(res.status()).toBe(404);
  });
});

test.describe('hero buttons', () => {
  for (const path of ['/', '/about', '/services', '/projects', '/contact']) {
    test(`${path}: every hero link is clickable (no decoration on top)`, async ({ page }) => {
      await page.goto(path);
      const blocked = await page.evaluate(() => [...document.querySelectorAll('main section:first-of-type a')]
        .filter((a) => a.getClientRects().length)
        .filter((a) => {
          a.scrollIntoView({ block: 'center', behavior: 'instant' });
          const r = a.getBoundingClientRect();
          const t = document.elementFromPoint(r.x + r.width / 2, r.y + r.height / 2);
          return t && !(t === a || a.contains(t)) && !t.closest('.wa-float,.env-badge');
        })
        .map((a) => a.textContent.trim()));
      expect(blocked).toEqual([]);
    });
  }
});

test.describe('homepage', () => {
  test('five service areas link to the services page', async ({ page }) => {
    await page.goto('/');
    const cards = page.locator('.svc-grid .svc');
    await expect(cards).toHaveCount(5);
    await expect(cards.first()).toContainText('אוטומציות לעסקים');
    await expect(page.locator('.svc-grid')).toContainText('SEO / קידום אורגני');
    await expect(page.locator('.svc-grid')).toContainText('קמפיינים ממומנים');
    await expect(page.locator('a[href="/services#automations"]')).toBeVisible();
    await expect(page.locator('a[href="/services#pwa"]')).toBeVisible();
    await expect(page.locator('a[href="/services#seo"]')).toBeVisible();
    await expect(page.locator('a[href="/services#campaigns"]')).toBeVisible();
    await expect(page.getByRole('heading', { name: 'חמישה תחומים. מערכת אחת שעובדת יחד.' })).toBeVisible();
    await expect(page.locator('.svc-grid')).toContainText('לקוחות שמוצאים אתכם בגוגל');
    await page.goto('/services');
    await expect(page.locator('#seo')).toContainText('מחקר מילות מפתח');
    await expect(page.locator('#seo')).toContainText('הדגמה להמחשה · ללא נתונים אמיתיים');
    await expect(page.locator('#seo a[href="/articles"]')).toBeVisible();
    await expect(page.locator('#campaigns')).toContainText('Google Ads');
    await expect(page.locator('#campaigns')).toContainText('פייסבוק');
    await expect(page.locator('#websites')).toContainText('fisha.shop');
  });

  test('hero leads with the headline, one clear action, and real work', async ({ page }) => {
    await page.goto('/');
    await expect(page.locator('h1')).toContainText('העסק שלך ממשיך לעבוד.');
    await expect(page.locator('.h3ro .btn-main')).toHaveText(/בואו נדבר על העסק שלכם/);
    await expect(page.locator('.h3-art img')).toHaveCount(3);
    await expect(page.locator('.h3-why li')).toHaveCount(3);
    await expect(page.locator('.services.lite .svc .out').first()).toContainText('פחות עבודה ידנית');
  });

  test('faq lists every service and publishes FAQPage data', async ({ page }) => {
    await page.goto('/');
    const faq = page.locator('.faq');
    await expect(faq.locator('h2')).toHaveText('שאלות שבעלי עסקים שואלים אותי');
    await expect(faq.locator('details')).toHaveCount(5);
    await expect(faq).toContainText('ללא צורך בחנות האפליקציות');
    await expect(faq).toContainText('fisha.shop');
    await expect(faq).toContainText('Excerly');
    await expect(faq).toContainText('יש לי דף נחיתה, אבל הוא לא מביא פניות או לידים?');
    await expect(faq).not.toContainText('פנסיון');
    await expect(faq).not.toContainText('קלעי');
    const ld = await page.locator('script[type="application/ld+json"]').textContent();
    const data = JSON.parse(ld);
    expect(data['@type']).toBe('FAQPage');
    expect(data.mainEntity).toHaveLength(5);
    const first = faq.locator('details').first();
    await expect(first).not.toHaveAttribute('open', '');
    await first.locator('summary').click();
    await expect(first).toHaveAttribute('open', '');
  });
});

test.describe('projects', () => {
  test('filters show and hide the right projects, including the Boardog bot', async ({ page }) => {
    await page.goto('/projects');
    const fisha = page.locator('[data-showcase] [data-cat="web"]');
    const apps = page.locator('[data-showcase] [data-cat="pwa"]');
    const bot = page.locator('#case-bot');

    await expect(fisha).toHaveCount(1);
    await expect(apps).toHaveCount(1);
    await expect(bot).toHaveAttribute('data-cat', 'automations');
    await expect(page.getByRole('button', { name: /הכל/ })).toContainText('3');

    await page.getByRole('button', { name: /אפליקציות PWA/ }).click();
    await expect(fisha).toBeHidden();
    await expect(apps).toBeVisible();
    await expect(bot).toBeHidden();

    await page.getByRole('button', { name: /אתרים וחנויות/ }).click();
    await expect(fisha).toBeVisible();
    await expect(apps).toBeHidden();
    await expect(bot).toBeHidden();

    await page.getByRole('button', { name: /אוטומציות לעסקים/ }).click();
    await expect(fisha).toBeHidden();
    await expect(apps).toBeHidden();
    await expect(bot).toBeVisible();

    await page.getByRole('button', { name: /הכל/ }).click();
    await expect(fisha).toBeVisible();
    await expect(apps).toBeVisible();
    await expect(bot).toBeVisible();
  });

  test('whatsapp bot showcase renders', async ({ page }) => {
    await page.goto('/projects');
    const block = page.locator('#case-bot');
    await expect(block).toBeVisible();
    await expect(block.locator('h2')).toHaveText('Boardog');
    await expect(block).toContainText('אפליקציית צ׳אטבוט לבעלי פנסיונים');
    await expect(block).not.toContainText('צילום מסך אמיתי');
    await expect(block).toContainText('הפנסיון של ג׳רי');
    await expect(block).toContainText('מחובר/ת');
    await expect(block).toContainText('הקלדה...');
    // The chat plays as a video; the HTML chat is only a fallback, shown if the video fails to load.
    const video = block.locator('video.wad-video');
    await expect(video).toBeVisible();
    await expect(video.locator('source[src$="boardog-chat.mp4"]')).toHaveCount(1);
    await expect.poll(() => video.evaluate((node) => (node.videoWidth && node.videoHeight) ? `${node.videoWidth}x${node.videoHeight}` : '')).toBe('382x532');
    await expect(block.locator('[data-wa-log] .wad-msg')).not.toHaveCount(0);
    await expect(block).not.toContainText('Claude');
    await expect(block).not.toContainText('AI (Claude)');
  });
});

test.describe('contact form', () => {
  test('empty submit shows Hebrew errors and focuses the first field', async ({ page }) => {
    await page.goto('/contact');
    await page.getByRole('button', { name: 'שליחת הפנייה' }).click();
    await expect(page.locator('.field-error')).toHaveCount(3);
    await expect(page.locator('#f-name')).toBeFocused();
    await expect(page.locator('#f-name')).toHaveAttribute('aria-invalid', 'true');
  });

  test('bad email is caught; fixing a field clears its error', async ({ page }) => {
    await page.goto('/contact');
    await page.fill('#f-email', 'not-an-email');
    await page.locator('#f-email').blur();
    await expect(page.locator('#err-email')).toContainText('כתובת המייל');
    await page.fill('#f-email', 'shay@example.com');
    await expect(page.locator('#err-email')).toHaveCount(0);
  });

  test('server rejects a forged submission', async ({ request }) => {
    const res = await request.post('/contact', {
      form: { csrf: 'forged', name: 'בדיקה', phone: '0501234567', consent: '1' },
    });
    expect(await res.text()).toContain('פג תוקף הטופס');
  });

  test('valid submission reaches the mail step and keeps the data', async ({ page }) => {
    await page.goto('/contact');
    await page.waitForTimeout(3200); // the form ignores submissions faster than a human could make them
    await page.fill('#f-name', 'בדיקת מערכת');
    await page.fill('#f-phone', '050-1234567');
    await page.fill('#f-message', 'בדיקה אוטומטית');
    await page.locator('label.consent').click();
    await page.getByRole('button', { name: 'שליחת הפנייה' }).click();
    // Locally there is no mail server, so the friendly failure appears with the data kept.
    // On Hostinger the same flow redirects to contact.php?sent=1.
    const sent = page.locator('#sent');
    const failed = page.locator('[data-form-alert]');
    await expect(sent.or(failed)).toBeVisible();
    if (await failed.isVisible()) await expect(page.locator('#f-name')).toHaveValue('בדיקת מערכת');
  });

  test('thank-you screen', async ({ page }) => {
    await page.goto('/contact?sent=1');
    await expect(page.locator('#sent h2')).toHaveText('ההודעה התקבלה. תודה.');
  });
});
