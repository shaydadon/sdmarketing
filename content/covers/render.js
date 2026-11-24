// Render the article covers: node content/covers/render.js [baseUrl]
// Needs the PHP dev server on the repo root (php -S localhost:8811 -t .).
// Writes assets/img/articles/<slug>.webp (1200x630) via a PNG screenshot and ffmpeg.
const { chromium } = require('playwright');
const { execFileSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const base = process.argv[2] || 'http://localhost:8811/';
const slugs = ['whatsapp-chatbot', 'stop-losing-leads', 'small-business-automations', 'pwa-vs-app-store', 'landing-page', 'conversion-tracking'];
const outDir = path.join(__dirname, '..', '..', 'assets', 'img', 'articles');
fs.mkdirSync(outDir, { recursive: true });

(async () => {
  const b = await chromium.launch();
  const p = await b.newPage({ viewport: { width: 1200, height: 630 }, deviceScaleFactor: 1 });
  for (const slug of slugs) {
    await p.goto(`${base}content/covers/cover.php?slug=${slug}`, { waitUntil: 'networkidle' });
    await p.evaluate(() => document.fonts.ready);
    const png = path.join(outDir, `${slug}.png`);
    await p.screenshot({ path: png });
    execFileSync('ffmpeg', ['-loglevel', 'error', '-y', '-i', png, '-c:v', 'libwebp', '-quality', '82', path.join(outDir, `${slug}.webp`)]);
    fs.unlinkSync(png);
    console.log('wrote', `assets/img/articles/${slug}.webp`, fs.statSync(path.join(outDir, `${slug}.webp`)).size, 'bytes');
  }
  await b.close();
})();
