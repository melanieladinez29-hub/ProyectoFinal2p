<?php

require_once __DIR__ . '/../models/Proveedor.php';


class ProveedorController {

    private $modelo;


    public function __construct(){
        $this->modelo = new Proveedor();
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


    public function listar(){

        $this->verificarSesion();

        $proveedores = $this->modelo->obtenerTodos();

        require __DIR__ . '/../views/proveedores/listar.php';

    }



    public function crear(){

        $this->verificarSesion();


        if($_SERVER['REQUEST_METHOD']=="POST"){

            $nombre = trim($_POST['nombre']);
            $empresa = trim($_POST['empresa']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $direccion = trim($_POST['direccion']);


            if(empty($nombre) || empty($empresa) || empty($correo)){

                $error="Complete los campos obligatorios.";

                require __DIR__ . '/../views/proveedores/crear.php';
                return;

            }


            $this->modelo->registrar(
                $nombre,
                $empresa,
                $correo,
                $telefono,
                $direccion
            );


            header("Location:index.php?action=admin-proveedores");
            exit;

        }


        require __DIR__ . '/../views/proveedores/crear.php';

    }




    public function editar(){

        $this->verificarSesion();


        $id=$_GET['id'];


        if($_SERVER['REQUEST_METHOD']=="POST"){


            $this->modelo->actualizar(
                $id,
                $_POST['nombre'],
                $_POST['empresa'],
                $_POST['correo'],
                $_POST['telefono'],
                $_POST['direccion']
            );


            header("Location:index.php?action=admin-proveedores");
            exit;

        }


        $proveedor=$this->modelo->obtenerPorId($id);


        require __DIR__ . '/../views/proveedores/editar.php';

    }




    public function eliminar(){

        $this->verificarSesion();


        $id=$_GET['id'];


        $this->modelo->eliminar($id);


        header("Location:index.php?action=admin-proveedores");
        exit;

    }

}