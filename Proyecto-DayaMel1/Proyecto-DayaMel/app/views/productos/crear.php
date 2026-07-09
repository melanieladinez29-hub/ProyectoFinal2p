<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Producto - Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Registrar Cosmético</h1>
    </header>
    <main style="padding: 4rem 0;">
        <?php if(isset($error)): ?> <div class="error"><?php echo $error; ?></div> <?php endif; ?>
        
        <form action="index.php?action=admin-crear" method="POST" class="formulario">
            <legend>Nueva Entrada de Inventario</legend>
            <div class="campo">
                <label>Nombre del Producto:</label>
                <input type="text" name="nombre" class="input-text" placeholder="Ej. Sérum Lavanda Extremo" required>
            </div>
            <div class="campo">
                <label>Precio Unitario ($):</label>
                <input type="number" step="0.01" name="precio" class="input-text" placeholder="0.00" required>
            </div>
            <div class="campo">
                <label>Ruta Relativa de Imagen:</label>
                <input type="text" name="imagen" class="input-text" value="imagenes/crema.jpg" required>
            </div>
            <button type="submit" class="boton" style="width:100%; margin-top:2rem;">Guardar en base de datos</button>
        </form>
    </main>
</body>
</html>