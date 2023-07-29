<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Produto.php';

require_once __DIR__."/../utils/UploadImageService.php";

use Models\Produto;
use Utils\UploadImageService;

class ProdutosController extends Controller
{

    public function index()
    {
        $produto = new Produto();
        $produtos = $produto->getAll();

        $_REQUEST['produtos'] = $produtos;

        self::view('produtos/index', "Listar Produtos");
    }

    public function create()
    {
        self::view('produtos/create', "Criar Produto");
    }

    public function store()
    {
        $imagens = UploadImageService::Execute($_FILES['imagens']);

        foreach ($imagens as $imagem) {
            if ($imagem == null) die("ouve um erro ao fazer upload de uma imagem, verifique se está usando um desses formatos (.jpeg, .jpg, .png)");
        }

        $data = [
            "id"            => $_REQUEST["id"],
            "descricao"    	=> $_REQUEST["descricao"],
            "valorVenda"    => $_REQUEST["valorVenda"],
            "estoque"		=> $_REQUEST["estoque"],
            "imagens_nomes"	=> $imagens
        ];

		$produto = Produto::create($data);

        header('Location: '. "/produtos");
    }

    public function edit(int $id)
    {
        $produto = Produto::find($id);

        $_REQUEST['produto'] = $produto;

        self::view("produtos/edit", "Editar Produto #". $id);
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

        return;
    }
}

?>