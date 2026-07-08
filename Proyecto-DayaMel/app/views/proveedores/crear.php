<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nuevo Proveedor</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<div class="formulario">

<h2>Registrar Proveedor</h2>

<?php if(isset($error)): ?>
<p class="error"><?= $error ?></p>
<?php endif; ?>


<form method="POST">

<input type="text" name="nombre" placeholder="Nombre del contacto" required>

<input type="text" name="empresa" placeholder="Empresa" required>

<input type="email" name="correo" placeholder="Correo" required>

<input type="text" name="telefono" placeholder="Teléfono">

<input type="text" name="direccion" placeholder="Dirección">


<button type="submit">
Guardar Proveedor
</button>


</form>


<a href="index.php?action=admin-proveedores">
⬅ Volver
</a>


</div>

</body>
</html>