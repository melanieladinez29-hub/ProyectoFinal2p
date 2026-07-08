<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - DayaMel-Skincare</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .login-contenedor { max-width: 400px; margin: 8rem auto; padding: 3rem; background: #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.15); border-radius: 1rem; }
        .btn-login { width: 100%; background: #6a4c93; color: white; padding: 1.2rem; border: none; border-radius: .5rem; font-size: 1.6rem; font-weight: bold; cursor: pointer; margin-top: 1.5rem; }
        .btn-regresar { display: block; text-align: center; margin-top: 1.5rem; font-size: 1.4rem; color: #777; text-decoration: none; }
    </style>
</head>
<body>
    <header>
        <h1>Acceso Administrativo</h1>
        <p class="subtitulo">DayaMel-Skincare</p>
    </header>

    <main>
        <div class="login-contenedor">
            <?php if(isset($error)): ?>
                <div class="error" style="margin-bottom: 1.5rem; text-align: center;"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="index.php?action=login" method="POST" class="formulario" style="padding: 0; box-shadow: none;">
                <legend style="text-align: center; margin-bottom: 2rem;">Iniciar Sesión</legend>
                
                <div class="campo">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" class="input-text" placeholder="Ej. juanito1" required>
                </div>

                <div class="campo">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" id="password" class="input-text" placeholder="••••" required>
                </div>

                <button type="submit" class="btn-login">Ingresar al Panel</button>
                <a href="index.php?action=inicio" class="btn-regresar">← Volver a la Tienda</a>
            </form>
        </div>
    </main>
</body>
</html>