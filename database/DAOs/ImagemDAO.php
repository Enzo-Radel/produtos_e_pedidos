<?php
namespace Database\DAOs;

require_once __DIR__."/../DbConnection.php";

class ImagemDAO
{

    private string $queryCreate = "INSERT INTO imagens_de_produtos (nome, produto_id) VALUES (?, ?)";
    private string $queryGetAllByProduct = "SELECT * FROM imagens_de_produtos WHERE produto_id=?";
    private string $queryGetById = "SELECT * FROM imagens_de_produtos WHERE id=?;";
    private string $queryDelete = 'DELETE FROM imagens_de_produtos WHERE id=?;';

    public function create(array $attributes)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryCreate);

        $nome = $conn->real_escape_string($attributes["nome"]);
        $produto_id = $attributes["produto_id"];

        $stmt->bind_param(
            "si",
            $nome,
            $produto_id
        );

        if (!$stmt->execute()) die("Error: " . $this->queryCreate . "<br>" . mysqli_error($conn));
        $stmt->close();

        $imagem = [
            "nome"          => $nome,
            "produto_id"    => $produto_id,
        ];

        return $imagem;
    }

    public function getAllByProduct(): array
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetAllByProduct);

        $produtos = [];

        if ($stmt->execute())
        {
            $resultado = $stmt->get_result();

            while($registro = $resultado->fetch_assoc())
            {
                $produto = [
                    "id" => $registro["id"],
                    "descricao" => $registro["descricao"],
                    "valorVenda" => $registro["valor_venda"],
                    "estoque" => $registro["estoque"],
                ];

                $produtos[] = $produto;
            }
        }
        else
        {
            die("Error: " . $this->queryGetAllByProduct . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        

        return $produtos;
    }

    public function findById(int $id)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetById);
        $stmt->bind_param(
            "i",
            $id
        );

        $produto = null;

        if ($stmt->execute())
        {
            $resultado = $stmt->get_result();

            $registro = $resultado->fetch_assoc();
            $produto = [
                "id" => $registro["id"],
                "descricao" => $registro["descricao"],
                "valorVenda" => $registro["valor_venda"],
                "estoque" => $registro["estoque"],
            ];
        }
        else
        {
            die("Error: " . $this->queryGetById . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        
        return $produto;
    }

    public function delete(int $id)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryDelete);
        $stmt->bind_param(
            "i",
            $id
        );

        if (!$stmt->execute())
        {
            die("Error: " . $this->queryDelete . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        
    }
}

?>