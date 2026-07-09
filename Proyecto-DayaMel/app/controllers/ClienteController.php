<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Cliente();
    }

    private function verificarSesion() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin_usuario'])) {
            header("Location:index.php?action=login");
            exit;
        }
    }
    public function listar() {
        $this->verificarSesion();
        $clientes = $this->modelo->obtenerTodos();
        require __DIR__ . '/../views/clientes/listar.php';
    }
        
        public function crear() {

        $this->verificarSesion();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $direccion = trim($_POST['direccion']);

            if (empty($nombre) || empty($apellido) || empty($correo)) {

                $error = "Complete los campos obligatorios.";

                require __DIR__ . '/../views/clientes/crear.php';
                return;
            }

            $this->modelo->registrar(
                $nombre,
                $apellido,
                $correo,
                $telefono,
                $direccion
            );

            header("Location:index.php?action=admin-clientes");
            exit;
        }

        require __DIR__ . '/../views/clientes/crear.php';
    }


    public function editar() {

        $this->verificarSesion();

        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $direccion = trim($_POST['direccion']);

            $this->modelo->actualizar(
                $id,
                $nombre,
                $apellido,
                $correo,
                $telefono,
                $direccion
            );

            header("Location:index.php?action=admin-clientes");
            exit;
        }

        $cliente = $this->modelo->obtenerPorId($id);

        require __DIR__ . '/../views/clientes/editar.php';
    }


    public function eliminar() {

        $this->verificarSesion();

        $id = $_GET['id'];

        $this->modelo->eliminar($id);

        header("Location:index.php?action=admin-clientes");
        exit;
    }

}