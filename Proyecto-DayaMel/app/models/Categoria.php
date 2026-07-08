<?php
require_once __DIR__ . '/../../config/conexion.php';

class Categoria {

    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM categorias ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM categorias WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre) {
        $sql = "INSERT INTO categorias(nombre)
                VALUES(:nombre)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'=>$nombre
        ]);
    }

    public function actualizar($id,$nombre) {
        $sql = "UPDATE categorias
                SET nombre=:nombre
                WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id,
            ':nombre'=>$nombre
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM categorias WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }

}
