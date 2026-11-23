<?php
require_once __DIR__ . '/config.php';
$page_id    = $page_id    ?? 'index';
$page_title = $page_title ?? $site['name'];
$page_desc  = $page_desc  ?? '';
$header_theme = $header_theme ?? 'dark';

function logo_mark(): string
{
    return '<span class="mk"><svg aria-hidden="true" focusable="false"><use href="#i-logo"/></svg></span>';
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
  <meta name="theme-color" content="#0A0A0A">
  <link rel="icon" href="assets/img/favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700;800;900&family=IBM+Plex+Sans+Hebrew:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css?v=36">
</head>
<body class="page-<?= e($page_id) ?>">
<?php require __DIR__ . '/icons.php'; ?>
<a class="skip-link" href="#main">דילוג לתוכן</a>
<?php if ($is_dev): ?><div class="env-badge" role="note">סביבת פיתוח</div><?php endif; ?>

<header class="topbar" data-header>
  <div class="wrap nav">
    <a class="logo" href="index.php" aria-label="SDmarketing, לדף הבית">
      <?= logo_mark() ?>
      <span class="lt"><b>SD</b><small>marketing</small></span>
    </a>

    <nav class="menu" aria-label="ניווט ראשי" data-nav>
      <?php foreach ($nav as $id => $item): ?>
        <a href="<?= e($item['href']) ?>"<?= $id === $page_id ? ' class="on" aria-current="page"' : '' ?>><?= e($item['label']) ?><?php if (!empty($item['soon'])): ?><i class="soon-badge">בקרוב</i><?php endif; ?></a>
      <?php endforeach; ?>
    </nav>

    <a class="btn btn-acc nav-wa" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">
      <?= icon('whatsapp') ?><span class="nav-wa-full">דברו איתי בוואטסאפ</span><span class="nav-wa-short">וואטסאפ</span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" data-nav-toggle>
      <span class="sr-only">תפריט</span>
      <?= icon('menu', 'glyph icon-open') ?><?= icon('close', 'glyph icon-close') ?>
    </button>
  </div>

  <div class="mobile-nav" id="mobile-nav" hidden data-mobile-nav>
    <ul>
      <?php foreach ($nav as $id => $item): ?>
        <li><a href="<?= e($item['href']) ?>"<?= $id === $page_id ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?><?php if (!empty($item['soon'])): ?><i class="soon-badge">בקרוב</i><?php endif; ?><?= icon('arrow') ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</header>

<main id="main">
