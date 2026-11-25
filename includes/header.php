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

// The same page in the other language. $translated = false (Hebrew-only pages, like the articles)
// sends the switcher to the other language's home page and leaves out the hreflang links.
$page_file = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
$page_path = $canonical_path ?? ($page_file === 'index.php' ? '' : preg_replace('/\.php$/', '', $page_file));
$translated = $translated ?? true;
$he_url = 'https://' . $site['domain'] . '/' . $page_path;
$en_url = 'https://' . $site['domain'] . '/en/' . $page_path;
$canonical = $is_en ? $en_url : $he_url;
$switch_href = $is_en ? url($translated ? $page_path : '') : url('en/' . ($translated ? $page_path : ''));
?><!doctype html>
<html lang="<?= $is_en ? 'en' : 'he' ?>" dir="<?= $is_en ? 'ltr' : 'rtl' ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($page_title) ?></title>
  <?php if ($page_desc): ?><meta name="description" content="<?= e($page_desc) ?>"><?php endif; ?>
  <?php if (!empty($noindex) || $is_dev): ?>
  <meta name="robots" content="noindex">
  <?php else: ?>
  <link rel="canonical" href="<?= e($canonical) ?>">
  <?php if ($translated): ?>
  <link rel="alternate" hreflang="he" href="<?= e($he_url) ?>">
  <link rel="alternate" hreflang="en" href="<?= e($en_url) ?>">
  <link rel="alternate" hreflang="x-default" href="<?= e($he_url) ?>">
  <?php endif; ?>
  <?php endif; ?>
  <meta property="og:type" content="<?= e($og_type ?? 'website') ?>">
  <meta property="og:locale" content="<?= $is_en ? 'en_US' : 'he_IL' ?>">
  <meta property="og:site_name" content="SDmarketing">
  <meta property="og:title" content="<?= e($page_title) ?>">
  <?php if ($page_desc): ?><meta property="og:description" content="<?= e($page_desc) ?>"><?php endif; ?>
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:image" content="https://<?= e($site['domain']) ?>/<?= e($og_image ?? 'assets/img/founder.jpg') ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="theme-color" content="#0A0A0A">
  <link rel="icon" href="<?= url('assets/img/favicon.svg') ?>" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700;800;900&family=IBM+Plex+Sans+Hebrew:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= url('assets/css/style.css?v=171') ?>">
</head>
<?php
// Staging only: ?v=b turns on design variant B (a shorter home page on phones), to compare side by side with the current one.
$variant_b = $is_dev && ($_GET['v'] ?? '') === 'b';
?>
<body class="page-<?= e($page_id) ?><?= $variant_b ? ' v-b' : '' ?>">
<?php require __DIR__ . '/icons.php'; ?>
<a class="skip-link" href="#main"><?= tr('דילוג לתוכן', 'Skip to content') ?></a>
<?php if ($is_dev): ?><div class="env-badge" role="note"><?= tr('סביבת פיתוח', 'Staging') ?><?= $variant_b ? tr(' · גרסה B', ' · Variant B') : '' ?></div><?php endif; ?>

<header class="topbar" data-header>
  <div class="wrap nav">
    <a class="logo" href="<?= lurl('') ?>" aria-label="<?= tr('SDmarketing, לדף הבית', 'SDmarketing, home page') ?>">
      <?= logo_mark() ?>
      <span class="lt"><b>SD</b><small>marketing</small></span>
    </a>

    <nav class="menu" aria-label="<?= tr('ניווט ראשי', 'Main') ?>" data-nav>
      <?php foreach ($nav as $id => $item): ?>
        <a href="<?= e(lurl($item['href'])) ?>"<?= $id === $page_id ? ' class="on" aria-current="page"' : '' ?>><?= e($item['label']) ?></a>
      <?php endforeach; ?>
    </nav>

    <?= '<a class="lang-switch" href="' . e($switch_href) . '" hreflang="' . ($is_en ? 'he' : 'en') . '" lang="' . ($is_en ? 'he' : 'en') . '" aria-label="' . ($is_en ? 'עברית' : 'English') . '"><span aria-hidden="true">' . ($is_en ? 'עב' : 'EN') . '</span></a>' ?>

    <a class="btn btn-acc nav-wa" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener">
      <?= icon('whatsapp') ?><span class="nav-wa-full"><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span><span class="nav-wa-short"><?= tr('וואטסאפ', 'WhatsApp') ?></span>
    </a>

    <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="mobile-nav" data-nav-toggle>
      <span class="sr-only"><?= tr('תפריט', 'Menu') ?></span>
      <?= icon('menu', 'glyph icon-open') ?><?= icon('close', 'glyph icon-close') ?>
    </button>
  </div>

  <div class="mobile-nav" id="mobile-nav" hidden data-mobile-nav>
    <ul>
      <?php foreach ($nav as $id => $item): ?>
        <li><a href="<?= e(lurl($item['href'])) ?>"<?= $id === $page_id ? ' aria-current="page"' : '' ?>><?= e($item['label']) ?><?= icon('arrow') ?></a></li>
      <?php endforeach; ?>
      <li class="mn-lang"><a href="<?= e($switch_href) ?>" hreflang="<?= $is_en ? 'he' : 'en' ?>" lang="<?= $is_en ? 'he' : 'en' ?>"><?= $is_en ? 'עברית' : 'English' ?><?= icon('arrow') ?></a></li>
    </ul>
    <a class="btn btn-acc mn-cta" href="<?= e(wa_link($site)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?><span><?= tr('דברו איתי בוואטסאפ', 'Chat on WhatsApp') ?></span></a>
  </div>
</header>

<main id="main">
