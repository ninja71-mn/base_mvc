<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
    if (isset($key)){
        $keyword= $key;
    }else{
        $keyword="" ;
    }
    ?>

    <meta name="keywords" content="<?=$keyword?>" />
    <meta name="author" content="NINJA71.MN">
    <?php
    if (isset($des)){
        $description= $des;
    }else{
        $description="" ;
    }
    ?>
    <meta name="description" content="<?=$description?>" />


    <script src="<?=URLROOT?>/js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <link href="<?=URLROOT?>/css/select2.min.css" rel="stylesheet" />
    <script src="<?=URLROOT?>/js/select2.min.js"></script>

    <link rel="shortcut icon" type="image/x-icon" href="<?=URLROOT?>/img/favicon.ico" />
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <title><?=SITENAME?> | <?php
        if (isset($title)){
            echo $title;
        }
        ?></title>

</head>
<body>
<?php
require APPROOT.'/views/inc/nav.php';

?>
