<?php
$produtos = $_REQUEST['produtos'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>Implementando MVC</title>
 </head>
 <body>
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
 </body>
</html>