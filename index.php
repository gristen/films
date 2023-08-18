<?php

require_once __DIR__."/vendor/autoload.php";

try {


    $route = $_GET['route'] ?? '';
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
       throw new \app\Exceptions\NotFoundException();
    }

//
    unset($matches[0]);


    $controllerName = $controllerAndAction[0];

    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    $controller->$actionName(...$matches);

}catch (\app\Exceptions\DbException $e)
{
   $view = new  \app\Views\Views();
   $view->generate('500.php',['error'=>$e->getMessage()],500);
}
catch (\app\Exceptions\NotFoundException $e)
{
    $view = new  \app\Views\Views();
    $view->generate('404.php',['error'=>$e->getMessage()],404);
}