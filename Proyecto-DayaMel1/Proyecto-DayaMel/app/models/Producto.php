<?php
// app/models/Producto.php
require_once __DIR__ . '/../../config/conexion.php';

class Producto {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM productos ORDER BY id DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en el modelo al obtener productos: " . $e->getMessage());
        }
    }

    public function registrar($nombre, $precio, $imagen) {
        try {
            $stmt = $this->db->prepare("INSERT INTO productos (nombre, precio, imagen) VALUES (:nombre, :precio, :imagen)");
            return $stmt->execute([':nombre' => $nombre, ':precio' => $precio, ':imagen' => $imagen]);
        } catch (PDOException $e) {
            die("Error al registrar: " . $e->getMessage());
        }
    }

    public function obtenerPorId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM productos WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al buscar por ID: " . $e->getMessage());
        }
    }

    public function actualizar($id, $nombre, $precio, $imagen) {
        try {
            $stmt = $this->db->prepare("UPDATE productos SET nombre = :nombre, precio = :precio, imagen = :imagen WHERE id = :id");
            return $stmt->execute([':id' => $id, ':nombre' => $nombre, ':precio' => $precio, ':imagen' => $imagen]);
        } catch (PDOException $e) {
            die("Error al actualizar: " . $e->getMessage());
        }
    }

    public function eliminar($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM productos WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            die("Error al eliminar: " . $e->getMessage());
        }
    }
}