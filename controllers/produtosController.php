<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Produto.php';

require_once __DIR__."/../utils/ManageImagesHelper.php";

use Models\Produto;
use Utils\ManageImagesHelper;

class ProdutosController extends Controller
{

    public function index()
    {
        $produtos = Produto::getAll();

        $_REQUEST['produtos'] = $produtos;

        self::view('produtos/index', "Listar Produtos");
    }

    public function create()
    {
        self::view('produtos/create', "Criar Produto");
    }

    public function store()
    {
        if (!is_null(Produto::find($_REQUEST["id"]))) {
            self::setAlert("danger", "O id ".$_REQUEST["id"]." já está cadastrado no sistema");
            header('Location: '. "/produtos/create");
            die();
        }

        $imagens = ManageImagesHelper::Upload($_FILES['imagens']);

        foreach ($imagens as $imagem) {
            if ($imagem == null)
            {
                self::setAlert("danger", "Houve um erro ao fazer upload de uma imagem, verifique se está usando um desses formatos (".ManageImagesHelper::returnAllowedTypesAsStr().")");
                header('Location: '. "/produtos/create");
                die();
            }
        }

        $data = [
            "id"            => $_REQUEST["id"],
            "descricao"    	=> $_REQUEST["descricao"],
            "valorVenda"    => $_REQUEST["valorVenda"],
            "estoque"		=> $_REQUEST["estoque"],
            "imagens_nomes"	=> $imagens
        ];

		Produto::create($data);

        self::setAlert("success", "Produto cadastrado com sucesso");
        header('Location: '. "/produtos");
        die();
    }

    public function edit(int $id)
    {
        $produto = Produto::find($id);

        if (is_null($produto)) {
            self::setAlert("warning", "O id ".$_REQUEST["id"]." não existe no sistema");
            header('Location: '. "/produtos");
            die();
        }

        $imagens = $produto->getImages();

        $_REQUEST['produto'] = $produto;
        $_REQUEST['imagens'] = $imagens;

        self::view("produtos/edit", "Editar Produto #". $id);
    }

    public function update(int $id)
    {
        $_PUT = json_decode(file_get_contents('php://input'));

        $produto = Produto::find($id);

        if (is_null($produto)) {
            self::setAlert("warning", "O id ".$_REQUEST["id"]." não existe no sistema");
            header('Location: '. "/produtos");
            die();
        }

        $data = [];

        $data["descricao"] = $_PUT->descricao;
        $data["valorVenda"] = $_PUT->valorVenda;
        $data["estoque"] = $_PUT->estoque;

        $produto = $produto->update($data);

        self::setAlert("success", "Produto Atualizado com sucesso");

        return;
    }

    public function delete(int $id)
    {
        $produto = Produto::find($id);

        if (is_null($produto)) {
            self::setAlert("warning", "O id ".$_REQUEST["id"]." não existe no sistema");
            header('Location: '. "/produtos");
            die();
        }

        $produto->delete();

        self::setAlert("success", "Produto deletado com sucesso");

        return;
    }

    public function images(int $id)
    {
        $produto = Produto::find($id);

        if (is_null($produto)) {
            self::setAlert("warning", "O id ".$_REQUEST["id"]." não existe no sistema");
            header('Location: '. "/produtos");
            die();
        }
        
        $imagens = $produto->getImages();

        $_REQUEST['imagens'] = $imagens;
        $_REQUEST['product_id'] = $id;

        self::view("produtos/edit_images", "Editar Produto #". $id);
    }
}

?>