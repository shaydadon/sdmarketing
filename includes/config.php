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
    'index'    => ['href' => 'index.php',    'label' => 'בית'],
    'services' => ['href' => 'services.php', 'label' => 'שירותים'],
    'projects' => ['href' => 'projects.php', 'label' => 'פרויקטים'],
    'about'    => ['href' => 'about.php',    'label' => 'אודות'],
    'contact'  => ['href' => 'contact.php',  'label' => 'צור קשר'],
];

function wa_link(array $site, ?string $text = null): string
{
    return 'https://wa.me/' . $site['whatsapp'] . '?text=' . rawurlencode($text ?? $site['wa_text']);
}

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
