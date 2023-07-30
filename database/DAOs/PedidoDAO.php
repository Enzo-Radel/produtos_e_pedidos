<?php
namespace Database\DAOs;

require_once __DIR__."/../DbConnection.php";

class PedidoDAO
{
    private string $createRelationPedidoProdutoStmt = "(?, ?, ?)";
    private string $queryCreate = "INSERT INTO pedidos (cliente) VALUES (?, ?)";
    private string $queryGetAll = "SELECT * FROM pedidos";
    private string $queryGetById = "SELECT * FROM pedidos WHERE id=?;";
    private string $queryDelete = 'DELETE FROM pedidos WHERE id=?;';
    private string $queryAddProducts = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade) VALUES";
    private string $queryDetachProducts = "DELETE FROM pedidos_produtos WHERE pedido_id = ?;";

    public function create(array $attributes)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryCreate);

        $cliente = $conn->real_escape_string($attributes["cliente"]);

        $stmt->bind_param(
            "s",
            $cliente,
        );

        if (!$stmt->execute()) die("Error: " . $this->queryCreate . "<br>" . mysqli_error($conn));
        $stmt->close();

        $pedido = [
            "id"        => $conn->insert_id,
            "cliente"   => $cliente,
        ];

        return $pedido;
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

            if (is_null($registro)) {
                return null;
            }
            
            $pedido = [
                "id"        => $registro["id"],
                "cliente"   => $registro["cliente"],
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

    public function addProducts(int $id, array $products)
    {
        global $conn;

        $query = $this->queryAddProducts;

        foreach ($products as $product) {
            $query .= " " . $this->createRelationPedidoProdutoStmt;
            $query .= ",";
        }

        $query = substr($query, 0, -1);
        $query .= ";";

        $stmt = $conn->prepare($query);

        $param_types = "";
        $vars = [];

        foreach ($products as $product) {
            $vars[] = $id;
            $vars[] = $product["id"];
            $vars[] = $product["quantidade"];

            $param_types .= "iii";
        }

        $stmt->bind_param(
            $param_types,
            ...$vars
        );

        if (!$stmt->execute()) die("Error: " . $this->queryCreate . "<br>" . mysqli_error($conn));
        $stmt->close();
    }

    public function detachProducts(int $pedido_id)
    {
        global $conn;

        $stmt = $conn->prepare($this->queryDetachProducts);
        $stmt->bind_param(
            "i",
            $pedido_id
        );

        if (!$stmt->execute())
        {
            die("Error: " . $this->queryDetachProducts . "<br>" . mysqli_error($conn));
        }

        $stmt->close();
    }
}

?>