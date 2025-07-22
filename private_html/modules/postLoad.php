<div class="postLoad">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

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
?>
</div>

