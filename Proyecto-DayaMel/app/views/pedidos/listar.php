<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<title>Pedidos</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<h1 style="text-align:center;">
Lista de Pedidos
</h1>


<div style="width:800px;margin:auto;">

<a href="index.php?action=crear-pedido">
Nuevo Pedido
</a>


<br><br>


<table border="1" width="100%">

<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Total</th>
    <th>Estado</th>
    <th>Acciones</th>
</tr>


<?php foreach($pedidos as $pedido): ?>

<tr>

<td>
<?= $pedido['id'] ?>
</td>


<td>
<?= htmlspecialchars($pedido['cliente']) ?>
</td>


<td>
$<?= $pedido['total'] ?>
</td>


<td>
<?= $pedido['estado'] ?>
</td>


<td>

<a href="index.php?action=editar-pedido&id=<?= $pedido['id'] ?>">
Editar
</a>


<a href="index.php?action=eliminar-pedido&id=<?= $pedido['id'] ?>"
onclick="return confirm('¿Eliminar pedido?')">
Eliminar
</a>

</td>

</tr>


<?php endforeach; ?>


</table>


</div>

</body>
</html>