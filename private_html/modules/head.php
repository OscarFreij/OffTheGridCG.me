<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="pwWw4OEiGOC_qOevjflKBmTLuIrsSBpB62auBbw9MtQ">

    <link rel="stylesheet" href="<?=$CSS_PATH."navbar.css"?>">
    <link rel="stylesheet" href="<?=$CSS_PATH."master.css"?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto&family=Ubuntu+Mono&display=swap" rel="stylesheet">

    <?php
    if (isset($_GET["page"]))
    {
        if (file_exists($CSS_PATH.$_GET['page'].".css"))
        {
            echo('<link rel="stylesheet" href="'.$CSS_PATH.$_GET['page'].".css".'">');
        }
    }
    ?>

    <title>Website of OffTheGridCG</title>
</head>
