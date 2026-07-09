<?php
// app/controllers/ContactoController.php
require_once __DIR__ . '/../models/Contacto.php';

class ContactoController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Contacto();
    }

    public function guardarMensaje() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $mensaje = trim($_POST['mensaje']);

            if (empty($nombre) || empty($correo) || empty($mensaje) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                header("Location: index.php?action=inicio&status=error");
                exit;
            }

            $this->modelo->registrarMensaje($nombre, $correo, $mensaje);
            header("Location: index.php?action=inicio&status=success#contacto");
            exit;
        }
    }
}