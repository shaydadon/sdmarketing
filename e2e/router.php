<?php
// Router for the PHP dev server used by the tests: mirrors the clean-URL rules in /.htaccess,
// which the built-in server does not read.  php -S localhost:8790 -t <root> e2e/router.php
$root = dirname(__DIR__);
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$qs   = $_SERVER['QUERY_STRING'] ?? '';
$get  = in_array($_SERVER['REQUEST_METHOD'], ['GET', 'HEAD'], true);
$pages = 'services|projects|articles|about|contact|terms|privacy|accessibility';

function redirect(string $to): void
{
    header('Location: ' . $to, true, 301);
    exit;
}

function serve(string $script, string $root): void
{
    $_SERVER['SCRIPT_NAME'] = '/' . $script;
    $_SERVER['SCRIPT_FILENAME'] = $root . '/' . $script;
    chdir($root);
    require $root . '/' . $script;
    exit;
}

// Old addresses -> clean ones (301), like .htaccess
if ($get && $uri === '/index.php') {
    redirect('/' . ($qs !== '' ? '?' . $qs : ''));
}
if ($get && $uri === '/article.php' && preg_match('/^slug=([a-z0-9-]+)$/', $qs, $m)) {
    redirect('/articles/' . $m[1]);
}
if ($get && preg_match('#^/(' . $pages . ')\.php$#', $uri, $m)) {
    redirect('/' . $m[1] . ($qs !== '' ? '?' . $qs : ''));
}
if ($get && $uri !== '/' && str_ends_with($uri, '/') && !is_dir($root . $uri)) {
    redirect(rtrim($uri, '/'));
}

// Clean address -> PHP file
if (preg_match('#^/articles/([a-z0-9-]+)$#', $uri, $m)) {
    $_GET['slug'] = $m[1];
    serve('article.php', $root);
}
if (preg_match('#^/([a-z]+)$#', $uri, $m) && is_file("$root/{$m[1]}.php")) {
    serve($m[1] . '.php', $root);
}
if ($uri === '/') {
    serve('index.php', $root);
}

// Real files (assets, .php called directly by POST) are served as they are
if (is_file($root . $uri)) {
    if (str_ends_with($uri, '.php')) {
        serve(ltrim($uri, '/'), $root);
    }
    return false;
}

http_response_code(404);
serve('404.php', $root);
