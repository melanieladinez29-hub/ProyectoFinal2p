
<?php

require_once __DIR__ . '/../models/Pedido.php';

class PedidoController {

    private $modelo;

    public function __construct(){
        $this->modelo = new Pedido();
    }

    private function verificarSesion(){

        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['admin_usuario'])){
            header("Location:index.php?action=login");
            exit;
        }
    }

    // LISTAR
    public function listar(){

        $this->verificarSesion();

        $pedidos = $this->modelo->obtenerTodos();

        require __DIR__ . '/../views/pedidos/listar.php';
    }

    // CREAR
    
// CREAR
public function crear(){

    $this->verificarSesion();

    $clientes = $this->modelo->obtenerClientes();
    $productos = $this->modelo->obtenerProductos();

    if($_SERVER['REQUEST_METHOD']=="POST"){

        $id_cliente = $_POST['id_cliente'];
        $total = $_POST['total'];
        $estado = $_POST['estado'];

        if(empty($id_cliente) || empty($total)){

            $error = "Complete todos los campos.";

            require __DIR__ . '/../views/pedidos/crear.php';
            return;
        }


        $id_pedido = $this->modelo->registrar(
            $id_cliente,
            $total,
            $estado
        );


        if(isset($_POST['productos'])){

            foreach($_POST['productos'] as $producto){

                $this->modelo->guardarDetalle(
                    $id_pedido,
                    $producto['id_producto'],
                    $producto['cantidad'],
                    $producto['precio']
                );

            }

        }


        header("Location:index.php?action=admin-pedidos");
        exit;

    }


    require __DIR__ . '/../views/pedidos/crear.php';

}


    // EDITAR
    public function editar(){

        $this->verificarSesion();

        $id = $_GET['id'];

        $clientes = $this->modelo->obtenerClientes();

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $this->modelo->actualizar(
                $id,
                $_POST['id_cliente'],
                $_POST['total'],
                $_POST['estado']
            );

            header("Location:index.php?action=admin-pedidos");
            exit;
        }

        $pedido = $this->modelo->obtenerPorId($id);

        require __DIR__ . '/../views/pedidos/editar.php';
    }

    // ELIMINAR
    public function eliminar(){

        $this->verificarSesion();

        $id = $_GET['id'];

        $this->modelo->eliminar($id);

        header("Location:index.php?action=admin-pedidos");
        exit;
    }

}

