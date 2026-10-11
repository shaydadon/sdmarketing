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
    command: `"${PHP}" -S localhost:${PORT} -t "${path.resolve(__dirname, '..')}"`,
    url: `http://localhost:${PORT}/index.php`,
    reuseExistingServer: true,
    stdout: 'ignore',
    stderr: 'ignore',
  },
  projects: [
    { name: 'desktop', use: { ...devices['Desktop Chrome'], viewport: { width: 1440, height: 900 } } },
    { name: 'mobile', use: { ...devices['Pixel 7'] } },
  ],
});
