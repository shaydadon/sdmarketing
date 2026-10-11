# SDmarketing

The website of SDmarketing ([sdmarketing.co.il](https://sdmarketing.co.il)): automations and WhatsApp chatbots, websites and online stores, PWA apps, and digital marketing for businesses. Hebrew, right-to-left.

Plain PHP + CSS + JS, no build step. Runs on any PHP 8 host (Hostinger) or locally with XAMPP.

## Run locally

```bash
php -S localhost:8765
```

Then open http://localhost:8765.

## Structure

| Path | What |
| --- | --- |
| `index.php`, `services.php`, `projects.php`, `about.php`, `contact.php` | Main pages |
| `terms.php`, `privacy.php`, `accessibility.php`, `404.php` | Legal pages and the not-found page |
| `includes/config.php` | Contact details, WhatsApp number, legal business details |
| `includes/services-data.php`, `includes/projects-data.php` | Service and project content |
| `includes/header.php`, `includes/footer.php`, `includes/cta.php` | Shared layout |
| `assets/` | CSS, JS, images. Project screenshots go in `assets/img/projects/<slug>.jpg` |
| `e2e/` | Playwright tests (not part of the deployed site) |

## Tests

```bash
cd e2e
npm install
npx playwright install chromium
npm test
```

## Deploy

Upload everything except `e2e/`, `README.md`, `PRODUCT.md` and `skills-lock.json` to `public_html` on Hostinger. Then:

1. Fill in the business type, business ID and city in `includes/config.php` (shown on the legal pages).
2. Turn on SSL in Hostinger and uncomment the HTTPS rule in `.htaccess`.
3. Send one test message through the contact form.
