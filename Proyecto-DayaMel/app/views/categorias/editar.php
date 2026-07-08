<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">

<title>Editar Categoría</title>

<link rel="stylesheet" href="css/styles.css">

<style>

.formulario{

width:450px;

margin:40px auto;

background:white;

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

background:#4a90e2;

color:white;

border:none;

padding:12px;

width:100%;

cursor:pointer;

border-radius:5px;

}

.error{

color:red;

font-weight:bold;

}

.volver{

display:block;

margin-top:15px;

text-align:center;

}

</style>

</head>

<body>

<div class="formulario">

<h2>Editar Categoría</h2>

<?php if(isset($error)): ?>

<p class="error"><?= $error ?></p>

<?php endif; ?>

<form method="POST">

<input
type="text"
name="nombre"
value="<?= htmlspecialchars($categoria['nombre']) ?>"
required>

<button>

Actualizar Categoría

</button>

</form>

<a class="volver"
href="index.php?action=admin-categorias">

⬅ Volver

</a>

</div>

</body>

</html>