<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Cliente</title>
<link rel="stylesheet" href="css/styles.css">
</head>

<body>

<div class="formulario">

<h2>Editar Cliente</h2>

<form method="POST">

<input
type="text"
name="nombre"
value="<?= htmlspecialchars($cliente['nombre']) ?>"
required>

<input
type="text"
name="apellido"
value="<?= htmlspecialchars($cliente['apellido']) ?>"
required>

<input
type="email"
name="correo"
value="<?= htmlspecialchars($cliente['correo']) ?>"
required>

<input
type="text"
name="telefono"
value="<?= htmlspecialchars($cliente['telefono']) ?>">

<input
type="text"
name="direccion"
value="<?= htmlspecialchars($cliente['direccion']) ?>">

<button>
Actualizar Cliente
</button>

</form>

</div>

</body>
</html>