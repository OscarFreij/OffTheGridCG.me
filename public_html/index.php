<?php
// Include kernel //
require_once __DIR__ . '/../private_html/classes/kernel.php';
use OffTheGridCG\ENV;
use OffTheGridCG\CONFIG;
$CONFIG = CONFIG::getInstance();
use OffTheGridCG\CSP;
use OffTheGridCG\Functions;
// Setup CSP header //
CSP::setHeader();

// Routing Beginning //
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($requestPath === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    echo Functions::renderSitemap();
    exit;
}

if ($requestPath === '/robots.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo Functions::renderRobotsTxt();
    exit;
}

if ($requestPath === '/llms.txt') {
    header('Content-Type: text/plain; charset=UTF-8');
    echo Functions::renderLlmsTxt();
    exit;
}

$pathSegments = array_values(array_filter(explode('/', trim($requestPath, '/')), fn($segment) => $segment !== ''));
$page = $pathSegments[0] ?? null;
$pageIsValid = $page !== null && preg_match('/^[a-z0-9-]+$/', $page) === 1;
// Routing Ending //

// Webpage building Beginning //
?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once $CONFIG->get('MODULES_PATH').'head.php';
?>
<body class="page-<?= $page === null ? 'home' : ($pageIsValid ? $page : '404') ?>">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $CONFIG->get('GTM_TAG') ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
    require_once $CONFIG->get('MODULES_PATH').'navbar.php';
    ?>
    <div class="wrapper">
        <?php
        $pagesPath = $CONFIG->get('PAGES_PATH');
        if ($page === null)
        {
            require $pagesPath.'home.php';
        }
        else if ($pageIsValid && file_exists($pagesPath.$page.'.php'))
        {
            require $pagesPath.$page.'.php';
        }
        else
        {
            require $CONFIG->get('EPAGES_PATH')."404.html";
        }
        ?>
    </div>
    <?php
    require $CONFIG->get('MODULES_PATH')."footer.php";
    require $CONFIG->get('MODULES_PATH')."postLoad.php";
    ?>
</body>
</html>
<?php
// Webpage building Ending //
?>