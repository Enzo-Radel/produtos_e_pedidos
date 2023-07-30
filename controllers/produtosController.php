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
        $imagens = $produto->getImages();

        $_REQUEST['produto'] = $produto;
        $_REQUEST['imagens'] = $imagens;

        self::view("produtos/edit", "Editar Produto #". $id);
    }

    public function update(int $id)
    {
        $_PUT = json_decode(file_get_contents('php://input'));

        $produto = Produto::find($id);

        $data = [];

        $data["descricao"] = $_PUT->descricao;
        $data["valorVenda"] = $_PUT->valorVenda;
        $data["estoque"] = $_PUT->estoque;

        $produto = $produto->update($data);

        return;
    }

    public function delete(int $id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return;
    }

    public function images(int $id)
    {
        $produto = Produto::find($id);
        $imagens = $produto->getImages();

        $_REQUEST['imagens'] = $imagens;
        $_REQUEST['product_id'] = $id;

        self::view("produtos/edit_images", "Editar Produto #". $id);
    }
}

?>