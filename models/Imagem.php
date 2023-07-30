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
 
    public static function create(array $attributes)
    {
        $imagemDAO = new ImagemDAO();

        $imagemData = $imagemDAO->create($attributes);

        $imagem = new self;
        $imagem->id         = $imagemData["id"];
        $imagem->nome       = $imagemData["nome"];
        $imagem->produto_id = $imagemData["produto_id"];

        return $imagem;
    }

    // public static function getAll(): array
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

    public static function find($id): self
    {
        $imagemDAO = new ImagemDAO();

        $imagemData = $imagemDAO->findById($id);

        $imagem = new self;

        $imagem->id = $imagemData["id"];
        $imagem->nome = $imagemData["nome"];
        $imagem->produto_id = $imagemData["produto_id"];

        return $imagem;
    }
 
    // public function update(array $attributes)
    // {
    //     $this->descricao = $attributes["descricao"] ?? $this->descricao;
    //     $this->valorVenda = $attributes["valorVenda"] ?? $this->valorVenda;
    //     $this->estoque = $attributes["estoque"] ?? $this->estoque;

    //     $produtoDAO = new ProdutoDAO();

    //     $produtoDAO->update($this->id, $attributes);
    // }
    
    public function delete()
    {
        $imagemDAO = new ImagemDAO();

        $imagemDAO->delete($this->id);
    }
}

?>