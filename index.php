<?php

require_once __DIR__."/vendor/autoload.php";

//require_once __DIR__."/app/routes/routes.php";

$route = $_GET['route']??'';
$routes = require __DIR__ . '/app/routes/routes.php';


$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {

    preg_match($pattern, $route, $matches); //preg match проверка на соответсвие регулярки.pattern Искомый шаблон в виде строки.$route Входная строка. В случае, если указан дополнительный параметр matches, он будет заполнен результатами поиска
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}


if (!$isRouteFound) {
    echo 'Страница не найдена!';
    return;
}

//
unset($matches[0]);



$controllerName = $controllerAndAction[0];

$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);