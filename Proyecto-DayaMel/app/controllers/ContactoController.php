<?php


require_once __DIR__ . '/../models/Contacto.php';

class ContactoController {

    private $modelo;

    public function __construct() {
        $this->modelo = new Contacto();
    }
    public function guardarMensaje() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $nombre = isset($_POST['nombre']) 
                ? trim($_POST['nombre']) 
                : '';


            $correo = isset($_POST['correo']) 
                ? trim($_POST['correo']) 
                : '';


            $mensaje = isset($_POST['mensaje']) 
                ? trim($_POST['mensaje']) 
                : '';
            // Relación con clientes
            $id_cliente = isset($_POST['id_cliente']) && $_POST['id_cliente'] != ''
                ? intval($_POST['id_cliente'])
                : null;

            if (
                empty($nombre) || 
                empty($correo) || 
                empty($mensaje) || 
                !filter_var($correo, FILTER_VALIDATE_EMAIL)
            ) {

                header("Location: index.php?action=inicio&status=error#contacto");
                exit;

            }
            try {
                $id_insertado = $this->modelo->registrarMensaje(
                    $nombre,
                    $correo,
                    $mensaje,
                    $id_cliente
                );
                if ($id_insertado > 0) {

                    header("Location: index.php?action=inicio&status=success#contacto");

                } else {

                    header("Location: index.php?action=inicio&status=error#contacto");

                }
                exit;
            } catch (Exception $e) {

                die("Error interno de conexión a MySQL: " . $e->getMessage());

            }

        }

    }

}