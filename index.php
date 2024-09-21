<?php
require 'vendor/autoload.php';

const BASE_DIR = __DIR__;

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $controllers = [];
    foreach (new DirectoryIterator(BASE_DIR . '/src/Controller/') as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
            // Get the class name from the file (PSR-4 autoloading)
            $class_name = 'Tarkov\\Controller\\' . $fileInfo->getBasename('.php');

            // Check if the class exists and belongs to the controller namespace
            if (str_starts_with($class_name, 'Tarkov\\Controller\\') && class_exists($class_name)) {
                $reflection = new ReflectionClass($class_name);

                // Check if the class has a static $routes property
                if ($reflection->hasProperty('routes') && $reflection->getProperty('routes')->isStatic()) {
                    $controllers[] = $class_name;
                }
            }
        }
    }

    // Loop through each controller and register its routes
    foreach ($controllers as $controller) {
        if (isset($controller::$routes)) {
            foreach ($controller::$routes as $http_method => $routes) {
                foreach ($routes as $route_path => $handler) {
                    $r->addRoute($http_method, $route_path, $handler);
                }
            }
        }
    }
});

$http_method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);

$route_info = $dispatcher->dispatch($http_method, $uri);
switch ($route_info[0]) {
    case FastRoute\Dispatcher::FOUND:
        $handler = $route_info[1];
        $vars = $route_info[2];
        $controller = new $handler[0];
        call_user_func([$controller, $handler[1]], $vars);
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        break;
}

