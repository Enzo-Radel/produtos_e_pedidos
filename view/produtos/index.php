<?php
    $produtos = $_REQUEST['produtos'];
?>
<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header">
        <h1><?php echo $layout["title"] ?></h1>
        <a href="/produtos/create" class="btn btn-success">Cadastrar Produto</a>
    </div>
    <div class="card-body">
    <table class="table m-0">
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
                    <a href="#" class="btn btn-sm btn-info me-2">Editar</a>
                    <a href="#" class="btn btn-sm btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    </div>
</div>