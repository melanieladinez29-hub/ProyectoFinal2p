<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración - Inventario</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .tabla-admin { width: 85%; margin: 3rem auto; border-collapse: collapse; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 1rem; overflow: hidden;}
        .tabla-admin th, .tabla-admin td { padding: 1.5rem; text-align: center; border-bottom: 1px solid #eee; font-size: 1.6rem; }
        .tabla-admin th { background: #6a4c93; color: white; }
        .btn-crear { display: inline-block; background: #28a745; color: white; padding: 1rem 2rem; text-decoration: none; border-radius: .5rem; font-weight: bold; margin: 2rem auto; font-size: 1.6rem; }
        .btn-editar { background: #4a90e2; color: white; padding: .5rem 1rem; text-decoration: none; border-radius: .5rem; font-weight: bold; margin-right: .5rem;}
        .btn-eliminar { background: #d0021b; color: white; padding: .5rem 1rem; text-decoration: none; border-radius: .5rem; font-weight: bold;}
    </style>
</head>
<body>
    <header>
        <h1>Panel de Gestión CRUD</h1>
        <p class="subtitulo">Mantenimiento de Entidad Productos</p>
        <div class="nav-bg">
            <nav class="navegacion">
                <a href="index.php?action=inicio">Regresar al Home</a>
                <a href="index.php?action=productos">Ver Catálogo</a>
            </nav>
        </div>
    </header>

    <main style="text-align: center; padding: 2rem;">
        <a href="index.php?action=admin-crear" class="btn-crear">+ Registrar Nuevo Producto</a>
        
        <table class="tabla-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre Comercial</th>
                    <th>Precio de Venta</th>
                    <th>Acciones Críticas</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($productos) && is_array($productos) && count($productos) > 0): ?>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?php echo $p['id']; ?></td>
                            <td><img src="<?php echo htmlspecialchars($p['imagen']); ?>" width="60" style="border-radius:.5rem;"></td>
                            <td><strong><?php echo htmlspecialchars($p['nombre']); ?></strong></td>
                            <td>$<?php echo htmlspecialchars($p['precio']); ?></td>
                            <td>
                                <a href="index.php?action=admin-editar&id=<?php echo $p['id']; ?>" class="btn-editar">Editar</a>
                                <a href="index.php?action=admin-eliminar&id=<?php echo $p['id']; ?>" class="btn-eliminar" onclick="return confirm('¿Confirmas la eliminación permanente?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No se encontraron registros en el inventario.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>