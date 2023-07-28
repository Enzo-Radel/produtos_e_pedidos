<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'model/Produto.php';

use Model\Produto;

class ProdutosController extends Controller{

    public static function index() {
        $produto = new Produto();
        $produtos = $produto->listAll();

        $_REQUEST['produtos'] = $produtos;

        self::view('view/produtos/index', "Listar Produtos");
    }
}

?>