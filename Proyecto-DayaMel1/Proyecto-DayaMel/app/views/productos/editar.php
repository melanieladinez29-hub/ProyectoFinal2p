<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Producto - Admin</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Actualizar Datos de Producto</h1>
    </header>
    <main style="padding: 4rem 0;">
        <?php if(isset($error)): ?> 
            <div class="error"><?php echo $error; ?></div> 
        <?php endif; ?>
        
        <?php 
        // Validación de respaldo por si el objeto $producto no llegó bien desde el controlador
        $id_prod = isset($producto['id']) ? $producto['id'] : 0;
        $nombre_prod = isset($producto['nombre']) ? htmlspecialchars($producto['nombre']) : '';
        $precio_prod = isset($producto['precio']) ? htmlspecialchars($producto['precio']) : '0.00';
        $imagen_prod = isset($producto['imagen']) ? htmlspecialchars($producto['imagen']) : '';
        ?>

        <form action="index.php?action=admin-editar&id=<?php echo $id_prod; ?>" method="POST" class="formulario">
            <legend>Editar Registro #<?php echo $id_prod; ?></legend>
            <div class="campo">
                <label>Nombre Comercial:</label>
                <input type="text" name="nombre" class="input-text" value="<?php echo $nombre_prod; ?>" required>
            </div>
            <div class="campo">
                <label>Precio Actualizado ($):</label>
                <input type="number" step="0.01" name="precio" class="input-text" value="<?php echo $precio_prod; ?>" required>
            </div>
            <div class="campo">
                <label>Ruta de la Imagen:</label>
                <input type="text" name="imagen" class="input-text" value="<?php echo $imagen_prod; ?>" required>
            </div>
            <button type="submit" class="boton" style="width:100%; margin-top:2rem;">Confirmar Cambios</button>
        </form>
    </main>
</body>
</html>