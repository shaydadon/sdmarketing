// @ts-check
const { test, expect } = require('@playwright/test');
const AxeBuilder = require('@axe-core/playwright').default;

const PAGES = [
  { path: '/index.php', name: 'home' },
  { path: '/services.php', name: 'services' },
  { path: '/projects.php', name: 'projects' },
  { path: '/about.php', name: 'about' },
  { path: '/contact.php', name: 'contact' },
  { path: '/terms.php', name: 'terms' },
  { path: '/privacy.php', name: 'privacy' },
  { path: '/accessibility.php', name: 'accessibility' },
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
    await page.goto('/services.php');
    const nav = isMobile ? page.locator('[data-mobile-nav]') : page.locator('[data-nav]');
    if (isMobile) await page.locator('[data-nav-toggle]').click();
    await expect(nav.locator('a[aria-current="page"]')).toHaveText(/שירותים/);
  });

  test('mobile menu opens, focuses, and closes with Escape', async ({ page, isMobile }) => {
    test.skip(!isMobile, 'mobile only');
    await page.goto('/index.php');
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

test.describe('homepage', () => {
  test('services tabs switch by click and keyboard', async ({ page }) => {
    await page.goto('/index.php');
    const tabs = page.getByRole('tab');
    await expect(tabs).toHaveCount(4);
    await expect(page.locator('#panel-automations')).toBeVisible();

    await tabs.nth(2).click();
    await expect(tabs.nth(2)).toHaveAttribute('aria-selected', 'true');
    await expect(page.locator('#panel-pwa')).toBeVisible();
    await expect(page.locator('#panel-automations')).toBeHidden();

    await page.keyboard.press('ArrowDown');
    await expect(tabs.nth(3)).toBeFocused();
    await expect(page.locator('#panel-marketing')).toBeVisible();
  });

  test('hero demo plays the bot conversation', async ({ page }) => {
    await page.goto('/index.php');
    const lastStep = page.locator('.hero-demo [data-step="7"]');
    await expect(lastStep).toHaveClass(/is-on/, { timeout: 15000 });
  });
});

test.describe('projects', () => {
  test('filters show and hide the right projects', async ({ page }) => {
    await page.goto('/projects.php');
    const fisha = page.locator('[data-cat="web"]');
    const apps = page.locator('.case-pair [data-cat="pwa"]');

    await page.getByRole('button', { name: /אפליקציות PWA/ }).click();
    await expect(fisha).toBeHidden();
    await expect(apps).toHaveCount(2);
    await expect(apps.first()).toBeVisible();

    await page.getByRole('button', { name: /אתרים וחנויות/ }).click();
    await expect(fisha).toBeVisible();
    await expect(page.locator('.case-pair')).toBeHidden();

    await page.getByRole('button', { name: /הכל/ }).click();
    await expect(fisha).toBeVisible();
    await expect(apps.first()).toBeVisible();
  });
});

test.describe('contact form', () => {
  test('empty submit shows Hebrew errors and focuses the first field', async ({ page }) => {
    await page.goto('/contact.php');
    await page.getByRole('button', { name: 'שליחת הפנייה' }).click();
    await expect(page.locator('.field-error')).toHaveCount(3);
    await expect(page.locator('#f-name')).toBeFocused();
    await expect(page.locator('#f-name')).toHaveAttribute('aria-invalid', 'true');
  });

  test('bad email is caught; fixing a field clears its error', async ({ page }) => {
    await page.goto('/contact.php');
    await page.fill('#f-email', 'not-an-email');
    await page.locator('#f-email').blur();
    await expect(page.locator('#err-email')).toContainText('כתובת המייל');
    await page.fill('#f-email', 'shay@example.com');
    await expect(page.locator('#err-email')).toHaveCount(0);
  });

  test('server rejects a forged submission', async ({ request }) => {
    const res = await request.post('/contact.php', {
      form: { csrf: 'forged', name: 'בדיקה', phone: '0501234567', consent: '1' },
    });
    expect(await res.text()).toContain('פג תוקף הטופס');
  });

  test('valid submission reaches the mail step and keeps the data', async ({ page }) => {
    await page.goto('/contact.php');
    await page.waitForTimeout(3200); // the form ignores submissions faster than a human could make them
    await page.fill('#f-name', 'בדיקת מערכת');
    await page.fill('#f-phone', '050-1234567');
    await page.fill('#f-message', 'בדיקה אוטומטית');
    await page.locator('label.check').click();
    await page.getByRole('button', { name: 'שליחת הפנייה' }).click();
    // Locally there is no mail server, so the friendly failure appears with the data kept.
    // On Hostinger the same flow redirects to contact.php?sent=1.
    const sent = page.locator('#sent');
    const failed = page.locator('[data-form-alert]');
    await expect(sent.or(failed)).toBeVisible();
    if (await failed.isVisible()) await expect(page.locator('#f-name')).toHaveValue('בדיקת מערכת');
  });

  test('thank-you screen', async ({ page }) => {
    await page.goto('/contact.php?sent=1');
    await expect(page.locator('#sent h2')).toHaveText('ההודעה התקבלה. תודה.');
  });
});
