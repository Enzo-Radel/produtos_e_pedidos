<?php
namespace Controllers;

class Controller {

    protected static function view($view, $title = 'Produtos e Pedidos')
    {
        $layout["title"] = $title;
        $layout["childView"] = $view . ".php";
        require_once 'view/layout.php';
    }
}

?>