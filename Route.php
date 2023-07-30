<?php

require_once "controllers/ProdutosController.php";
require_once "controllers/ImagensController.php";
require_once "controllers/PedidosController.php";

class Route
{
    public static function contentToRender() : void
    {
        $uri = self::processURI();
        if (class_exists($uri['controller']))
        {
            $controller = $uri['controller'];
            $method = $uri['method'];
            $args = $uri['args'];
            $args ? (new $controller)->{$method}(...$args) :
                (new $controller)->{$method}();
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
        for ($i = 3; $i < $numParts; $i++)
        {
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