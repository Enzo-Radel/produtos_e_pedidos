<?php
    $pedidos = $_REQUEST['pedidos'];
?>
<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1 class="h2"><?php echo $layout["title"] ?></h1>
        <a href="/pedidos/create" class="btn btn-success">Cadastrar Pedido</a>
    </div>
    <div class="card-body">
    <table class="table m-0 border">
        <tr class="table-secondary">
            <th>ID</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Produtos</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido->id; ?></td>
                <td><?php echo $pedido->cliente; ?></td>
                <td><?php echo $pedido->data; ?></td>
                <td><?php echo $pedido->countProducts(); ?></td>
                <td class="d-flex">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Excluir
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Pedido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esse pedido?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/pedidos/delete/<?php echo $pedido->id ?>" method="post" class="form-delete" id="form-delete-<?php echo $pedido->id ?>">
                    <button type="submit" class="btn btn-primary">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    formsDelete = document.querySelectorAll(".form-delete");

    formsDelete.forEach(form => {
        form.addEventListener("submit", (event) => {
            event.preventDefault();
            fetch(form.getAttribute("action"), {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                method: "delete",
            }).then(() => {
                window.location.reload();
            });
        });
    });
</script>