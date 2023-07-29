<?php
namespace Models;

require_once __DIR__."/../database/DAOs/ProdutoDAO.php";

use Database\DAOs\ProdutoDAO;

class Produto
{
    public $id;
    public $descricao;
    public $valorVenda;
    public $estoque;

    //TODO implementar imagens
    //TODO fazer validações (mesmo id)
 
    public static function create(array $attributes)
    {
        $produto = new self;

        $produto->id = $attributes["id"];
        $produto->descricao = $attributes["descricao"];
        $produto->valorVenda = $attributes["valorVenda"];
        $produto->estoque = $attributes["estoque"];

        $produtoDAO = new ProdutoDAO();

        $produtoDAO->create($attributes);

        return $produto;
    }

    public function getAll(): array
    {
        $produtoDAO = new ProdutoDAO();

        $produtos = $produtoDAO->getAll();

        $produtosModel = [];

        foreach ($produtos as $produto)
        {
            $produtoModel = new self;

            $produtoModel->id = $produto["id"];
            $produtoModel->descricao = $produto["descricao"];
            $produtoModel->valorVenda = $produto["valorVenda"];
            $produtoModel->estoque = $produto["estoque"];

            $produtosModel[] = $produtoModel;
        }

        return $produtosModel;
    }

    public static function find($id): self
    {
        $produtoDAO = new ProdutoDAO();

        $produtoData = $produtoDAO->findById($id);

        $produto = new self;

        $produto->id = $produtoData["id"];
        $produto->descricao = $produtoData["descricao"];
        $produto->valorVenda = $produtoData["valorVenda"];
        $produto->estoque = $produtoData["estoque"];

        return $produto;
    }
 
    public function update(array $attributes)
    {
        $this->descricao = $attributes["descricao"] ?? $this->descricao;
        $this->valorVenda = $attributes["valorVenda"] ?? $this->valorVenda;
        $this->estoque = $attributes["estoque"] ?? $this->estoque;

        $produtoDAO = new ProdutoDAO();

        $produtoDAO->update($this->id, $attributes);
    }
    
    public function delete()
    {
        $produtoDAO = new ProdutoDAO();

        $produtoDAO->delete($this->id);
    }
    
    /**
     * ...
     * outros métodos de abstração de banco
     * ...
     *
     */
}

?>