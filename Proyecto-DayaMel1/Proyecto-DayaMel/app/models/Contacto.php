<?php
// app/models/Contacto.php
require_once __DIR__ . '/../../config/conexion.php';

class Contacto {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function registrarMensaje($nombre, $correo, $mensaje) {
        $stmt = $this->db->prepare("INSERT INTO mensajes_contacto (nombre, correo, mensaje) VALUES (:nombre, :correo, :mensaje)");
        return $stmt->execute([':nombre' => $nombre, ':correo' => $correo, ':mensaje' => $mensaje]);
    }
}