<?php
    $produtos = $_REQUEST['produtos'];
?>
<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1 class="h2"><?php echo $layout["title"] ?></h1>
        <a href="/produtos/create" class="btn btn-success">Cadastrar Produto</a>
    </div>
    <div class="card-body">
    <table class="table m-0 border">
        <tr class="table-secondary">
            <th>ID</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Estoque</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto->id; ?></td>
                <td><?php echo $produto->descricao; ?></td>
                <td><?php echo $produto->valorVenda; ?></td>
                <td><?php echo $produto->estoque; ?></td>
                <td class="d-flex">
                    <a href="/produtos/edit/<?php echo $produto->id ?>" class="btn btn-sm btn-primary me-2">Editar</a>
                    <form action="/produtos/delete/<?php echo $produto->id ?>" method="post" class="form-delete" id="form-delete-<?php echo $produto->id ?>" onsubmit="return confirm('Quer mesmo deleter esse produto?');">
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
            formData = new FormData(form);
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