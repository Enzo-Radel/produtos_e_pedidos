<?php

require_once "controllers/produtosController.php";

class Route
{
    public static function contentToRender() : void
    {
        $uri = self::processURI();
        if (class_exists($uri['controller'])) {
            $controller = $uri['controller'];
            $method = $uri['method'];
            $args = $uri['args'];
            //Now, the magic
            $args ? $controller::{$method}(...$args) :
                $controller::{$method}();
        }
    }

    private static function getURI() : array
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        return explode('/', $path_info);
    }

    private static function processURI() : array
    {
        $controllerPart = self::getURI()[1] ?? '';
        $methodPart = self::getURI()[2] ?? '';
        $numParts = count(self::getURI());
        $argsPart = [];
        for ($i = 3; $i < $numParts; $i++) {
            $argsPart[] = self::getURI()[$i] ?? '';
        }

        $controller = !empty($controllerPart) ?
        '\Controllers\\'.$controllerPart.'Controller' :
        '\Controllers\HomeController';

        $method = !empty($methodPart) ?
            $methodPart :
            'index';

        $args = !empty($argsPart) ?
            $argsPart :
            [];

        return [
            'controller' => $controller,
            'method' => $method,
            'args' => $args
        ];
    }
}