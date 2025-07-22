<?php
// Setup CSP header
header("content-security-policy: default-src 'self'; style-src-elem 'self' fonts.googleapis.com; font-src 'self' fonts.gstatic.com; script-src 'self' https://code.jquery.com");

// Path Config Beginning //
$JS_PATH = "static/js/";
$CSS_PATH = "static/css/";
$VIDEO_PATH = "static/videos/";
$PICTURE_PATH = "static/pictures/";

$MODULES_PATH = "../private_html/modules/";
$PAGES_PATH = "../private_html/pages/";
$EPAGES_PATH = "../private_html/pages/errors/";
$VENDOR_PATH = "../private_html/vendor/";

// Path Config Ending //

// Webpage building Beginning //
?>
<!DOCTYPE html>
<html lang="en">
<?php
require_once $MODULES_PATH.'head.php';
?>
<body>
    <video autoplay muted loop id="bg-video">
        <source src="<?=$VIDEO_PATH."Stars.mp4"?>" type="video/mp4">
    </video>
    <?php
    require_once $MODULES_PATH.'navbar.php';
    ?>
    <div class="wrapper">
        <?php
        if (!isset($_GET['page']))
        {
            require $PAGES_PATH.'home.php';
        }
        else if (file_exists($PAGES_PATH.$_GET['page'].'.php'))
        {
            require $PAGES_PATH.$_GET['page'].'.php';
        }
        else
        {
            require $EPAGES_PATH."404.html";
        }
        ?>
    </div>
    <?php
    require $MODULES_PATH."postLoad.php";
    ?>
</body>
</html>
<?php
// Webpage building Ending //
?>