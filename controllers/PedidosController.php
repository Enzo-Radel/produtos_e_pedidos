<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Pedido.php';
require_once 'models/Produto.php';

use Models\Produto;
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
        $produtos = Produto::getAll();
        $_REQUEST['produtos'] = $produtos;

        self::view('pedidos/create', "Criar Pedido");
    }

    public function store()
    {
        $data = [
            "cliente"   => $_POST["cliente"],
        ];

        $pedido = Pedido::create($data);

        $produtos_ids = array_keys($_POST["produtos"]);

        $produtos = [];

        foreach ($produtos_ids as $produto_id) {
            $produtos[] = [
                "id"            => $produto_id,
                "quantidade"    => $_POST["quantidade"][$produto_id]
            ];
        }

        $pedido->addProducts($produtos);

        header('Location: '. "/pedidos");
    }

    public function delete(int $id)
    {
        $pedido = Pedido::find($id);

        if (is_null($pedido)) {
            header('Location: '. "/pedidos");
        }

        $pedido->delete();

        return;
    }
}

?>