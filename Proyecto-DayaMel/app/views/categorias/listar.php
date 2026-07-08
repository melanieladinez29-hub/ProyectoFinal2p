<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración - Categorías</title>
    <link rel="stylesheet" href="css/styles.css">

    <style>
        .tabla-admin{
            width:85%;
            margin:3rem auto;
            border-collapse:collapse;
            background:#fff;
            box-shadow:0 4px 10px rgba(0,0,0,.1);
            border-radius:1rem;
            overflow:hidden;
        }

        .tabla-admin th,
        .tabla-admin td{
            padding:1.5rem;
            text-align:center;
            border-bottom:1px solid #eee;
            font-size:1.6rem;
        }

        .tabla-admin th{
            background:#6a4c93;
            color:white;
        }

        .btn-crear{
            display:inline-block;
            background:#28a745;
            color:white;
            padding:1rem 2rem;
            border-radius:.5rem;
            text-decoration:none;
            font-weight:bold;
            margin:2rem;
        }

        .btn-editar{
            background:#4a90e2;
            color:white;
            padding:.5rem 1rem;
            border-radius:.5rem;
            text-decoration:none;
        }

        .btn-eliminar{
            background:#d0021b;
            color:white;
            padding:.5rem 1rem;
            border-radius:.5rem;
            text-decoration:none;
        }

    </style>

</head>

<body>

<header>

<h1>Panel de Gestión CRUD</h1>

<p class="subtitulo">
Mantenimiento de Categorías
</p>

<div class="nav-bg">
<nav class="navegacion">

<a href="index.php?action=inicio">Inicio</a>

<a href="index.php?action=admin-productos">Productos</a>

<a href="index.php?action=logout">Cerrar sesión</a>

</nav>
</div>

</header>

<main style="text-align:center;">

<a href="index.php?action=categoria-crear" class="btn-crear">
+ Nueva Categoría
</a>

<table class="tabla-admin">

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

<?php if(!empty($categorias)): ?>

<?php foreach($categorias as $c): ?>

<tr>

<td><?= $c['id']; ?></td>

<td><?= htmlspecialchars($c['nombre']); ?></td>

<td>

<a class="btn-editar"
href="index.php?action=categoria-editar&id=<?= $c['id']; ?>">
Editar
</a>

<a class="btn-eliminar"
onclick="return confirm('¿Eliminar categoría?')"
href="index.php?action=categoria-eliminar&id=<?= $c['id']; ?>">
Eliminar
</a>

</td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

<td colspan="3">

No existen categorías registradas.

</td>

</tr>

<?php endif; ?>

</tbody>

</table>

</main>

</body>
</html>