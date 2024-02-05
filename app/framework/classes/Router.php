<?php

namespace app\framework\classes;

use Exception;

class Router
{
    private string $path;
    private string $request;

    private function routeFound($routes)
    {
        if (!isset($routes[$this->request])) {
            throw new Exception("Route {$this->path} does not exists");
        }

        if (!isset($routes[$this->request][$this->path])) {
            throw new Exception("Route {$this->path} does not exists");
        }
    }
    private function controllerFound(string $controllerNameSpace, string $controller, string $action)
    {
        if (!class_exists($controllerNameSpace)) {
            throw new Exception("The controller '{$controller}' does not exist.");
        }
        if (!method_exists($controllerNameSpace, $action)) {
            throw new Exception("The action '{$action}' does not exist in  '{$controller}'.");
        }
    }

    public function execute($routes)
    {
        $this->path = path();
        $this->request = request();

        $this->routeFound($routes);


        [$controller, $action] = explode('@', $routes[$this->request][$this->path]);

        $controllerNameSpace = "app\\controllers\\{$controller}";

        $this->controllerFound($controllerNameSpace, $controller, $action);

        $controllerInstance = new $controllerNameSpace;
        $controllerInstance->$action();
    }
}
