<?php
require_once __DIR__ . '/../../config/conexion.php';

class Cliente {

    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos() {
        $stmt = $this->db->prepare("SELECT * FROM clientes ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM clientes WHERE id=:id");
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrar($nombre,$apellido,$correo,$telefono,$direccion) {

    $stmt = $this->db->prepare("
        INSERT INTO clientes(nombre,apellido,correo,telefono,direccion)
        VALUES(:nombre,:apellido,:correo,:telefono,:direccion)
    ");

    $stmt->execute([
        ':nombre'=>$nombre,
        ':apellido'=>$apellido,
        ':correo'=>$correo,
        ':telefono'=>$telefono,
        ':direccion'=>$direccion
    ]);

    return $this->db->lastInsertId();
}

    public function actualizar($id,$nombre,$apellido,$correo,$telefono,$direccion) {

        $stmt = $this->db->prepare("
            UPDATE clientes
            SET nombre=:nombre,
                apellido=:apellido,
                correo=:correo,
                telefono=:telefono,
                direccion=:direccion
            WHERE id=:id
        ");

        return $stmt->execute([
            ':id'=>$id,
            ':nombre'=>$nombre,
            ':apellido'=>$apellido,
            ':correo'=>$correo,
            ':telefono'=>$telefono,
            ':direccion'=>$direccion
        ]);
    }

   public function eliminar($id) {

    // Eliminar detalles de pedidos del cliente
    $stmt = $this->db->prepare("
        DELETE dp 
        FROM detalle_pedidos dp
        INNER JOIN pedidos p 
        ON dp.id_pedido = p.id
        WHERE p.id_cliente = :id
    ");

    $stmt->execute([
        ':id'=>$id
    ]);


    // Eliminar pedidos del cliente
    $stmt = $this->db->prepare("
        DELETE FROM pedidos 
        WHERE id_cliente = :id
    ");

    $stmt->execute([
        ':id'=>$id
    ]);


    // Eliminar cliente
    $stmt = $this->db->prepare("
        DELETE FROM clientes 
        WHERE id=:id
    ");

    return $stmt->execute([
        ':id'=>$id
    ]);
}
}