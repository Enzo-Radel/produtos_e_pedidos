<?php
namespace Controllers;

require_once __DIR__."/../utils/FlashMessageHelper.php";

use Utils\FlashMessageHelper;

class Controller
{

    protected static function view($view, $title = 'Produtos e Pedidos')
    {
        $layout["title"] = $title;
        $layout["childView"] = "view/". $view . ".php";
        require_once 'view/layout.php';
    }

    protected static function setAlert(string $type, string $message)
    {
        FlashMessageHelper::setFlashMessage($type, $message);
    }
}

?>