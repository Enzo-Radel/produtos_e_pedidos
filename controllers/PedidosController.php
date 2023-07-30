<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Pedido.php';

use Models\Pedido;

class PedidosController extends Controller
{

    public function index()
    {
        $pedidos = Pedido::getAll();

        $_REQUEST['pedidos'] = $pedidos;

        self::view('pedidos/index', "Listar Pedidos");
    }

    public function create()
    {
        self::view('pedidos/create', "Criar Pedido");
    }

    public function store()
    {
        // $imagens = ManageImagesHelper::Upload($_FILES['imagens']);

        // foreach ($imagens as $imagem) {
        //     if ($imagem == null) die("ouve um erro ao fazer upload de uma imagem, verifique se está usando um desses formatos (.jpeg, .jpg, .png)");
        // }

        // $data = [
        //     "id"            => $_REQUEST["id"],
        //     "descricao"    	=> $_REQUEST["descricao"],
        //     "valorVenda"    => $_REQUEST["valorVenda"],
        //     "estoque"		=> $_REQUEST["estoque"],
        //     "imagens_nomes"	=> $imagens
        // ];

		// $produto = Produto::create($data);

        // header('Location: '. "/produtos");
    }

    public function delete(int $id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();

        return;
    }

    // public function images(int $id)
    // {
    //     $produto = Produto::find($id);
    //     $imagens = $produto->getImages();

    //     $_REQUEST['imagens'] = $imagens;
    //     $_REQUEST['product_id'] = $id;

    //     self::view("produtos/edit_images", "Editar Produto #". $id);
    // }
}

?>