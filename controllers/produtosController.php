<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'model/Produto.php';

use Model\Produto;

class ProdutosController extends Controller{

    public function index() {
        $produto = new Produto();
        $produtos = $produto->listAll();

        $_REQUEST['produtos'] = $produtos;

        self::view('view/produtos/index', "Listar Produtos");
    }

    public function create() {
        self::view('view/produtos/create', "Criar Produto");
    }

    public function store() {
        $data = [];

        $data["id"] = $_REQUEST["id"];
        $data["descricao"] = $_REQUEST["descricao"];
        $data["valorVenda"] = $_REQUEST["valorVenda"];
        $data["estoque"] = $_REQUEST["estoque"];

        $produto = Produto::create($data);

        header('Location: '. "/produtos");
    }
}

?>