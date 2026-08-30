<div class="postLoad">
    <script src="<?=$CONFIG->get('JS_PATH')?>navbar.js" defer></script>
<?php
    if ($page !== null)
    {
        if (file_exists($CONFIG->get('JS_PATH').$page.".js"))
        {
            echo('<script src="'.$CONFIG->get('JS_PATH').$page.".js".'" defer></script>');
        }
    }
    else
    {
        echo('<script src="'.$CONFIG->get('JS_PATH')."home.js".'" defer></script>');
    }
?>
</div>

