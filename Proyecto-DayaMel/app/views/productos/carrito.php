<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu Carrito - DayaMel-Skincare</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .tabla-carrito { width: 85%; margin: 3rem auto; border-collapse: collapse; background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border-radius: 1rem; overflow: hidden;}
        .tabla-carrito th, .tabla-carrito td { padding: 1.5rem; text-align: center; border-bottom: 1px solid #eee; font-size: 1.6rem; }
        .tabla-carrito th { background: #6a4c93; color: white; }
        .btn-eliminar { background: #d0021b; color: white; padding: .5rem 1rem; text-decoration: none; border-radius: .5rem; font-weight: bold;}
        .btn-comprar { display: inline-block; background: #28a745; color: white; padding: 1.5rem 3rem; text-decoration: none; border-radius: .5rem; font-weight: bold; font-size: 1.8rem; margin-top: 2rem; border: none; cursor: pointer; text-align: center;}
        .total-contenedor { font-size: 2.2rem; margin: 2rem auto; text-align: right; width: 85%; font-weight: bold; color: #4a4a4a; }
        
        /* DISEÑO DE LA PASARELA DE PAGO */
        .seccion-pago { display: none; max-width: 500px; margin: 3rem auto; padding: 3rem; background: #22222b; border-radius: 1rem; box-shadow: 0 5px 20px rgba(0,0,0,0.3); color: #fff; border: 2px solid #6a4c93; }
        .seccion-pago h3 { font-size: 2rem; text-align: center; color: #b39cd0; margin-bottom: 2rem; }
        .tarjeta-campos { display: flex; flex-direction: column; gap: 1.5rem; }
        .grupo-campo { display: flex; flex-direction: column; gap: 0.5rem; }
        .grupo-campo label { font-size: 1.4rem; color: #b39cd0; }
        .input-tarjeta { padding: 1.2rem; background: #2d2d3a; border: 1px solid #444; border-radius: 0.5rem; color: #fff; font-size: 1.6rem; font-family: monospace; }
        .input-tarjeta::placeholder { color: #777; }
        .input-tarjeta:focus { border-color: #6a4c93; outline: none; }
        .fila-doble { display: flex; gap: 1.5rem; }
        .fila-doble .grupo-campo { flex: 1; }
        .btn-finalizar-pago { width: 100%; background: #6a4c93; color: white; padding: 1.5rem; border: none; border-radius: 0.5rem; font-size: 1.8rem; font-weight: bold; cursor: pointer; margin-top: 1.5rem; transition: background 0.3s; }
        .btn-finalizar-pago:hover { background: #573b7a; }
    </style>
</head>
<body>
    <header>
        <h1>Tu Carrito de Compras</h1>
        <p class="subtitulo">Revisa los cosméticos seleccionados</p>
        <div class="nav-bg">
            <nav class="navegacion">
                <a href="index.php?action=productos">← Seguir Comprando</a>
                <a href="index.php?action=inicio">Ir al Home</a>
            </nav>
        </div>
    </header>

    <main style="padding: 2rem;">
        
        <?php if(isset($_GET['status']) && $_GET['status'] === 'pago_exitoso'): ?>
            <div style="background: #d4edda; color: #155724; padding: 1.5rem; text-align: center; border-radius: .5rem; margin: 1rem auto; width: 85%; font-size: 1.6rem; font-weight: bold;">
                ¡Gracias por tu compra! Tu pago simulado con PayPhone ha sido procesado con éxito, el stock fue actualizado y el carrito se ha vaciado.
            </div>
        <?php endif; ?>

        <table class="tabla-carrito">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $totalGeneral = 0; 
                if (!empty($carrito)): 
                    foreach ($carrito as $item): 
                        $subtotal = $item['precio'] * $item['cantidad'];
                        $totalGeneral += $subtotal;
                ?>
                        <tr>
                            <td><img src="<?php echo htmlspecialchars($item['imagen']); ?>" width="60" style="border-radius:.5rem;"></td>
                            <td><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></td>
                            <td>$<?php echo number_format($item['precio'], 2); ?></td>
                            <td><?php echo $item['cantidad']; ?></td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <a href="index.php?action=carrito-eliminar&id=<?php echo $item['id']; ?>" class="btn-eliminar">Quitar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding: 3rem; font-size: 1.8rem; color: #777;">Tu carrito está vacío actualmente.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($carrito)): ?>
            <div class="total-contenedor">
                Total a Pagar: <span style="color: #6a4c93;">$<?php echo number_format($totalGeneral, 2); ?></span>
            </div>
            <div style="text-align: center; margin-bottom: 3rem;">
                <button type="button" class="btn-comprar" onclick="document.getElementById('formulario-payphone').style.display = 'block'; this.style.display = 'none';">Proceder al Pago con PayPhone</button>
            </div>

            <div id="formulario-payphone" class="seccion-pago">
                <h3> Pasarela de Pago PayPhone</h3>
                
                <form action="index.php?action=checkout" method="POST" class="tarjeta-campos">
                    <div class="grupo-campo">
                        <label>Nombre del Titular:</label>
                        <input type="text" class="input-tarjeta" placeholder="Ej. Dayanna Sánchez" required>
                    </div>

                    <div class="grupo-campo">
                        <label>Número de Tarjeta (Débito/Crédito):</label>
                        <input type="text" class="input-tarjeta" placeholder="4000123456789010" pattern="[0-9]{13,19}" title="Introduce los números de tu tarjeta sin espacios" required>
                    </div>

                    <div class="fila-doble">
                        <div class="grupo-campo">
                            <label>Fecha de Vencimiento:</label>
                            <input type="text" class="input-tarjeta" maxlength="5" placeholder="MM/AA" pattern="(0[1-9]|1[0-2])/[0-9]{2}" title="Usa el formato MM/AA (Ej. 08/29)" required>
                        </div>
                        <div class="grupo-campo">
                            <label>Código CVV:</label>
                            <input type="password" class="input-tarjeta" maxlength="4" placeholder="123" pattern="[0-9]{3,4}" title="Los 3 o 4 números de seguridad al reverso" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-finalizar-pago">Confirmar y Pagar $<?php echo number_format($totalGeneral, 2); ?></button>
                </form>
            </div>
        <?php endif; ?>
        
    </main>
</body>
</html>