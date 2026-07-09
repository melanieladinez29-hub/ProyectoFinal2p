<?php

require_once __DIR__ . '/../../config/conexion.php';

class Pedido {

    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos(){

        $sql = "SELECT p.*, c.nombre AS cliente
                FROM pedidos p
                INNER JOIN clientes c
                ON p.id_cliente = c.id
                ORDER BY p.id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerClientes(){

        $sql = "SELECT * FROM clientes ORDER BY nombre ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id){

        $sql = "SELECT * FROM pedidos WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id'=>$id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

   public function registrar($id_cliente,$total,$estado){

    $sql="INSERT INTO pedidos(id_cliente,total,estado)
          VALUES(:id_cliente,:total,:estado)";

    $stmt=$this->db->prepare($sql);

    $stmt->execute([
        ':id_cliente'=>$id_cliente,
        ':total'=>$total,
        ':estado'=>$estado
    ]);

    return $this->db->lastInsertId();
}
    public function actualizar($id,$id_cliente,$total,$estado){

        $sql = "UPDATE pedidos SET
                id_cliente=:id_cliente,
                total=:total,
                estado=:estado
                WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id,
            ':id_cliente'=>$id_cliente,
            ':total'=>$total,
            ':estado'=>$estado
        ]);
    }

    public function eliminar($id){

        $sql = "DELETE FROM pedidos WHERE id=:id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id
        ]);
    }
public function guardarDetalle($id_pedido,$id_producto,$cantidad,$precio){

    $sql="INSERT INTO detalle_pedidos
          (id_pedido,id_producto,cantidad,precio)
          VALUES
          (:id_pedido,:id_producto,:cantidad,:precio)";

    $stmt=$this->db->prepare($sql);

    return $stmt->execute([
        ':id_pedido'=>$id_pedido,
        ':id_producto'=>$id_producto,
        ':cantidad'=>$cantidad,
        ':precio'=>$precio
    ]);
}
public function obtenerProductos(){

    $sql = "SELECT * FROM productos ORDER BY nombre ASC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}