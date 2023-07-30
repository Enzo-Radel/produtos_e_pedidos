<?php
namespace Database\DAOs;

require_once __DIR__."/../DbConnection.php";

class ProdutoDAO
{

    private string $queryCreate = "INSERT INTO produtos (id, descricao, valor_venda, estoque) VALUES (?, ?, ?, ?)";
    private string $queryGetAll = "SELECT * FROM produtos";
    private string $queryGetById = "SELECT * FROM produtos WHERE id=?;";
    private string $queryUpdate = 'UPDATE produtos SET descricao=?, valor_venda=?, estoque=? WHERE id=?;';
    private string $queryDelete = 'DELETE FROM produtos WHERE id=?;';
    private string $queryGetByPedidoId = "SELECT p.id FROM pedidos_produtos as pp, produtos as p WHERE p.id = pp.produto_id AND pedido_id = ?;";

    public function create(array $attributes)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryCreate);

        $id = $attributes["id"];
        $descricao = $conn->real_escape_string($attributes["descricao"]);
        $valorVenda = $attributes["valorVenda"];
        $estoque = $attributes["estoque"];

        $stmt->bind_param(
            "isdi",
            $id,
            $descricao,
            $valorVenda,
            $estoque
        );

        if (!$stmt->execute()) die("Error: " . $this->queryCreate . "<br>" . mysqli_error($conn));
        $stmt->close();

        $produto = [
            "id"            => $id,
            "descricao"     => $descricao,
            "valorVenda"    => $valorVenda,
            "estoque"       => $estoque,
        ];

        return $produto;
    }

    public function getAll(): array
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetAll);

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
            die("Error: " . $this->queryGetAll . "<br>" . mysqli_error($conn));
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

            if (is_null($registro)) {
                return null;
            }

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

    public function update(int $id, array $attributes)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryUpdate);

        $descricao = $conn->real_escape_string($attributes['descricao']);
        $valorVenda = $attributes['valorVenda'];
        $estoque = $attributes['estoque'];

        $stmt->bind_param(
            "sdii",
            $descricao,
            $valorVenda,
            $estoque,
            $id
        );

        if (!$stmt->execute()) die("Error: " . $this->queryUpdate . "<br>" . mysqli_error($conn));

        $stmt->close();
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

    public function getByPedidoId(int $id)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryGetByPedidoId);
        $stmt->bind_param(
            "i",
            $id
        );

        $produtos = [];

        if ($stmt->execute())
        {
            $resultado = $stmt->get_result();

            while($registro = $resultado->fetch_assoc())
            {
                $produto = [
                    "id" => $registro["id"],
                ];

                $produtos[] = $produto;
            }
        }
        else
        {
            die("Error: " . $this->queryGetByPedidoId . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
        

        return $produtos;
    }
}

?>