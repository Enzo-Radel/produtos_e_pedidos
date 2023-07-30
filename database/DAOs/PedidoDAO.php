<?php
namespace Database\DAOs;

require_once __DIR__."/../DbConnection.php";

class PedidoDAO
{

    private string $queryCreate = "INSERT INTO pedidos (id, cliente, data) VALUES (?, ?, ?)";
    private string $queryGetAll = "SELECT * FROM pedidos";
    private string $queryGetById = "SELECT * FROM pedidos WHERE id=?;";
    private string $queryDelete = 'DELETE FROM pedidos WHERE id=?;';

    public function create(array $attributes)
    {
        // global $conn;

        // $stmt = $conn->prepare($this->queryCreate);

        // $id = $attributes["id"];
        // $descricao = $conn->real_escape_string($attributes["descricao"]);
        // $valorVenda = $attributes["valorVenda"];
        // $estoque = $attributes["estoque"];

        // $stmt->bind_param(
        //     "isdi",
        //     $id,
        //     $descricao,
        //     $valorVenda,
        //     $estoque
        // );

        // if (!$stmt->execute()) die("Error: " . $this->queryCreate . "<br>" . mysqli_error($conn));
        // $stmt->close();

        // $produto = [
        //     "id"            => $id,
        //     "descricao"     => $descricao,
        //     "valorVenda"    => $valorVenda,
        //     "estoque"       => $estoque,
        // ];

        // return $produto;
    }

    public function getAll(): array
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetAll);

        $pedidos = [];

        if ($stmt->execute())
        {
            $resultado = $stmt->get_result();

            while($registro = $resultado->fetch_assoc())
            {
                $pedido = [
                    "id"        => $registro["id"],
                    "cliente"   => $registro["cliente"],
                    "data"      => $registro["data"],
                ];

                $pedidos[] = $pedido;
            }
        }
        else
        {
            die("Error: " . $this->queryGetAll . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        

        return $pedidos;
    }

    public function findById(int $id)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetById);
        $stmt->bind_param(
            "i",
            $id
        );

        $pedido = null;

        if ($stmt->execute())
        {
            $resultado = $stmt->get_result();

            $registro = $resultado->fetch_assoc();
            $pedido = [
                "id"        => $registro["id"],
                "cliente"   => $registro["cliente"],
                "data"      => $registro["data"],
            ];
        }
        else
        {
            die("Error: " . $this->queryGetById . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        
        return $pedido;
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