<?php
// Setup CSP header
header("content-security-policy: default-src 'self'; style-src-elem 'self' fonts.googleapis.com; font-src 'self' fonts.gstatic.com;");

// Path Config Beginning //
$JS_PATH = "static/js/";
$CSS_PATH = "static/css/";
$MEDIA_PATH = "static/media/";

$MODULES_PATH = "../private_html/modules/";
$PAGES_PATH = "../private_html/pages/";
$VENDOR_PATH = "../private_html/vendor/";

// Path Config Ending //

// Webpage building Beginning //
echo("<!DOCTYPE html>");
echo("<html lang='en'>");

require($MODULES_PATH."head.php");

echo("<body>");

echo('<video class="background-video" src="static/media/Stars.mp4" autoplay loop muted></video>');

echo("<div id='wrapper'>");

echo("<div id='nav-wrapper'>");
require($MODULES_PATH."navbar.php");
echo("</div>");

echo("<div id='content-wrapper'>");

if (isset($_GET["page"]))
{
    switch ($_GET["page"])
    {
        case 'home':
            if(file_exists($PAGES_PATH."home.php"))
            {
                require($PAGES_PATH."home.php");
            }
            else
            {
                require($PAGES_PATH."error_pages/404.php");    
            }
            break;

        case 'projects':
            if(file_exists($PAGES_PATH."projects.php"))
            {
                require($PAGES_PATH."projects.php");
            }
            else
            {
                require($PAGES_PATH."error_pages/404.php");    
            }
            break;

        case 'about':
            if(file_exists($PAGES_PATH."about.php"))
            {
                require($PAGES_PATH."about.php");
            }
            else
            {
                require($PAGES_PATH."error_pages/404.php");    
            }
            break;

        case 'contact':
            if(file_exists($PAGES_PATH."contact.php"))
            {
                require($PAGES_PATH."contact.php");
            }
            else
            {
                require($PAGES_PATH."error_pages/404.php");    
            }
            break;

        default:
            require($PAGES_PATH."error_pages/404.php");
            break;
    }
}
else
{
    if(file_exists($PAGES_PATH."home.php"))
    {
        require($PAGES_PATH."home.php");
    }
    else
    {
        require($PAGES_PATH."error_pages/404.php");    
    }
}



echo("</div>");
echo("<div id='footer-wrapper'></div>");
echo("</div>");
echo("</body>");
echo("</html>");
// Webpage building Ending //
?>
