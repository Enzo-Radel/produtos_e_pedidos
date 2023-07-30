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

    public static function find($id): self|null
    {
        $imagemDAO = new ImagemDAO();

        $imagemData = $imagemDAO->findById($id);

        if (is_null($imagemData)) {
            return null;
        }

        $imagem = new self;

        $imagem->id = $imagemData["id"];
        $imagem->nome = $imagemData["nome"];
        $imagem->produto_id = $imagemData["produto_id"];

        return $imagem;
    }
    
    public function delete()
    {
        $imagemDAO = new ImagemDAO();

        $imagemDAO->delete($this->id);
    }
}

?>