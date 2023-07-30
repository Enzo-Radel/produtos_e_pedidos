<?php
namespace Models;

require_once __DIR__."/../database/DAOs/ProdutoDAO.php";
require_once __DIR__."/../database/DAOs/ImagemDAO.php";
require_once __DIR__."/Imagem.php";

use Database\DAOs\ProdutoDAO;
use Database\DAOs\ImagemDAO;

class Produto
{
    public $id;
    public $descricao;
    public $valorVenda;
    public $estoque;

    //TODO fazer validações (mesmo id)
 
    public static function create(array $attributes)
    {
        $produtoDAO = new ProdutoDAO();
        $imagemDAO = new ImagemDAO();

        $produtoData = $produtoDAO->create($attributes);

        $produto = new self;
        $produto->id            = $produtoData["id"];
        $produto->descricao     = $produtoData["descricao"];
        $produto->valorVenda    = $produtoData["valorVenda"];
        $produto->estoque       = $produtoData["estoque"];

        foreach ($attributes["imagens_nomes"] as $imagemNome) {
            $imagemAttributes = [
                "nome"          => $imagemNome,
                "produto_id"    => $produto->id
            ];

            $imagemDAO->create($imagemAttributes);
        }

        return $produto;
    }

    public static function getAll(): array
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

    public function getImages()
    {
        $imagemDAO = new ImagemDAO();

        $imagensData = $imagemDAO->getAllByProduct($this->id);

        $imagens = [];

        foreach ($imagensData as $imagemData) {
            $imagem = new Imagem();

            $imagem->id         = $imagemData["id"];
            $imagem->nome       = $imagemData["nome"];
            $imagem->produto_id = $imagemData["produto_id"];

            $imagens[] = $imagem;
        }

        return $imagens;
    }
}

?>