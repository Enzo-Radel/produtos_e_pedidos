<?php
namespace Models;

require_once __DIR__."/../database/DAOs/PedidoDAO.php";
require_once __DIR__."/../database/DAOs/ProdutoDAO.php";
require_once __DIR__."/Produto.php";

use Database\DAOs\PedidoDAO;
use Database\DAOs\ProdutoDAO;

class Pedido
{
    public $id;
    public $cliente;
    public $data;
 
    public static function create(array $attributes)
    {
        $pedidoDAO = new PedidoDAO();

        $pedidoData = $pedidoDAO->create($attributes);

        $pedido = new self;
        $pedido->id         = $pedidoData["id"];
        $pedido->cliente    = $pedidoData["cliente"];
        $pedido->data       = $pedidoData["data"];

        return $pedido;
    }

    public static function getAll()
    {
        $pedidoDAO = new PedidoDAO();

        $pedidos = $pedidoDAO->getAll();

        $pedidosModel = [];

        foreach ($pedidos as $pedido)
        {
            $pedidoModel = new self;

            $pedidoModel->id        = $pedido["id"];
            $pedidoModel->cliente   = $pedido["cliente"];
            $pedidoModel->data      = $pedido["data"];

            $pedidosModel[] = $pedidoModel;
        }

        return $pedidosModel;
    }

    public static function find($id)
    {
        $pedidoDAO = new PedidoDAO();

        $pedidoData = $pedidoDAO->findById($id);

        $pedido = new self;

        $pedido->id = $pedidoData["id"];
        $pedido->cliente = $pedidoData["cliente"];
        $pedido->data = $pedidoData["data"];

        return $pedido;
    }
    
    public function delete()
    {
        $pedidoDAO = new PedidoDAO();

        $pedidoDAO->detachProducts($this->id);

        $pedidoDAO->delete($this->id);
    }

    public function addProducts(array $produtos)
    {
        $pedidoDAO = new PedidoDAO();

        $pedidoData = $pedidoDAO->addProducts($this->id, $produtos);
    }

    public function countProducts()
    {
        $produtoDAO = new ProdutoDAO();

        $produtos = $produtoDAO->getByPedidoId($this->id);

        return count($produtos);
    }
}

?>