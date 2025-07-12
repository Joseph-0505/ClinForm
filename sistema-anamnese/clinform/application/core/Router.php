<?php

namespace Application\Core;

class Router
{
    public function run()
    {
        $url = $_GET['url'] ?? 'home/index';
        $url = explode('/', trim($url, '/'));

        $controllerName = ucfirst($url[0]) . 'Controller';
        $method = $url[1] ?? 'index';
        $params = array_slice($url, 2);

        $controllerFile = "../application/controllers/{$controllerName}.php";
        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $controllerNamespace = "Application\\Controllers\\{$controllerName}";
            $controller = new $controllerNamespace();
            if (method_exists($controller, $method)) {
                call_user_func_array([$controller, $method], $params);
                return;
            }
        }

        echo "Página não encontrada.";
    }
}
