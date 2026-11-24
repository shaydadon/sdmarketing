// End-to-end tests for the SDmarketing site. Run from this folder: npm test
const { defineConfig, devices } = require('@playwright/test');
const path = require('path');

const PORT = 8790;
const PHP = process.env.PHP_BIN || 'C:/xampp/php/php.exe';

module.exports = defineConfig({
  testDir: './tests',
  fullyParallel: true,
  reporter: [['list'], ['html', { open: 'never' }]],
  use: {
    baseURL: `http://localhost:${PORT}`,
    locale: 'he-IL',
    trace: 'retain-on-failure',
  },
  webServer: {
    // router.php mirrors the clean-URL rules in /.htaccess, which the PHP dev server does not read.
    command: `"${PHP}" -S localhost:${PORT} -t "${path.resolve(__dirname, '..')}" "${path.resolve(__dirname, 'router.php')}"`,
    url: `http://localhost:${PORT}/`,
    reuseExistingServer: true,
    stdout: 'ignore',
    stderr: 'ignore',
  },
  projects: [
    { name: 'desktop', use: { ...devices['Desktop Chrome'], viewport: { width: 1440, height: 900 } } },
    { name: 'mobile', use: { ...devices['Pixel 7'] } },
  ],
});
