<?php

require_once("Route.php");

Route::contentToRender();

// function getURI() : array
// {
//     $path_info = $_SERVER['PATH_INFO'] ?? '/';
//     return explode('/', $path_info);
// }

// $uri = getURI();

// echo $uri[2];

// $classe = $_GET['class'];
// $metodo = $_GET['acao'];

// $classe .= 'Controller';

// require_once 'controllers/'.$classe.'.php';

// $obj = new $classe();
// $obj->$metodo();
?>