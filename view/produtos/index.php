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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir esse produto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="/produtos/delete/<?php echo $produto->id ?>" method="post" class="form-delete" id="form-delete-<?php echo $produto->id ?>">
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