<?php
namespace Models;

require_once __DIR__."/../database/DAOs/PedidoDAO.php";

use Database\DAOs\PedidoDAO;

class Pedido
{
    public $id;
    public $cliente;
    public $data;
 
    public static function create(array $attributes)
    {
        // $produtoDAO = new ProdutoDAO();
        // $imagemDAO = new ImagemDAO();

        // $produtoData = $produtoDAO->create($attributes);

        // $produto = new self;
        // $produto->id            = $produtoData["id"];
        // $produto->descricao     = $produtoData["descricao"];
        // $produto->valorVenda    = $produtoData["valorVenda"];
        // $produto->estoque       = $produtoData["estoque"];

        // foreach ($attributes["imagens_nomes"] as $imagemNome) {
        //     $imagemAttributes = [
        //         "nome"          => $imagemNome,
        //         "produto_id"    => $produto->id
        //     ];

        //     $imagemDAO->create($imagemAttributes);
        // }

        // return $produto;
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

        $pedidoDAO->delete($this->id);
    }

    public function getProducts()
    {
    }
}

?>