<?php
require_once __DIR__ . '/config.php';
$page_id    = $page_id    ?? 'index';
$page_title = $page_title ?? $site['name'];
$page_desc  = $page_desc  ?? '';
$header_theme = $header_theme ?? 'dark'; // 'dark' = over the navy hero, 'light' = over white

// Brand mark: rising line + bars from the original logo, redrawn as a compact square mark.
function logo_mark(string $class = 'logo-mark'): string
{
    return '<svg class="' . $class . '" viewBox="0 0 40 40" aria-hidden="true" focusable="false">'
        . '<rect width="40" height="40" rx="11" fill="var(--mark-bg)"/>'
        . '<rect x="10" y="25" width="4.5" height="7" rx="1.2" fill="var(--mark-fg)" opacity=".55"/>'
        . '<rect x="17.75" y="20" width="4.5" height="12" rx="1.2" fill="var(--mark-fg)" opacity=".8"/>'
        . '<rect x="25.5" y="15" width="4.5" height="17" rx="1.2" fill="var(--mark-fg)"/>'
        . '<path d="M8.5 21.5C15 19 22 14.5 29 8.5" fill="none" stroke="var(--mark-accent)" stroke-width="2.6" stroke-linecap="round"/>'
        . '<path d="M23.5 8h6v6" fill="none" stroke="var(--mark-accent)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>'
        . '</svg>';
}
?><!doctype html>
<html lang="he" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title) ?></title>
  <?php if ($page_desc): ?><meta name="description" content="<?= e($page_desc) ?>"><?php endif; ?>
  <?php
  $page_file = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
  $canonical = 'https://' . $site['domain'] . '/' . ($page_file === 'index.php' ? '' : $page_file);
  ?>
  <?php if (!empty($noindex) || $is_dev): ?>
  <meta name="robots" content="noindex">
  <?php else: ?>
  <link rel="canonical" href="<?= e($canonical) ?>">
  <?php endif; ?>
  <meta property="og:type" content="website">
  <meta property="og:locale" content="he_IL">
  <meta property="og:site_name" content="SDmarketing">
  <meta property="og:title" content="<?= e($page_title) ?>">
  <?php if ($page_desc): ?><meta property="og:description" content="<?= e($page_desc) ?>"><?php endif; ?>
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="https://<?= e($site['domain']) ?>/assets/img/founder.jpg">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="theme-color" content="#071d3d">
  <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&family=Rubik:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=18">
</head>
<body class="page-<?= e($page_id) ?>">
<?php require __DIR__ . '/icons.php'; ?>
<a class="skip-link" href="#main">דילוג לתוכן</a>
<?php if ($is_dev): ?><div class="env-badge" role="note">סביבת פיתוח</div><?php endif; ?>

<header class="site-header is-<?= e($header_theme) ?>" data-header>
  <div class="container header-inner">
    <a class="brand" href="index.php" aria-label="SDmarketing, לדף הבית">
      <?= logo_mark() ?>
      <span class="brand-word"><b>SD</b>marketing</span>
    </a>

    <nav class="main-nav" aria-label="ניווט ראשי" data-nav>
      <ul>
        <?php foreach ($nav as $id => $item): ?>
          <li><a href="<?= e($item['href']) ?>"<?= $id === $page_id ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
        <?php endforeach; ?>
      </ul>
      <a class="btn btn-wa nav-cta" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">
        <?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span>
      </a>
    </nav>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" data-nav-toggle>
      <span class="sr-only">תפריט</span>
      <?= icon('menu', 'icon icon-open') ?><?= icon('close', 'icon icon-close') ?>
    </button>
  </div>

  <div class="mobile-nav" id="mobile-nav" hidden data-mobile-nav>
    <ul>
      <?php foreach ($nav as $id => $item): ?>
        <li><a href="<?= e($item['href']) ?>"<?= $id === $page_id ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?><?= icon('arrow') ?></a></li>
      <?php endforeach; ?>
    </ul>
    <a class="btn btn-wa btn-block" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span>דברו איתי בוואטסאפ</span></a>
  </div>
</header>

<main id="main">
