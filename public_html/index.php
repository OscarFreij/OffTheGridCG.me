<?php

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

require($MODULES_PATH."head.php");

echo('<video class="background-video"src="static/media/Stars.mp4" type="video/mp4" autoplay loop muted></video>');

echo("<div id='wrapper'>");

echo("<div id='icon'>");
echo("<a href='/?page=home'><img src='static/icon.png' alt='OF_ICON'></a>");
echo("</div>");

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
// Webpage building Ending //
?>