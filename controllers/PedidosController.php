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
        if (!isset($_POST["produtos"])) {
            self::setAlert("warning", "Não é permitido cadastrar um pedido sem produtos");
            header('Location: '. "/pedidos/create");
            die();
        }

        $produtos_ids = array_keys($_POST["produtos"]);

        $produtos = [];

        foreach ($produtos_ids as $produto_id) {
            var_dump($_POST["quantidade"][$produto_id] == "" || $_POST["quantidade"][$produto_id] == 0);
            if ($_POST["quantidade"][$produto_id] == "" || $_POST["quantidade"][$produto_id] == 0) {
                self::setAlert("warning", "Todos os produtos do pedido precisam ter pelo menos 1 unidade");
                header('Location: '. "/pedidos/create");
                die();
            }
            $produtos[] = [
                "id"            => $produto_id,
                "quantidade"    => $_POST["quantidade"][$produto_id]
            ];
        }

        $data = [
            "cliente"   => $_POST["cliente"],
        ];

        $pedido = Pedido::create($data);

        $pedido->addProducts($produtos);

        self::setAlert("success", "Pedido cadastrado com sucesso");

        header('Location: '. "/pedidos");
        die();
    }

    public function delete(int $id)
    {
        $pedido = Pedido::find($id);

        if (is_null($pedido)) {
            self::setAlert("warning", "O id ".$_REQUEST["id"]." não existe no sistema");
            header('Location: '. "/pedidos");
            die();
        }

        $pedido->delete();

        self::setAlert("success", "Pedido deletado com sucesso");

        return;
    }
}

?>