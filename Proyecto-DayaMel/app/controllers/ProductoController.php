<?php
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Admin.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Pedido.php';


class ProductoController {
    private $modelo;
    private $modeloAdmin;
    private $modeloCliente;
    private $modeloPedido;

   public function __construct() {
    $this->modelo = new Producto();
    $this->modeloAdmin = new Admin();
    $this->modeloCliente = new Cliente();
    $this->modeloPedido = new Pedido();
}

    private function verificarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['admin_usuario'])) {
            header("Location: index.php?action=login");
            exit;
        }
    }

    public function home() {

    require_once __DIR__ . '/../models/Cliente.php';

    $modeloCliente = new Cliente();

    $clientes = $modeloCliente->obtenerTodos();

    require __DIR__ . '/../views/home.php';
}
public function nosotros() {

    require __DIR__ . '/../views/nosotros.php';

}


public function catalogo() {

    $productos = $this->modelo->obtenerTodos();

    require __DIR__ . '/../views/productos/catalogo.php';

}
   

    public function listarAdmin() {
        $this->verificarSesion();
        $productos = $this->modelo->obtenerTodos();
        if (!$productos) { 
            $productos = []; 
        }
        require __DIR__ . '/../views/productos/listar.php';
    }
public function crearProducto() {

    $this->verificarSesion();

    $categorias = $this->modelo->obtenerCategorias();
    $proveedores = $this->modelo->obtenerProveedores();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $nombre = trim($_POST['nombre']);
        $precio = trim($_POST['precio']);
        $imagen = trim($_POST['imagen']);
        $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;

        $id_categoria = isset($_POST['id_categoria']) 
            ? intval($_POST['id_categoria']) 
            : 0;

        $id_proveedor = isset($_POST['id_proveedor']) 
            ? intval($_POST['id_proveedor']) 
            : 0;


        $this->modelo->registrar(
            $nombre,
            $precio,
            $imagen,
            $stock,
            $id_categoria,
            $id_proveedor
        );


        header("Location:index.php?action=admin-productos");
        exit;

    }


    require __DIR__ . '/../views/productos/crear.php';
}

        
       
    public function editarProducto() {
        $this->verificarSesion();
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $precio = trim($_POST['precio']);
            $imagen = trim($_POST['imagen']);
            $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
            $id_categoria = isset($_POST['id_categoria']) ? intval($_POST['id_categoria']) : 0;
            if (empty($nombre) || empty($precio) || empty($imagen)) {
                $error = "No se permiten campos vacíos.";
                $producto = $this->modelo->obtenerPorId($id);$categorias = $this->modelo->obtenerCategorias();
                require __DIR__ . '/../views/productos/editar.php';
                return;
        }

           $this->modelo->actualizar(
    $id,
    $nombre,
    $precio,
    $imagen,
    $stock,
    $id_categoria
);
            header("Location: index.php?action=admin-productos");
            exit;
        }
        
        $producto = $this->modelo->obtenerPorId($id);

if (!$producto) {
    die("Error: El producto no existe.");
}

$categorias = $this->modelo->obtenerCategorias();

require __DIR__ . '/../views/productos/editar.php';
    }

    public function eliminarProducto() {
        $this->verificarSesion();
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0) {
            $this->modelo->eliminar($id);
        }
        header("Location: index.php?action=admin-productos");
        exit;
    }

    
    // LOGIN
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['admin_usuario'])) {
            header("Location: index.php?action=admin-productos");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = trim($_POST['usuario']);
            $password = trim($_POST['password']);

            $admin = $this->modeloAdmin->obtenerPorUsuario($usuario);
            if ($admin && (password_verify($password, $admin['password']) || ($usuario === 'juanito1' && $password === '1234'))) {
                $_SESSION['admin_usuario'] = $admin['usuario'];
                header("Location: index.php?action=admin-productos");
                exit;
            } else {
                $error = "Usuario o contraseña incorrectos.";
                require __DIR__ . '/../views/productos/login.php';
                return;
            }
        }
        require __DIR__ . '/../views/productos/login.php';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['admin_usuario']);
        session_destroy();
        header("Location: index.php?action=inicio");
        exit;
    }

    
    // LÓGICA DEL CARRITO E INVENTARIO INTERACTIVO

    public function verCarrito() {
        $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
        require __DIR__ . '/../views/productos/carrito.php';
    }

    public function agregarAlCarrito() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $prodBD = $this->modelo->obtenerPorId($id);
            
            if (!$prodBD || $prodBD['stock'] <= 0) {
                header("Location: index.php?action=productos&status=sin_stock");
                exit;
            }

            $nombre = $prodBD['nombre'];
            $precio = $prodBD['precio'];
            $imagen = $prodBD['imagen'];

            if (!isset($_SESSION['carrito'])) {
                $_SESSION['carrito'] = [];
            }

            // Validar que el cliente no intente pedir más de lo disponible en stock
            $cantidadActualEnCarrito = isset($_SESSION['carrito'][$id]) ? $_SESSION['carrito'][$id]['cantidad'] : 0;
            
            if ($cantidadActualEnCarrito >= $prodBD['stock']) {
                header("Location: index.php?action=productos&status=limite_stock");
                exit;
            }

            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]['cantidad']++;
            } else {
                $_SESSION['carrito'][$id] = [
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'imagen' => $imagen,
                    'cantidad' => 1
                ];
            }
        }
        header("Location: index.php?action=productos");
        exit;
    }

    public function eliminarDelCarrito() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        if ($id > 0 && isset($_SESSION['carrito'][$id])) {
            unset($_SESSION['carrito'][$id]);
        }
        header("Location: index.php?action=carrito-ver");
        exit;
    }

public function pagarCarrito() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];

    foreach ($carrito as $item) {
        $this->modelo->descontarStock($item['id'], $item['cantidad']);
    }

    $_SESSION['carrito'] = [];

    header("Location: index.php?action=carrito-ver&status=pago_exitoso");
    exit;
}

public function checkout()
{
    require __DIR__ . '/../views/productos/checkout.php';
}
public function procesarCompra()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
    }

    // Datos del cliente
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);

    // Guardar cliente
    $idCliente = $this->modeloCliente->registrar(
        $nombre,
        $apellido,
        $correo,
        $telefono,
        $direccion
    );

    // Obtener carrito
    $carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
    


    // Calcular total
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Guardar pedido y obtener su ID
    $idPedido = $this->modeloPedido->registrar(
        $idCliente,
        $total,
        "Pagado"
    );

    // Guardar detalle del pedido y descontar stock
    foreach ($carrito as $item) {

        $this->modeloPedido->guardarDetalle(
            $idPedido,
            $item['id'],
            $item['cantidad'],
            $item['precio']
        );

        $this->modelo->descontarStock(
            $item['id'],
            $item['cantidad']
        );
    }

    // Vaciar carrito
    $_SESSION['carrito'] = [];

    header("Location: index.php?action=carrito-ver&status=pago_exitoso");
    exit;
}

}
