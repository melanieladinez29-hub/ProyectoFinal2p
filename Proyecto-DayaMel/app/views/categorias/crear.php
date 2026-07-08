<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="css/styles.css">

    <style>
        .formulario{
            width:450px;
            margin:40px auto;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,.1);
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
            font-size:16px;
        }

        button{
            background:#28a745;
            color:white;
            border:none;
            padding:12px;
            width:100%;
            cursor:pointer;
            font-size:16px;
            border-radius:5px;
        }

        a{
            text-decoration:none;
        }

        .volver{
            display:block;
            margin-top:15px;
            text-align:center;
        }

        .error{
            color:red;
            font-weight:bold;
        }
    </style>

</head>

<body>

<div class="formulario">

<h2>Registrar Categoría</h2>

<?php if(isset($error)): ?>

<p class="error"><?= $error ?></p>

<?php endif; ?>

<form method="POST">

<input
type="text"
name="nombre"
placeholder="Nombre de la categoría"
required>

<button type="submit">

Guardar Categoría

</button>

</form>

<a class="volver"
href="index.php?action=admin-categorias">

⬅ Volver

</a>

</div>

</body>
</html>