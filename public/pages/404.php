<?php
use app\Services\Page;
?>
<!doctype html>
<html lang="ru">
<?php
Page::part("header");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>not fount</title>
</head>
<body>
<?php
Page::part("nav");
?>
    <h1 class="text text-center text-uppercase">Страница не найдена . Смотри что пишешь в URL</h1>
</body>
</html>