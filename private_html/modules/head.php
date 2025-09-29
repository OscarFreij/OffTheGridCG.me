<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="google-site-verification" content="pwWw4OEiGOC_qOevjflKBmTLuIrsSBpB62auBbw9MtQ">

    <link rel="preconnect" href="static/fonts">
    <link rel="stylesheet" href="<?=$CSS_PATH."google_fonts.css"?>">

    <link rel="stylesheet" href="<?=$CSS_PATH."navbar.css"?>">
    <link rel="stylesheet" href="<?=$CSS_PATH."master.css"?>">
    
    

    <?php
    if (isset($_GET["page"]))
    {
        if (file_exists($CSS_PATH.$_GET['page'].".css"))
        {
            echo('<link rel="stylesheet" href="'.$CSS_PATH.$_GET['page'].".css".'">');
        }

        switch ($_GET["page"]) {
            case 'home':
                ?>
                <meta name="description" content="Official homepage of OffTheGridCG">
                <?php
                break;
            case 'about':
                ?>
                <meta name="description" content="About me and my intressts.">
                <?php
                break;
            case 'project':
                ?>
                <meta name="description" content="A selection list of my projects that I have or currently am working on. With links for more info.">
                <?php
                break;
            case 'contact':
                ?>
                <meta name="description" content="How to get in contact with me in various ways.">
                <?php
                break;
        }
    }
    else
    {
        ?>
        <meta name="description" content="Official homepage of OffTheGridCG">
        <link rel="stylesheet" href="<?=$CSS_PATH."home.css"?>">
        <?php
    }
    ?>

    <title>Website of OffTheGridCG</title>
</head>
