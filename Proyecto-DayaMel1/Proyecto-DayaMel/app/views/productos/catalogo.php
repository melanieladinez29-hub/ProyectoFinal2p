<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - DayaMel-SkinCare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>DayaMel-Skincare</h1>
        <p class="subtitulo">Nuestra Tienda Online Dinámica</p>
        <div class="nav-bg">
            <nav class="navegacion">
                <a href="index.php?action=inicio">Inicio</a>
                <a href="index.php?action=productos">Productos</a>
                <a href="index.php?action=nosotros">Nosotros</a>
                <a href="index.php?action=admin-productos" style="color: #b39cd0;">Panel Admin</a>
            </nav>
        </div>
    </header>

    <main class="hero">
        <h2>Productos en Stock</h2>
        <div class="contenedor-productos">
            <?php if (isset($productos) && is_array($productos) && count($productos) > 0): ?>
                <?php foreach ($productos as $prod): ?>
                    <div class="tarjeta-producto" data-id="<?php echo $prod['id']; ?>" data-nombre="<?php echo htmlspecialchars($prod['nombre']); ?>" data-precio="<?php echo $prod['precio']; ?>">
                        <img src="<?php echo htmlspecialchars($prod['imagen']); ?>" alt="Producto" class="img-producto">
                        <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                        <p class="precio">$<?php echo htmlspecialchars($prod['precio']); ?></p>
                        <button class="boton-agregar">Agregar al Carrito</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-size: 1.8rem; text-align: center; width: 100%;">No hay productos disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <p>© 2026 DayaMel Skincare</p>
    </footer>
    <script src="js/app.js"></script>
</body>
</html>