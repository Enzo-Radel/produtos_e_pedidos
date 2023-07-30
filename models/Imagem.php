<?php
namespace Models;

include_once __DIR__."/../env.php";
require_once __DIR__."/../database/DAOs/ImagemDAO.php";

use Database\DAOs\ImagemDAO;

class Imagem
{
    public $id;
    public $nome;
    public $produto_id;

    public function getPath()
    {
        global $env;
        
        $path = $env['BASE_PATH'].
        DIRECTORY_SEPARATOR.
        $this->nome;

        return $path;
    }
 
    // public static function create(array $attributes)
    // {
    //     $produtoDAO = new ProdutoDAO();
    //     $imagemDAO = new ImagemDAO();

    //     $produtoData = $produtoDAO->create($attributes);

    //     $produto = new self;
    //     $produto->id            = $produtoData["id"];
    //     $produto->descricao     = $produtoData["descricao"];
    //     $produto->valorVenda    = $produtoData["valorVenda"];
    //     $produto->estoque       = $produtoData["estoque"];

    //     foreach ($attributes["imagens_nomes"] as $imagemNome) {
    //         $imagemAttributes = [
    //             "nome"          => $imagemNome,
    //             "produto_id"    => $produto->id
    //         ];

    //         $imagemDAO->create($imagemAttributes);
    //     }

    //     return $produto;
    // }

    // public function getAll(): array
    // {
    //     $produtoDAO = new ProdutoDAO();

    //     $produtos = $produtoDAO->getAll();

    //     $produtosModel = [];

    //     foreach ($produtos as $produto)
    //     {
    //         $produtoModel = new self;

    //         $produtoModel->id = $produto["id"];
    //         $produtoModel->descricao = $produto["descricao"];
    //         $produtoModel->valorVenda = $produto["valorVenda"];
    //         $produtoModel->estoque = $produto["estoque"];

    //         $produtosModel[] = $produtoModel;
    //     }

    //     return $produtosModel;
    // }

    // public static function find($id): self
    // {
    //     $produtoDAO = new ProdutoDAO();

    //     $produtoData = $produtoDAO->findById($id);

    //     $produto = new self;

    //     $produto->id = $produtoData["id"];
    //     $produto->descricao = $produtoData["descricao"];
    //     $produto->valorVenda = $produtoData["valorVenda"];
    //     $produto->estoque = $produtoData["estoque"];

    //     return $produto;
    // }
 
    // public function update(array $attributes)
    // {
    //     $this->descricao = $attributes["descricao"] ?? $this->descricao;
    //     $this->valorVenda = $attributes["valorVenda"] ?? $this->valorVenda;
    //     $this->estoque = $attributes["estoque"] ?? $this->estoque;

    //     $produtoDAO = new ProdutoDAO();

    //     $produtoDAO->update($this->id, $attributes);
    // }
    
    // public function delete()
    // {
    //     $produtoDAO = new ProdutoDAO();

    //     $produtoDAO->delete($this->id);
    // }

    // public function getImages()
    // {
    //     $imagemDAO = new ImagemDAO();

    //     return $imagemDAO->getAllByProduct($this->id);
    // }
}

?>