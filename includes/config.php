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

// Language: Hebrew (RTL) is the main site at the root; English (LTR) lives under /en/.
// An /en/ page sets $lang = 'en' and loads the same template as its Hebrew twin; tr() picks the wording.
$lang = $GLOBALS['lang'] = (($lang ?? 'he') === 'en') ? 'en' : 'he';
$is_en = $lang === 'en';

/** Hebrew or English copy for the current page. Both arguments are trusted literals (may hold HTML). */
function tr(string $he, string $en): string
{
    return ($GLOBALS['lang'] ?? 'he') === 'en' ? $en : $he;
}

// Legal pages show the update date as written in Hebrew (day.month.year), and in English as "October 11, 2026".
$d = DateTime::createFromFormat('!d.m.Y', $site['legal_updated']);
$site['legal_updated_display'] = ($is_en && $d) ? $d->format('F j, Y') : $site['legal_updated'];
unset($d);

if ($is_en) {
    $site['wa_text'] = "Hi, I found you on the website and I'd like to hear more";
    $site['phone_display'] = '+972-52-620-3423';
} else {
    $site['phone_display'] = $site['phone'];
}

$nav = $is_en ? [
    // English has no articles yet, so no Articles item.
    'services' => ['href' => 'services', 'label' => 'Services'],
    'projects' => ['href' => 'projects', 'label' => 'Projects'],
    'about'    => ['href' => 'about',    'label' => 'About'],
    'contact'  => ['href' => 'contact',  'label' => 'Contact'],
] : [
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
// The /en/ pages run from the en/ folder, so the site root is one level up from them.
$base = $GLOBALS['base'] = preg_replace('#/en$#', '', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/')) . '/';

/** Root-relative URL for a clean path: url('') is home, url('services#seo'), url('articles/landing-page'), url('assets/...'). */
function url(string $path = ''): string
{
    return ($GLOBALS['base'] ?? '/') . ltrim($path, '/');
}

/** Like url(), for a page in the current language: lurl('services') is /services or /en/services. */
function lurl(string $path = ''): string
{
    return url((($GLOBALS['lang'] ?? 'he') === 'en' ? 'en/' : '') . ltrim($path, '/'));
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
