<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Proveedor</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>


<div class="formulario">


<h2>Editar Proveedor</h2>


<form method="POST">


<input 
type="text"
name="nombre"
value="<?= htmlspecialchars($proveedor['nombre']); ?>"
required>


<input 
type="text"
name="empresa"
value="<?= htmlspecialchars($proveedor['empresa']); ?>"
required>


<input 
type="email"
name="correo"
value="<?= htmlspecialchars($proveedor['correo']); ?>"
required>


<input 
type="text"
name="telefono"
value="<?= htmlspecialchars($proveedor['telefono']); ?>">


<input 
type="text"
name="direccion"
value="<?= htmlspecialchars($proveedor['direccion']); ?>">


<button type="submit">
Actualizar Proveedor
</button>


</form>


<a href="index.php?action=admin-proveedores">
⬅ Volver
</a>


</div>


</body>
</html>