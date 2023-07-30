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
            <th>Ações</th>
        </tr>
        <?php foreach ($pedidos as $pedido): ?>
            <tr>
                <td><?php echo $pedido->id; ?></td>
                <td><?php echo $pedido->cliente; ?></td>
                <td><?php echo $pedido->data; ?></td>
                <td class="d-flex">
                    <form action="/pedidos/delete/<?php echo $pedido->id ?>" method="post" class="form-delete" id="form-delete-<?php echo $pedido->id ?>" onsubmit="return confirm('Quer mesmo deleter esse pedido?');">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
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