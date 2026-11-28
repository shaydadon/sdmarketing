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
  { path: '/articles/seo-for-small-business', name: 'article-seo' },
  { path: '/terms', name: 'terms' },
  { path: '/privacy', name: 'privacy' },
  { path: '/accessibility', name: 'accessibility' },
  // English (LTR) versions under /en/
  { path: '/en/', name: 'en-home', en: true },
  { path: '/en/services', name: 'en-services', en: true },
  { path: '/en/projects', name: 'en-projects', en: true },
  { path: '/en/articles', name: 'en-articles', en: true },
  { path: '/en/articles/seo-for-small-business', name: 'en-article', en: true },
  { path: '/en/about', name: 'en-about', en: true },
  { path: '/en/contact', name: 'en-contact', en: true },
  { path: '/en/terms', name: 'en-terms', en: true },
  { path: '/en/privacy', name: 'en-privacy', en: true },
  { path: '/en/accessibility', name: 'en-accessibility', en: true },
];
const EN_PAGES = PAGES.filter((p) => p.en);
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

      await expect(page.locator('html')).toHaveAttribute('lang', p.en ? 'en' : 'he');
      await expect(page.locator('html')).toHaveAttribute('dir', p.en ? 'ltr' : 'rtl');
      await expect(page).toHaveTitle(/SDmarketing/);
      await expect(page.locator('h1')).toHaveCount(1);
      if (!['home', 'projects', 'services', 'article', 'en-home', 'en-projects', 'en-services'].includes(p.name)) await expect(page.locator('body')).not.toContainText('Boardog');
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

  test('sitemap.xml lists only clean URLs with dates, and robots.txt points to it', async ({ request }) => {
    const xml = await (await request.get('/sitemap.xml')).text();
    const locs = [...xml.matchAll(/<loc>([^<]+)<\/loc>/g)].map((m) => m[1]);
    expect(locs.length).toBeGreaterThanOrEqual(15);
    for (const loc of locs) expect(loc).toMatch(/^https:\/\/sdmarketing\.co\.il\/[a-z0-9\/-]*$/);
    expect(locs).toContain('https://sdmarketing.co.il/articles/landing-page');
    expect((xml.match(/<lastmod>\d{4}-\d{2}-\d{2}<\/lastmod>/g) || []).length).toBe(locs.length);
    // every sitemap URL is served (200) at its clean path
    for (const loc of locs) {
      const res = await request.get(new URL(loc).pathname, { maxRedirects: 0 });
      expect(res.status(), loc).toBe(200);
    }
    const robots = await (await request.get('/robots.txt')).text();
    expect(robots).toContain('Sitemap: https://sdmarketing.co.il/sitemap.xml');
  });

  test('the IndexNow key file is served at the root and contains its own key', async ({ request }) => {
    const fs = require('fs');
    const path = require('path');
    const keyFile = fs.readdirSync(path.resolve(__dirname, '../..')).find((f) => /^[0-9a-f]{32}\.txt$/.test(f));
    expect(keyFile).toBeTruthy();
    const res = await request.get('/' + keyFile, { maxRedirects: 0 });
    expect(res.status()).toBe(200);
    expect((await res.text()).trim()).toBe(keyFile.replace('.txt', ''));
  });

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
    await expect(cards).toHaveCount(7);
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
    const links = page.locator(isMobile ? '.mobile-nav > ul > li:not(.mn-lang) > a' : '[data-nav] a');
    await expect(links).toHaveText([/שירותים/, /פרויקטים/, /מאמרים/, /אודות/, /צור קשר/]);
    await expect(page.locator('.mobile-nav .mn-sub')).toHaveCount(0);
    await links.nth(2).click();
    await expect(page).toHaveURL(/\/articles$/);
    await expect(page.locator('header a.logo')).toHaveAttribute('href', '/');
  });

  test('topic filters show only that topic, and each article names its author and date', async ({ page }) => {
    await page.goto('/articles');
    const visible = page.locator('.post-card:visible');
    await expect(visible).toHaveCount(7);
    await page.getByRole('button', { name: /קידום אורגני/ }).click();
    await expect(visible).toHaveCount(1);
    await page.getByRole('button', { name: /אפליקציות/ }).click();
    await expect(visible).toHaveCount(1);
    await page.getByRole('button', { name: /אוטומציות/ }).click();
    await expect(visible).toHaveCount(3);
    await page.getByRole('button', { name: /הכל/ }).click();
    await expect(visible).toHaveCount(7);

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
    await expect(page.getByRole('heading', { name: 'חמישה שירותים שבנויים לעבוד יחד.' })).toBeVisible();
    await page.goto('/services');
    await expect(page.locator('#seo')).toContainText('מחקר מילות מפתח');
    await expect(page.locator('#seo')).toContainText('הדגמה להמחשה · ללא נתונים אמיתיים');
    await expect(page.locator('#seo')).not.toContainText('יעלו בעמוד המאמרים');
    await expect(page.locator('#campaigns')).toContainText('Google Ads');
    await expect(page.locator('#campaigns')).toContainText('פייסבוק');
    await expect(page.locator('#websites')).toContainText('fisha.shop');
  });

  test('hero leads with the headline, one clear action, and real work', async ({ page }) => {
    await page.goto('/');
    await expect(page.locator('h1')).toContainText('העסק שלכם ממשיך לעבוד.');
    await expect(page.locator('.h3ro .btn-main')).toHaveText(/בואו נדבר על העסק שלכם/);
    await expect(page.locator('.h3-art img')).toHaveCount(3);
    // A calm first screen: no overlay labels on the images, and one short line under the button
    await expect(page.locator('.h3-why')).toHaveCount(0);
    await expect(page.locator('.h3ro .offer')).toHaveText('הודעה קצרה בוואטסאפ, ואחזור אליכם עם רעיון ראשון.');
  });

  test('faq lists every service and publishes FAQPage data (on the services page)', async ({ page }) => {
    await page.goto('/services');
    const faq = page.locator('.faq');
    await expect(faq.locator('h2')).toHaveText('שאלות שבעלי עסקים שואלים אותי');
    await expect(faq.locator('details')).toHaveCount(5);
    await expect(faq).toContainText('ללא צורך בחנות האפליקציות');
    await expect(faq).toContainText('fisha.shop');
    await expect(faq).toContainText('Excerly');
    await expect(faq).toContainText('יש לי דף נחיתה, אבל הוא לא מביא פניות או לידים?');
    await expect(faq).not.toContainText('פנסיון');
    await expect(faq).not.toContainText('קלעי');
    const lds = await page.locator('script[type="application/ld+json"]').allTextContents();
    const data = lds.map((t) => JSON.parse(t)).find((d) => d['@type'] === 'FAQPage');
    expect(data['@type']).toBe('FAQPage');
    expect(data.mainEntity).toHaveLength(5);
    const first = faq.locator('details').first();
    await expect(first).not.toHaveAttribute('open', '');
    await first.locator('summary').click();
    await expect(first).toHaveAttribute('open', '');
  });
});

test.describe('projects', () => {
  test('each project is a short case study: challenge, what was built, a live link and its service', async ({ page }) => {
    for (const [path, svc] of [['/projects', '/services#websites'], ['/en/projects', '/en/services#websites']]) {
      await page.goto(path);
      await expect(page.locator('[data-filters]')).toHaveCount(0);
      await expect(page.locator('.case')).toHaveCount(3);
      await expect(page.locator('.case .cs')).toHaveCount(3);
      await expect(page.locator('#case-fisha .cs li')).toHaveCount(4);   // includes the Fisha Studio back office
      for (const id of ['#case-excerly', '#case-bot']) await expect(page.locator(`${id} .cs li`)).toHaveCount(3);
      // fisha: no link until its new design is live; each project says whose it is
      await expect(page.locator('#case-fisha .acts a[href*="fisha.shop"]')).toHaveCount(0);
      await expect(page.locator('#case-fisha .tags .tag')).toHaveCount(2);
      await expect(page.locator('#case-excerly .tags .tag')).toHaveCount(2);
      await expect(page.locator('#case-excerly .acts a[href="https://shaydadon.github.io/Excerly/"]')).toHaveCount(1);
      await expect(page.locator(`#case-fisha .acts a[href="${svc}"]`)).toHaveCount(1);
      await expect(page.locator('#case-bot .acts a[href*="wa.me"]')).toHaveCount(1);
    }
  });

  test('whatsapp bot showcase renders', async ({ page }) => {
    await page.goto('/projects');
    const block = page.locator('#case-bot');
    await expect(block).toBeVisible();
    await expect(block.locator('h2')).toHaveText('Boardog');
    await expect(block).toContainText('צ׳אטבוט וואטסאפ לבעלי פנסיונים');
    await expect(block).not.toContainText('דוגמה');
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

test.describe('english version', () => {
  test('every English page is fully in English: no Hebrew left in the visible text or labels', async ({ page }) => {
    for (const p of EN_PAGES) {
      await page.goto(p.path);
      const hebrew = await page.evaluate(() => {
        const he = /[֐-׿]/;
        const skip = (el) => el.closest('.lang-switch, .mn-lang');
        const out = [];
        const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT);
        while (walker.nextNode()) {
          const n = walker.currentNode;
          if (he.test(n.textContent) && !skip(n.parentElement) && !n.parentElement.closest('script, style')) out.push(n.textContent.trim());
        }
        document.querySelectorAll('[alt], [aria-label], [placeholder], [title]').forEach((el) => {
          if (skip(el)) return;
          for (const a of ['alt', 'aria-label', 'placeholder', 'title']) if (he.test(el.getAttribute(a) || '')) out.push(`${a}: ${el.getAttribute(a)}`);
        });
        if (he.test(document.title) || he.test(document.querySelector('meta[name="description"]')?.content || '')) out.push('title/description');
        return out;
      });
      expect(hebrew, `${p.path}\n${hebrew.join('\n')}`).toEqual([]);
    }
  });

  test('each page links to its twin with reciprocal hreflang, and the canonical is its own address', async ({ page }) => {
    for (const p of EN_PAGES) {
      const twin = p.path.replace(/^\/en\//, '/');
      for (const [path, self] of [[p.path, p.path], [twin, twin]]) {
        await page.goto(path);
        await expect(page.locator('link[rel="canonical"]')).toHaveAttribute('href', `https://sdmarketing.co.il${self}`);
        await expect(page.locator('link[hreflang="he"]')).toHaveAttribute('href', `https://sdmarketing.co.il${twin}`);
        await expect(page.locator('link[hreflang="en"]')).toHaveAttribute('href', `https://sdmarketing.co.il${p.path}`);
        await expect(page.locator('link[hreflang="x-default"]')).toHaveAttribute('href', `https://sdmarketing.co.il${twin}`);
      }
    }
  });

  test('the language switcher opens the same page in the other language, and back', async ({ page, isMobile }) => {
    test.skip(isMobile, 'the header switcher is the same on mobile; checked on desktop');
    await page.goto('/services');
    await page.locator('header .lang-switch').click();
    await expect(page).toHaveURL(/\/en\/services$/);
    await expect(page.locator('h1')).toContainText('Everything your business needs to sell more online');
    await page.locator('header .lang-switch').click();
    await expect(page).toHaveURL(/\/services$/);
    await expect(page).not.toHaveURL(/\/en\//);
    // Articles switch to their English twin
    await page.goto('/articles/whatsapp-chatbot');
    await page.locator('header .lang-switch').click();
    await expect(page).toHaveURL(/\/en\/articles\/whatsapp-chatbot$/);
    await expect(page.locator('h1')).toContainText('WhatsApp Chatbot for Business');
  });

  test('the English menu has Services, Projects, Articles, About, Contact, and every link stays in English', async ({ page, isMobile }) => {
    await page.goto('/en/');
    if (isMobile) await page.locator('[data-nav-toggle]').click();
    const links = page.locator(isMobile ? '.mobile-nav > ul > li:not(.mn-lang) > a' : '[data-nav] a');
    await expect(links).toHaveText([/Services/, /Projects/, /Articles/, /About/, /Contact/]);
    await expect(page.locator('header a.logo')).toHaveAttribute('href', '/en/');
    for (const p of EN_PAGES) {
      await page.goto(p.path);
      const hrefs = await page.evaluate(() => [...document.querySelectorAll('main a[href^="/"], header a[href^="/"], footer a[href^="/"]')]
        .filter((a) => !a.closest('.lang-switch, .mn-lang')).map((a) => a.getAttribute('href')));
      const hebrewLinks = hrefs.filter((h) => !h.startsWith('/en/') && !h.startsWith('/assets/'));
      expect(hebrewLinks, `${p.path} links to Hebrew pages`).toEqual([]);
    }
  });

  test('English addresses are clean: /en and .php forms redirect permanently', async ({ request }) => {
    for (const [from, to] of [['/en', '/en/'], ['/en/index.php', '/en/'], ['/en/services.php', '/en/services'], ['/en/contact.php?x=1', '/en/contact?x=1']]) {
      const res = await request.get(from, { maxRedirects: 0 });
      expect(res.status(), from).toBe(301);
      expect(new URL(res.headers().location, 'http://localhost').pathname + (new URL(res.headers().location, 'http://localhost').search), from).toBe(to);
    }
    const missing = await request.get('/en/nothing-here');
    expect(missing.status()).toBe(404);
    expect(await missing.text()).toContain('This page doesn’t exist');
  });

  test('the sitemap lists every English page with its Hebrew alternate', async ({ request }) => {
    const xml = await (await request.get('/sitemap.xml')).text();
    for (const p of EN_PAGES) {
      expect(xml, p.path).toContain(`<loc>https://sdmarketing.co.il${p.path}</loc>`);
      expect(xml).toContain(`hreflang="en" href="https://sdmarketing.co.il${p.path}"`);
    }
  });

  test('the English contact form shows English errors and posts back to /en/contact', async ({ page }) => {
    await page.goto('/en/contact');
    await expect(page.locator('form[data-contact-form]')).toHaveAttribute('action', '/en/contact');
    await page.getByRole('button', { name: 'Send message' }).click();
    await expect(page.locator('.field-error')).toHaveCount(3);
    await expect(page.locator('#err-name')).toContainText('Please enter your name');
    await page.goto('/en/contact?sent=1');
    await expect(page.locator('#sent h2')).toHaveText('Thanks! Your message has been received.');
  });

  test('the English chatbot demo plays the conversation in English', async ({ page }) => {
    await page.goto('/en/projects');
    const block = page.locator('#case-bot');
    await expect(block.locator('video')).toHaveCount(0);
    await expect(block.locator('[data-wa-demo]')).toBeVisible();
    await expect(block.locator('[data-wa-log]')).toContainText('Welcome to Jerry’s Dog Boarding', { timeout: 15000 });
  });
});

test.describe('site review fixes', () => {
  test('services open with a 5-card overview that jumps to each service, with no numbered labels', async ({ page }) => {
    for (const [path, fit] of [['/services', 'מתאים ל'], ['/en/services', 'Good for']]) {
      await page.goto(path);
      const cards = page.locator('.svo-grid .svo');
      await expect(cards).toHaveCount(5);
      await expect(cards.first()).toContainText(fit);
      for (const id of ['automations', 'websites', 'pwa', 'seo', 'campaigns']) {
        await expect(page.locator(`.svo[href="#${id}"]`)).toHaveCount(1);
        await expect(page.locator(`#${id}`)).toHaveCount(1);
      }
      await expect(page.locator('body')).not.toContainText('01 ·');
      await expect(page.locator('.svc-block .tagline')).toHaveCount(0);
    }
  });

  test('the home page shows only the essentials, in order: hero, services, projects, about, contact', async ({ page }) => {
    for (const path of ['/', '/en/']) {
      await page.goto(path);
      const order = await page.evaluate(() => [...document.querySelectorAll('body > section, main > section')].map((s) => s.className.split(' ')[0]));
      expect(order).toEqual(['h3ro', 'services', 'work', 'approach', 'cta']);
      await expect(page.locator('.home-posts, .faq, .statement, .qs, .process')).toHaveCount(0);
    }
  });

  test('the services page ends with the FAQ and the full work process, then the contact section', async ({ page }) => {
    for (const path of ['/services', '/en/services']) {
      await page.goto(path);
      const order = await page.evaluate(() => [...document.querySelectorAll('main > section')].map((s) => s.className.split(' ')[0]));
      expect(order.slice(-4)).toEqual(['journey', 'faq', 'process', 'cta']);
      await expect(page.locator('.process .step')).toHaveCount(4);
    }
  });

  test('the contact page has four practical questions with FAQPage data, in both languages', async ({ page }) => {
    for (const [path, first] of [['/contact', 'לא בטוחים איזה שירות'], ['/en/contact', 'I’m not sure which service']]) {
      await page.goto(path);
      const faq = page.locator('.contact-faq');
      await expect(faq.locator('details')).toHaveCount(4);
      await expect(faq.locator('summary').first()).toContainText(first);
      const lds = await page.locator('script[type="application/ld+json"]').allTextContents();
      const data = lds.map((t) => JSON.parse(t)).find((d) => d['@type'] === 'FAQPage');
      expect(data.mainEntity).toHaveLength(4);
    }
  });

  test('every article has a table of contents whose links land on real headings', async ({ page }) => {
    await page.goto('/articles');
    const hrefs = await page.locator('.post-card a').evaluateAll((as) => as.map((a) => a.getAttribute('href')));
    for (const href of hrefs) {
      await page.goto(href);
      const links = page.locator('.post-toc a');
      expect(await links.count(), href).toBeGreaterThanOrEqual(3);
      for (const id of await links.evaluateAll((as) => as.map((a) => a.getAttribute('href').slice(1)))) {
        await expect(page.locator(`[id="${id}"]`), `${href} #${id}`).toHaveCount(1);
      }
    }
  });

  test('copy: no repeated stock lines, and one form of address', async ({ page }) => {
    for (const path of ['/', '/services', '/about', '/projects']) {
      await page.goto(path);
      const text = await page.locator('main').innerText();
      expect((text.match(/בלי הפתעות/g) || []).length, path).toBe(0);
      expect(text, path).not.toContain('ההוכחה נמצאת באוויר');
      expect(text, path).not.toContain('בלי טפסים');
      expect(text, path).not.toMatch(/העסק שלך|כשאתה /);
    }
  });

  test('phones: header buttons, footer links and breadcrumbs are at least 44px tall', async ({ page, isMobile }) => {
    test.skip(!isMobile, 'touch targets are a phone concern');
    await page.goto('/services');
    for (const sel of ['.nav-toggle', '.lang-switch', '.nav .nav-wa', '.crumb a', 'footer ul a']) {
      const box = await page.locator(sel).first().boundingBox();
      expect(box?.height, sel).toBeGreaterThanOrEqual(44);
    }
  });
});

test.describe('SEO guide and English articles', () => {
  test('the SEO guide exists in both languages, linked by hreflang and the language switcher', async ({ page }) => {
    const he = 'https://sdmarketing.co.il/articles/seo-for-small-business';
    const en = 'https://sdmarketing.co.il/en/articles/seo-for-small-business';
    for (const [path, lang, canonical, switchTo] of [
      ['/articles/seo-for-small-business', 'he', he, '/en/articles/seo-for-small-business'],
      ['/en/articles/seo-for-small-business', 'en', en, '/articles/seo-for-small-business'],
    ]) {
      await page.goto(path);
      await expect(page.locator('html')).toHaveAttribute('lang', lang);
      await expect(page.locator('link[rel="canonical"]')).toHaveAttribute('href', canonical);
      await expect(page.locator('link[hreflang="he"]')).toHaveAttribute('href', he);
      await expect(page.locator('link[hreflang="en"]')).toHaveAttribute('href', en);
      await expect(page.locator('.lang-switch')).toHaveAttribute('href', switchTo);
      await expect(page.locator('.post-toc li')).toHaveCount(await page.locator('.post-body h2').count() + 1);
      // sources section links to Google's own documentation
      expect(await page.locator('.post-body a[href^="https://developers.google.com/search/docs"]').count()).toBeGreaterThanOrEqual(5);
      const ld = await page.locator('script[type="application/ld+json"]').allTextContents();
      expect(ld.some((t) => t.includes('"@type":"Article"') && t.includes(`"inLanguage":"${lang}"`))).toBe(true);
      expect(ld.some((t) => t.includes('"@type":"FAQPage"'))).toBe(true);
    }
  });

  test('every Hebrew article has an English twin, linked both ways by hreflang', async ({ page, request }) => {
    await page.goto('/articles');
    const slugs = await page.locator('.post-card a').evaluateAll((as) => as.map((a) => a.getAttribute('href').split('/').pop()));
    expect(slugs.length).toBe(7);
    for (const slug of slugs) {
      expect((await request.get(`/en/articles/${slug}`)).status()).toBe(200);
      await page.goto(`/en/articles/${slug}`);
      await expect(page.locator('link[hreflang="he"]')).toHaveAttribute('href', `https://sdmarketing.co.il/articles/${slug}`);
      await expect(page.locator('.lang-switch')).toHaveAttribute('href', `/articles/${slug}`);
      await expect(page.locator('html')).toHaveAttribute('lang', 'en');
    }
  });

  test('English has an Articles page in the nav, with English links only', async ({ page }) => {
    await page.goto('/en/');
    await expect(page.locator('[data-nav] a[href="/en/articles"]')).toHaveText('Articles');
    await page.goto('/en/articles');
    const hrefs = await page.locator('.post-card a').evaluateAll((as) => as.map((a) => a.getAttribute('href')));
    expect(hrefs.length).toBeGreaterThan(0);
    for (const h of hrefs) expect(h).toMatch(/^\/en\/articles\/[a-z0-9-]+$/);
    await page.goto(hrefs[0]);
    for (const h of await page.locator('.post-body a[href^="/"]').evaluateAll((as) => as.map((a) => a.getAttribute('href')))) {
      expect(h).toMatch(/^\/en\//);
    }
  });

  test('old English article addresses redirect to clean ones', async ({ request }) => {
    for (const [from, to] of [['/en/article.php?slug=seo-for-small-business', '/en/articles/seo-for-small-business'], ['/en/articles.php', '/en/articles']]) {
      const r = await request.get(from, { maxRedirects: 0 });
      expect(r.status()).toBe(301);
      expect(new URL(r.headers()['location'], 'http://x').pathname).toBe(to);
    }
  });

  test('the SEO service links to the guide in both languages, and the sitemap pairs them', async ({ page, request }) => {
    for (const [path, href] of [['/services', '/articles/seo-for-small-business'], ['/en/services', '/en/articles/seo-for-small-business']]) {
      await page.goto(path);
      await expect(page.locator(`#seo .svc-guide[href="${href}"]`)).toHaveCount(1);
    }
    const xml = await (await request.get('/sitemap.xml')).text();
    expect(xml).toContain('<loc>https://sdmarketing.co.il/en/articles/seo-for-small-business</loc>');
    expect(xml).toContain('<loc>https://sdmarketing.co.il/en/articles</loc>');
    expect(xml).toMatch(/<loc>https:\/\/sdmarketing\.co\.il\/articles\/seo-for-small-business<\/loc>[^\n]*hreflang="en" href="https:\/\/sdmarketing\.co\.il\/en\/articles\/seo-for-small-business"/);
  });
});
