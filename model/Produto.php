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
 
    public function create() {
    // logica para salvar cliente no banco
    }
 
    public function update() {
    // logica para atualizar cliente no banco
    }
    
    public function remove() {
    // logica para remover cliente do banco
    }
    
    public function listAll() {
        $produtos = [];
        // for ($i=0; $i < 5; $i++) { 
        //     $client = new self();
        //     $client->id = $i;
        //     $client->nome = "produto $i";
        //     array_push($clients, $client);
        // }

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