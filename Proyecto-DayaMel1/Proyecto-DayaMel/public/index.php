<?php
// public/index.php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../app/controllers/ProductoController.php';
require_once __DIR__ . '/../app/controllers/ContactoController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'inicio';

$productoController = new ProductoController();
$contactoController = new ContactoController();

switch ($action) {
    case 'inicio':
        $productoController->home();
        break;
    case 'nosotros':
        $productoController->nosotros();
        break;
    case 'productos':
        $productoController->catalogo();
        break;
    case 'contacto-enviar':
        $contactoController->guardarMensaje();
        break;
    case 'admin-productos':
        $productoController->listarAdmin(); // Llama a la función del controlador
        break;
    case 'admin-crear':
        $productoController->crearProducto();
        break;
    case 'admin-editar':
        $productoController->editarProducto();
        break;
    case 'admin-eliminar':
        $productoController->eliminarProducto();
        break;
    default:
        header("Location: index.php?action=inicio");
        exit;
}