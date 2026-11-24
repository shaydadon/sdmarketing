<?php
// Site-wide settings.
$site = [
    'name'      => 'SDmarketing',
    'domain'    => 'sdmarketing.co.il',
    'whatsapp'  => '972526203423',            // international format, no "+"
    'phone'     => '052-620-3423',
    'email'     => 'shay@sdmarketing.co.il',
    'wa_text'   => 'היי, הגעתי מהאתר ואשמח לשמוע עוד',

    // Legal pages (terms / privacy / accessibility)
    'owner'         => 'שי דדון',
    'business_type' => '[עוסק פטור / עוסק מורשה]', // TODO
    'business_id'   => '[מספר עוסק]',              // TODO
    'city'          => '[עיר]',                    // TODO: business address city
    'legal_updated' => '11.10.2026',
];

$nav = [
    // Order by importance; the logo links home, so there is no 'Home' item.
    'services' => ['href' => 'services', 'label' => 'שירותים'],
    'projects' => ['href' => 'projects', 'label' => 'פרויקטים'],
    'articles' => ['href' => 'articles', 'label' => 'מאמרים'],
    'about'    => ['href' => 'about',    'label' => 'אודות'],
    'contact'  => ['href' => 'contact',  'label' => 'צור קשר'],
];

// True on the staging copy (dev.sdmarketing.co.il): hidden from search engines, marked emails, visible badge.
// Clean URLs (see .htaccess): pages are /services, /projects, ..., articles are /articles/<slug>.
// Every internal link and asset is written from the site root, so it works from /articles/<slug> too,
// and from a copy of the site in a sub-folder (the root is the folder the PHP script runs from).
$base = $GLOBALS['base'] = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/') . '/';

/** Root-relative URL for a clean path: url('') is home, url('services#seo'), url('articles/landing-page'), url('assets/...'). */
function url(string $path = ''): string
{
    return ($GLOBALS['base'] ?? '/') . ltrim($path, '/');
}

$is_dev = str_starts_with(strtolower($_SERVER['HTTP_HOST'] ?? ''), 'dev.');

function wa_link(array $site, ?string $text = null): string
{
    return 'https://wa.me/' . $site['whatsapp'] . '?text=' . rawurlencode($text ?? $site['wa_text']);
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
