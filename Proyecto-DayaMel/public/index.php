
<?php
// RUTA EXACTA: public/index.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../app/controllers/ProductoController.php';
require_once __DIR__ . '/../app/controllers/ContactoController.php';
require_once __DIR__ . '/../app/controllers/CategoriaController.php';
require_once __DIR__ . '/../app/controllers/ClienteController.php';
require_once __DIR__ . '/../app/controllers/ProveedorController.php';
require_once __DIR__ . '/../app/controllers/PedidoController.php';

// EL TRUCO: Si Apache borra la URL, lo buscamos dentro del POST invisible
$action = isset($_GET['action'])
    ? $_GET['action']
    : (isset($_POST['action']) ? $_POST['action'] : 'inicio');

$productoController = new ProductoController();
$contactoController = new ContactoController();
$categoriaController = new CategoriaController();
$clienteController = new ClienteController();
$proveedorController = new ProveedorController();
$pedidoController = new PedidoController();

switch ($action) {

    // ==========================
    // PÁGINAS PÚBLICAS
    // ==========================

    case 'inicio':
        $productoController->home();
        break;

    case 'nosotros':
        $productoController->nosotros();
        break;

    case 'productos':
        $productoController->catalogo();
        break;

    // ==========================
    // CONTACTO
    // ==========================

    case 'contacto-enviar':
        $contactoController->guardarMensaje();
        break;

    // ==========================
    // LOGIN
    // ==========================

    case 'login':
        $productoController->login();
        break;

    case 'logout':
        $productoController->logout();
        break;

    // ==========================
    // CARRITO
    // ==========================

    case 'carrito-ver':
        $productoController->verCarrito();
        break;

    case 'carrito-agregar':
        $productoController->agregarAlCarrito();
        break;

    case 'carrito-eliminar':
        $productoController->eliminarDelCarrito();
        break;

    case 'carrito-pagar':
        $productoController->pagarCarrito();
        break;
    
    case 'checkout':
    $productoController->checkout();
    break;

case 'procesar-compra':
    $productoController->procesarCompra();
    break;

    // ==========================
    // PRODUCTOS
    // ==========================

    case 'admin-productos':
        $productoController->listarAdmin();
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

    // ==========================
    // CATEGORÍAS
    // ==========================

    case 'admin-categorias':
        $categoriaController->listar();
        break;

    case 'categoria-crear':
        $categoriaController->crear();
        break;

    case 'categoria-editar':
        $categoriaController->editar();
        break;

    case 'categoria-eliminar':
        $categoriaController->eliminar();
        break;

    // ==========================
    // CLIENTES
    // ==========================

    case 'admin-clientes':
        $clienteController->listar();
        break;

    case 'cliente-crear':
        $clienteController->crear();
        break;

    case 'cliente-editar':
        $clienteController->editar();
        break;

    case 'cliente-eliminar':
        $clienteController->eliminar();
        break;

    // ==========================
    // PROVEEDORES
    // ==========================

    case 'admin-proveedores':
        $proveedorController->listar();
        break;

    case 'proveedor-crear':
        $proveedorController->crear();
        break;

    case 'proveedor-editar':
        $proveedorController->editar();
        break;

    case 'proveedor-eliminar':
        $proveedorController->eliminar();
        break;

    // ==========================
    // PEDIDOS
    // ==========================

    case 'admin-pedidos':
        $pedidoController->listar();
        break;

    case 'crear-pedido':
        $pedidoController->crear();
        break;

    case 'editar-pedido':
        $pedidoController->editar();
        break;

    case 'eliminar-pedido':
        $pedidoController->eliminar();
        break;

    default:
        header("Location: index.php?action=inicio");
        exit;
}