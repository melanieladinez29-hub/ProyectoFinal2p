<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Proveedores</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<h1 style="text-align:center;">
Lista de Proveedores
</h1>


<div style="text-align:center;margin:20px;">

<a href="index.php?action=proveedor-crear">
+ Nuevo Proveedor
</a>

</div>


<table border="1" width="90%" align="center">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Empresa</th>
<th>Correo</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Acciones</th>
</tr>


<?php foreach($proveedores as $p): ?>

<tr>

<td><?= $p['id']; ?></td>

<td><?= htmlspecialchars($p['nombre']); ?></td>

<td><?= htmlspecialchars($p['empresa']); ?></td>

<td><?= htmlspecialchars($p['correo']); ?></td>

<td><?= htmlspecialchars($p['telefono']); ?></td>

<td><?= htmlspecialchars($p['direccion']); ?></td>


<td>

<a href="index.php?action=proveedor-editar&id=<?= $p['id']; ?>">
Editar
</a>


<a href="index.php?action=proveedor-eliminar&id=<?= $p['id']; ?>"
onclick="return confirm('¿Eliminar proveedor?')">
Eliminar
</a>

</td>

</tr>


<?php endforeach; ?>


</table>


</body>
</html>