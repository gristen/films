<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\HTTP\RedirectInterface;
use App\Kernel\HTTP\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
    ) {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            echo '404';
            exit();
        }

        if (is_array($route->getAction())) {

            [$controller,$action] = $route->getAction();
            /*** @var Controller $controller*/
            $controller = new $controller();
            //если мы роут нашли , мы инжектим вьюшку и рекуест , чтобы в нашем контроллере мы могли обратиться к вьюшкам и данными с рекуеста , такими как $_POST FILES ...
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, $action]);

            // $controller->$action();

        } else {
            $route->getAction()();
        }

    }

    private function findRoute($uri, $method): Route|false
    {
        if (! isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route; // в ключ мы вносим метод , а в значение уже ури
        }

    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once APP_PATH.'./config/routes.php';
    }
}
