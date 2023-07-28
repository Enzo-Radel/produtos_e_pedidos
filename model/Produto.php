<?php
namespace Model;

class Produto {
    public $id;
    public $descricao;
    public $valorVenda;
    public $estoque;

    private function save() {
    // logica para salvar cliente no banco
    }
 
    public static function create(array $atributes) {
        $produto = new self;

        $produto->id = $atributes["id"];
        $produto->descricao = $atributes["descricao"];
        $produto->valorVenda = $atributes["valorVenda"];
        $produto->estoque = $atributes["estoque"];

        //Adicionar no bando de dados e salvar imagens

        return $produto;
    }
 
    public function update() {
    // logica para atualizar cliente no banco
    }
    
    public function remove() {
    // logica para remover cliente do banco
    }
    
    public function listAll() {
        $produtos = [];
        for ($i=1; $i <= 5; $i++) { 
            $produto = new self();
            $produto->id = $i;
            $produto->descricao = "produto $i";
            $produto->valorVenda = $i * 10;
            $produto->estoque = $i ** 2;
            array_push($produtos, $produto);
        }

        return $produtos;
    }
    
    /**
     * ...
     * outros métodos de abstração de banco
     * ...
     *
     */
}

?>