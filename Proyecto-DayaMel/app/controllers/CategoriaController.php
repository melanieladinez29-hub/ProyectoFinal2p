<?php

require_once __DIR__.'/../models/Categoria.php';

class CategoriaController{

    private $modelo;

    public function __construct(){
        $this->modelo=new Categoria();
    }

    private function verificarSesion(){

        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }

        if(!isset($_SESSION['admin_usuario'])){
            header("Location:index.php?action=login");
            exit;
        }

    }

    public function listar(){

        $this->verificarSesion();

        $categorias=$this->modelo->obtenerTodos();

        require __DIR__.'/../views/categorias/listar.php';

    }

    public function crear(){

        $this->verificarSesion();

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $nombre=trim($_POST['nombre']);

            if(empty($nombre)){
                $error="Debe ingresar el nombre.";
                require __DIR__.'/../views/categorias/crear.php';
                return;
            }

            $this->modelo->registrar($nombre);

            header("Location:index.php?action=admin-categorias");
            exit;

        }

        require __DIR__.'/../views/categorias/crear.php';

    }

    public function editar(){

        $this->verificarSesion();

        $id=$_GET['id'];

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $nombre=trim($_POST['nombre']);

            if(empty($nombre)){
                $error="Debe ingresar un nombre.";
                $categoria=$this->modelo->obtenerPorId($id);
                require __DIR__.'/../views/categorias/editar.php';
                return;
            }

            $this->modelo->actualizar($id,$nombre);

            header("Location:index.php?action=admin-categorias");
            exit;

        }

        $categoria=$this->modelo->obtenerPorId($id);

        require __DIR__.'/../views/categorias/editar.php';

    }

    public function eliminar(){

        $this->verificarSesion();

        $id=$_GET['id'];

        $this->modelo->eliminar($id);

        header("Location:index.php?action=admin-categorias");
        exit;

    }

}