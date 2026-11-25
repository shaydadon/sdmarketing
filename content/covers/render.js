// Render the article covers: node content/covers/render.js [baseUrl]
// Needs the PHP dev server on the repo root (php -S localhost:8811 -t .).
// Writes assets/img/articles/<slug>.webp (1200x630) via a PNG screenshot and ffmpeg.
const { chromium } = require('playwright');
const { execFileSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const base = process.argv[2] || 'http://localhost:8811/';
// [slug, lang]: Hebrew covers go to assets/img/articles/, English ones to assets/img/articles/en/.
// Pass slugs after the base URL to render only those: node render.js http://localhost:8811/ seo-for-small-business
const all = [...['whatsapp-chatbot', 'stop-losing-leads', 'small-business-automations', 'pwa-vs-app-store', 'landing-page', 'conversion-tracking', 'seo-for-small-business'].map((s) => [s, 'he']), ['seo-for-small-business', 'en']];
const only = process.argv.slice(3);
const jobs = only.length ? all.filter(([s]) => only.includes(s)) : all;
const outDir = path.join(__dirname, '..', '..', 'assets', 'img', 'articles');
fs.mkdirSync(outDir, { recursive: true });

(async () => {
  const b = await chromium.launch();
  const p = await b.newPage({ viewport: { width: 1200, height: 630 }, deviceScaleFactor: 1 });
  for (const [slug, lang] of jobs) {
    const dir = lang === 'en' ? path.join(outDir, 'en') : outDir;
    fs.mkdirSync(dir, { recursive: true });
    await p.goto(`${base}content/covers/cover.php?slug=${slug}&lang=${lang}`, { waitUntil: 'networkidle' });
    await p.evaluate(() => document.fonts.ready);
    const png = path.join(dir, `${slug}.png`);
    await p.screenshot({ path: png });
    execFileSync('ffmpeg', ['-loglevel', 'error', '-y', '-i', png, '-c:v', 'libwebp', '-quality', '82', path.join(dir, `${slug}.webp`)]);
    fs.unlinkSync(png);
    console.log('wrote', path.relative(path.join(__dirname, '..', '..'), path.join(dir, `${slug}.webp`)), fs.statSync(path.join(dir, `${slug}.webp`)).size, 'bytes');
  }
  await b.close();
})();
