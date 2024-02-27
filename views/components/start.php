<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 */
?>

<!doctype html>
<html lang="ru" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo $view->getTitle() ?></title>
    <script src="//site.com/playerjs.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">
    <script src="/assets/js/color-modes.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css" />


</head>
<body class="d-flex flex-column ">
<?php $view->components('header'); ?>