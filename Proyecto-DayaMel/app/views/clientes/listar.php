<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Clientes</title>
<link rel="stylesheet" href="css/styles.css">

<style>
.tabla-admin{
width:90%;
margin:30px auto;
border-collapse:collapse;
background:white;
}

.tabla-admin th,
.tabla-admin td{
padding:12px;
border:1px solid #ddd;
text-align:center;
}

.tabla-admin th{
background:#6a4c93;
color:white;
}

.btn{
padding:8px 12px;
border-radius:5px;
text-decoration:none;
color:white;
}

.crear{background:#28a745;}
.editar{background:#4a90e2;}
.eliminar{background:#d0021b;}
</style>

</head>

<body>

<h1 style="text-align:center;">Clientes</h1>

<div style="text-align:center;margin:20px;">
<a class="btn crear" href="index.php?action=cliente-crear">
Nuevo Cliente
</a>
</div>


<table class="tabla-admin">

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Correo</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Acciones</th>
</tr>


<?php if(!empty($clientes)): ?>

<?php foreach($clientes as $c): ?>

<tr>

<td><?= $c['id']; ?></td>

<td><?= htmlspecialchars($c['nombre']); ?></td>

<td><?= htmlspecialchars($c['apellido']); ?></td>

<td><?= htmlspecialchars($c['correo']); ?></td>

<td><?= htmlspecialchars($c['telefono']); ?></td>

<td><?= htmlspecialchars($c['direccion']); ?></td>


<td>

<a class="btn editar"
href="index.php?action=cliente-editar&id=<?= $c['id']; ?>">
Editar
</a>


<a class="btn eliminar"
onclick="return confirm('¿Eliminar?')"
href="index.php?action=cliente-eliminar&id=<?= $c['id']; ?>">
Eliminar
</a>


</td>

</tr>


<?php endforeach; ?>


<?php else: ?>

<tr>
<td colspan="7">
No existen clientes registrados.
</td>
</tr>


<?php endif; ?>


</table>


</body>
</html>