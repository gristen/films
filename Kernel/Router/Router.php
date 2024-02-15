<?php

namespace App\Kernel\Router;

use App\Kernel\auth\AuthInterface;
use App\Kernel\Controller\Controller;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\HTTP\RedirectInterface;
use App\Kernel\HTTP\RequestInterface;
use App\Kernel\Midleware\AbstractMiddleware;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
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
        private DatabaseInterface $database,
        private AuthInterface $auth,
        private StorageInterface $storage,
    ) {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if (! $route) {
            $this->view->page("404",[],"упс...");
            exit();
        }

        if ($route->hasMiddlewaires()) {
            /**
             * @var AbstractMiddleware $middleware
             */
            foreach ($route->getMiddleware() as $middleware) {
                $middleware = new $middleware($this->request, $this->auth, $this->redirect);
                $middleware->handle();
            }
        }

        if (is_array($route->getAction())) {

            [$controller,$action] = $route->getAction(); //action - класс контроллера и сам метод
            /*** @var Controller $controller*/
            $controller = new $controller();
            //если мы роут нашли , мы инжектим вьюшку и рекуест , чтобы в нашем контроллере мы могли обратиться к вьюшкам и данными с рекуеста , такими как $_POST FILES ...
            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setAuth'], $this->auth);
            call_user_func([$controller, 'setStorage'], $this->storage);
            call_user_func([$controller, $action]);

            // $controller->$action();

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
