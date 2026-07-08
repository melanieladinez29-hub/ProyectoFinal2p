<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DayaMel-SkinCare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body> 
    <header>
        <h1>DayaMel-Skincare</h1>
        <p class="subtitulo">Todo para el cuidado de tu piel</p>
        <div class="nav-bg">
            <nav class="navegacion">
                <a href="index.php?action=inicio">Inicio</a>
                <a href="index.php?action=productos">Productos</a>
                <a href="index.php?action=nosotros">Nosotros</a>
                <a href="#contacto">Contacto</a>
                <a href="index.php?action=admin-productos" style="color: #b39cd0;">Panel Admin</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <h2>Dale a tu piel la luminosidad que necesita con estos productos</h2>
            <p>En DayaMel-Skincare vendemos productos de buena calidad para el cuidado de tu piel.</p>
            <a href="index.php?action=productos" class="boton-accion">Ver Catálogo Completo</a>
        </section>

        <section id="contacto" class="contacto">
            <h2>Contáctanos</h2>
            
            <?php if(isset($_GET['status']) && $_GET['status'] === 'success'): ?>
                <div style="background: #28a745; color: white; padding: 1.2rem; text-align: center; border-radius: .5rem; margin: 1rem auto; font-size: 1.6rem; font-weight: bold; width: 100%;">
                    ¡Formulario enviado correctamente! Tu mensaje ha sido registrado con exito.
                </div>
            <?php endif; ?>
            
            <?php if(isset($_GET['status']) && $_GET['status'] === 'error'): ?>
                <div style="background: #d0021b; color: white; padding: 1.2rem; text-align: center; border-radius: .5rem; margin: 1rem auto; font-size: 1.6rem; font-weight: bold; width: 100%;">
                    ❌ Error: Por favor, verifica que los datos ingresados sean válidos.
                </div>
            <?php endif; ?>

            <form id="formulario-contacto" action="index.php" method="POST" class="formulario">
                
                <input type="hidden" name="action" value="contacto-enviar">

                <fieldset>
                    <legend>Déjanos tu mensaje</legend>
                    <div class="contenedor-campos">
                        <div class="campo">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="input-text" placeholder="Tu nombre" required>
                        </div>
                        <div class="campo">
                            <label for="correo">Correo:</label>
                            <input type="email" name="correo" id="correo" class="input-text" placeholder="tu@correo.com" required>
                        </div>
                        <div class="campo">
    <label for="id_cliente">Cliente registrado (opcional):</label>

    <select name="id_cliente" id="id_cliente" class="input-text">

        <option value="">
            No soy cliente registrado
        </option>

        <?php if(isset($clientes)): ?>

            <?php foreach($clientes as $c): ?>

                <option value="<?= $c['id']; ?>">
                    <?= htmlspecialchars($c['nombre']." ".$c['apellido']); ?>
                </option>

            <?php endforeach; ?>

        <?php endif; ?>

    </select>

</div>
                        <div class="campo campo-completo">
                            <label for="mensaje">Mensaje:</label>
                            <textarea name="mensaje" id="mensaje" class="input-text mensaje" placeholder="Cuéntanos qué necesita tu piel" required></textarea>
                        </div>
                    </div>
                    <div class="enviar">
                        <button type="submit" class="boton">Enviar Mensaje</button>
                    </div>
                </fieldset>
            </form>
        </section>
    </main>

    <footer class="footer">
        <p>© 2026 DayaMel Skincare</p>
    </footer>
</body>
</html>