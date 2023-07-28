<?php
    $produtos = $_REQUEST['produtos'];
?>
<h1>teste</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Produto</th>
    </tr>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?php echo $produto->id; ?></td>
            <td><?php echo $produto->nome; ?></td>
        </tr>
    <?php endforeach; ?>
</table>