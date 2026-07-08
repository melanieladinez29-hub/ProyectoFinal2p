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
                <a href="index.php?action=carrito-ver" style="color: #ffb7b2; font-weight: bold;">
                    🛒 Ver Carrito 
                    (<?php echo isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0; ?>)
                </a>
                <a href="index.php?action=admin-productos" style="color: #b39cd0;">Panel Admin</a>
            </nav>
        </div>
    </header>

    <main class="hero">
        <h2>Productos en Stock</h2>

        <?php if(isset($_GET['status']) && $_GET['status'] === 'sin_stock'): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 1.2rem; text-align: center; border-radius: .5rem; margin: 1rem auto; width: 85%; font-size: 1.6rem; font-weight: bold;">
                ❌ ¡Anuncio!: No hay existencias de este producto en este momento.
            </div>
        <?php endif; ?>
        <?php if(isset($_GET['status']) && $_GET['status'] === 'limite_stock'): ?>
            <div style="background: #fff3cd; color: #856404; padding: 1.2rem; text-align: center; border-radius: .5rem; margin: 1rem auto; width: 85%; font-size: 1.6rem; font-weight: bold;">
                ⚠️ ¡Aviso!: No puedes añadir más unidades de las disponibles en inventario.
            </div>
        <?php endif; ?>

        <div class="contenedor-productos">
            <?php if (isset($productos) && is_array($productos) && count($productos) > 0): ?>
                <?php foreach ($productos as $prod): ?>
                    <?php $src_imagen = htmlspecialchars($prod['imagen']); ?>
                    <div class="tarjeta-producto" style="<?php echo ($prod['stock'] <= 0) ? 'opacity: 0.7;' : ''; ?>">
                        <img src="<?php echo $src_imagen; ?>" alt="Producto" class="img-producto" style="object-fit: contain; max-height: 200px;">
                        <h3><?php echo htmlspecialchars($prod['nombre']); ?></h3>
                        <p class="precio">$<?php echo htmlspecialchars($prod['precio']); ?></p>
                        
                        <?php if($prod['stock'] > 0): ?>
                            <p style="color: #28a745; font-size: 1.3rem; font-weight: bold; margin-bottom: 1rem;">
                                Disponibles: <?php echo $prod['stock']; ?> uds
                            </p>
                            <form action="index.php?action=carrito-agregar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
                                <button type="submit" class="boton-agregar">Agregar al Carrito</button>
                            </form>
                        <?php else: ?>
                            <p style="color: #d0021b; font-size: 1.4rem; font-weight: bold; margin-bottom: 1rem; text-transform: uppercase;">
                                Agotado sin existencias
                            </p>
                            <button type="button" class="boton-agregar" style="background: #555; cursor: not-allowed;" onclick="alert('No hay existencias de este producto.')">No disponible</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-size: 1.8rem; text-align: center; width: 100%;">No hay productos disponibles.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <p>© 2026 DayaMel Skincare</p>
    </footer>
    <script src="js/app.js"></script>
</body>
</html>