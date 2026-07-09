<?php
// RUTA EXACTA: app/controllers/ProductoController.php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Producto();
    }

    public function home() {
        require_once __DIR__ . '/../views/home.php';
    }

    public function nosotros() {
        require_once __DIR__ . '/../views/nosotros.php';
    }

    public function catalogo() {
        // Forzamos a que la variable sea global para que la vista la lea sin importar el scope
        $productos = $this->modelo->obtenerTodos();
        if (!$productos) { $productos = []; } // Evita que sea null
        require __DIR__ . '/../views/productos/catalogo.php'; // Cambiado a 'require' común para refrescar scope
    }

    public function listarAdmin() {
        $productos = $this->modelo->obtenerTodos();
        if (!$productos) { $productos = []; }
        require __DIR__ . '/../views/productos/listar.php';
    }

    public function crearProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $precio = trim($_POST['precio']);
            $imagen = trim($_POST['imagen']);

            if (empty($nombre) || empty($precio) || empty($imagen)) {
                $error = "Todos los campos son obligatorios en el servidor.";
                require __DIR__ . '/../views/productos/crear.php';
                return;
            }

            $this->modelo->registrar($nombre, $precio, $imagen);
            header("Location: index.php?action=admin-productos");
            exit;
        }
        require __DIR__ . '/../views/productos/crear.php';
    }

    public function editarProducto() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $precio = trim($_POST['precio']);
            $imagen = trim($_POST['imagen']);

            if (empty($nombre) || empty($precio) || empty($imagen)) {
                $error = "No se permiten campos vacíos en el servidor.";
                $producto = $this->modelo->obtenerPorId($id);
                require __DIR__ . '/../views/productos/editar.php';
                return;
            }

            $this->modelo->actualizar($id, $nombre, $precio, $imagen);
            header("Location: index.php?action=admin-productos");
            exit;
        }
        
        $producto = $this->modelo->obtenerPorId($id);
        if (!$producto) {
            die("Error: El producto con ID $id no existe en la base de datos.");
        }
        require __DIR__ . '/../views/productos/editar.php';
    }

    public function eliminarProducto() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?action=admin-productos");
        exit;
    }
}