
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Pedido</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

<h1 style="text-align:center;">Registrar Pedido</h1>

<div style="width:500px;margin:auto;">

<form method="POST">

    <label>Cliente</label>

    <select name="id_cliente" required>

        <option value="">Seleccione...</option>

        <?php foreach($clientes as $cliente): ?>

            <option value="<?= $cliente['id'] ?>">
                <?= htmlspecialchars($cliente['nombre']) ?>
            </option>

        <?php endforeach; ?>

    </select>


    <br><br>


    <h3>Productos</h3>

    <?php foreach($productos as $producto): ?>

        <div style="margin-bottom:10px;">

            <input 
            type="checkbox"
            name="productos[<?= $producto['id'] ?>][id_producto]"
            value="<?= $producto['id'] ?>">


            <?= htmlspecialchars($producto['nombre']) ?>

            - $<?= $producto['precio'] ?>


            <br>

            Cantidad:

            <input
            type="number"
            name="productos[<?= $producto['id'] ?>][cantidad]"
            value="1"
            min="1">


            <input
            type="hidden"
            name="productos[<?= $producto['id'] ?>][precio]"
            value="<?= $producto['precio'] ?>">


        </div>

    <?php endforeach; ?>


    <br>


    <label>Total</label>

    <input
        type="number"
        step="0.01"
        name="total"
        required>


    <br><br>


    <label>Estado</label>

    <select name="estado">

        <option value="Pendiente">Pendiente</option>
        <option value="Pagado">Pagado</option>
        <option value="Enviado">Enviado</option>
        <option value="Entregado">Entregado</option>

    </select>


    <br><br>


    <button type="submit">
        Guardar Pedido
    </button>


</form>

</div>

</body>
</html>