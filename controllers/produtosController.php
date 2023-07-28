<?php
namespace Controllers;

require_once 'model/Produto.php';

use Model\Produto;

class ProdutosController {

    public static function index() {
    $produto = new Produto();
    $produtos = $produto->listAll();

    $_REQUEST['produtos'] = $produtos;

    require_once 'view/produtos/index.php';
    }
}

?>