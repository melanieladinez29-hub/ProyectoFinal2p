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
        <div class="nav-bg">
            <nav class="navegacion">
                <a href="index.php?action=admin-productos">← Volver al Panel</a>
            </nav>
        </div>
    </header>
    <main style="padding: 4rem 0;">
        <?php if(isset($error)): ?> 
            <div class="error"><?php echo $error; ?></div> 
        <?php endif; ?>
        
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
                <label>Enlace o Ruta de la Imagen:</label>
                <input type="text" name="imagen" class="input-text" placeholder="Ej. https://imagenes.com/serum.jpg o imagenes/crema.jpg" required>
            </div>

            <div class="campo">
                <label>Existencias Iniciales (Stock):</label>
                <input type="number" name="stock" class="input-text" value="100" min="0" required>
            </div>
           <div class="campo">
    <label>Categoría:</label>

    <select name="id_categoria" class="input-text" required>

        <option value="">Seleccione una categoría</option>

        <?php foreach($categorias as $categoria): ?>

            <option value="<?php echo $categoria['id']; ?>">
                <?php echo $categoria['nombre']; ?>
            </option>

        <?php endforeach; ?>

    </select>

<div class="campo">

<label>Proveedor:</label>

<select name="id_proveedor" class="input-text" required>

<option value="">Seleccione proveedor</option>

<?php foreach($proveedores as $pr): ?>

<option value="<?= $pr['id']; ?>">
<?= htmlspecialchars($pr['empresa']); ?>
</option>

<?php endforeach; ?>

</select>

</div>

</div>
            <button type="submit" class="boton" style="width:100%; margin-top:2rem;">Guardar en base de datos</button>
        </form>
    </main>
</body>
</html>