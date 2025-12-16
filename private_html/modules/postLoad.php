<div class="postLoad">
    <script src="<?=$JS_PATH?>jquery-3.6.3.min.js"></script>
    <script src="<?=$JS_PATH?>main.js"></script>
    <script src="<?=$JS_PATH?>navbar.js"></script>
<?php
    if (isset($_GET["page"]))
    {
        if (file_exists($JS_PATH.$_GET['page'].".js"))
        {
            echo('<script src="'.$JS_PATH.$_GET['page'].".js".'"></script>');
        }
    }
    else
    {
        echo('<script src="'.$JS_PATH."home.js".'"></script>');
    }
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JPXWH16T57"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JPXWH16T57');
</script>
</div>

