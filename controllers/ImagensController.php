<?php
namespace Controllers;

require_once "controllers/Controller.php";
require_once 'models/Imagem.php';

require_once __DIR__."/../utils/ManageImagesHelper.php";

use Models\Imagem;
use Utils\ManageImagesHelper;

class ImagensController extends Controller
{
    public function store(int $produto_id)
    {
        $imagens = ManageImagesHelper::Upload($_FILES['imagens']);

        foreach ($imagens as $imagem) {
            if ($imagem == null) die("ouve um erro ao fazer upload de uma imagem, verifique se está usando um desses formatos (.jpeg, .jpg, .png)");
            $data = [
                "nome"          => $imagem,
                "produto_id"    => $produto_id,
            ];

            Imagem::create($data);
        }

        header('Location: '. "/produtos/images/".$produto_id);
    }

    public function delete(int $id)
    {
        $imagem = Imagem::find($id);

        $imagem->delete();

        ManageImagesHelper::Delete($imagem->nome);

        return;
    }
}

?>