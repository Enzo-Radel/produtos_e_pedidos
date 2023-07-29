<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Produto.php';

use Models\Produto;

class ProdutosController extends Controller
{

    public function index()
    {
        $produto = new Produto();
        $produtos = $produto->getAll();

        $_REQUEST['produtos'] = $produtos;

        self::view('produtos/index', "Listar Produtos");
    }

    public function edit(int $id)
    {
        $produto = Produto::find($id);

        $_REQUEST['produto'] = $produto;

        self::view("produtos/edit", "Editar Produto #". $id);
    }

    public function create()
    {
        self::view('produtos/create', "Criar Produto");
    }

    public function store()
    {
        $data = [];

        $data["id"] = $_REQUEST["id"];
        $data["descricao"] = $_REQUEST["descricao"];
        $data["valorVenda"] = $_REQUEST["valorVenda"];
        $data["estoque"] = $_REQUEST["estoque"];

        $produto = Produto::create($data);

        header('Location: '. "/produtos");
    }

    public function update(int $id)
    {
        $produto = Produto::find($id);

        $data = [];

        $data["descricao"] = $_REQUEST["descricao"];
        $data["valorVenda"] = $_REQUEST["valorVenda"];
        $data["estoque"] = $_REQUEST["estoque"];

        $produto = $produto->update($data);

        header('Location: '. "/produtos");
    }

    public function delete(int $id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        header('Location: '. "/produtos");
    }
}

?>