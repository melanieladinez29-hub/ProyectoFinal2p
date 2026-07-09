```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administración - Pedidos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<h1 style="text-align:center;">Administración de Pedidos</h1>

<div style="width:90%;margin:20px auto;">
    <a href="index.php?action=crear-pedido" class="boton">
        ➕ Nuevo Pedido
    </a>

    <table border="1" cellpadding="10" cellspacing="0" width="100%" style="margin-top:20px;border-collapse:collapse;">

        <tr style="background:#f5d7e3;">
            <th>ID</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php foreach($pedidos as $pedido): ?>

        <tr>
            <td><?= $pedido['id'] ?></td>
            <td><?= htmlspecialchars($pedido['cliente']) ?></td>
            <td><?= $pedido['fecha'] ?></td>
            <td>$<?= number_format($pedido['total'],2) ?></td>
            <td><?= $pedido['estado'] ?></td>

            <td>

                <a href="index.php?action=editar-pedido&id=<?= $pedido['id'] ?>">
                    Editar
                </a>

                |

                <a href="index.php?action=eliminar-pedido&id=<?= $pedido['id'] ?>"
                   onclick="return confirm('¿Eliminar este pedido?')">
                    Eliminar
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</div>

</body>
</html>
```
