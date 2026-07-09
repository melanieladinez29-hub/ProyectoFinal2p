<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar compra</title>
</head>
<body>

<h2>Datos del cliente</h2>

<form action="index.php?action=procesar-compra" method="POST">

    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Apellido</label><br>
    <input type="text" name="apellido" required><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" required><br><br>

    <label>Teléfono</label><br>
    <input type="text" name="telefono" required><br><br>

    <label>Dirección</label><br>
    <textarea name="direccion" required></textarea><br><br>

    <button type="submit">
        Confirmar compra
    </button>

</form>

</body>
</html>