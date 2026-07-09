<?php

require_once __DIR__ . '/../../config/conexion.php';

class Admin {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerPorUsuario($usuario) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM administradores WHERE usuario = :usuario LIMIT 1");
            $stmt->execute([':usuario' => $usuario]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en el modelo Admin: " . $e->getMessage());
        }
    }
}