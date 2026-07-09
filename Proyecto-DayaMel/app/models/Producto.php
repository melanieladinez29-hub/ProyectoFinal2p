<?php
require_once __DIR__ . '/../../config/conexion.php';

class Producto {

    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos() {
        try {
            $sql = "SELECT productos.*,
               categorias.nombre AS categoria,
               proveedores.empresa AS proveedor
        FROM productos
        INNER JOIN categorias
        ON productos.id_categoria = categorias.id
        LEFT JOIN proveedores
        ON productos.id_proveedor = proveedores.id
        ORDER BY productos.id DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Error al obtener productos: ".$e->getMessage());
        }
    }

public function registrar($nombre,$precio,$imagen,$stock,$id_categoria,$id_proveedor) {

    try {

        $stmt = $this->db->prepare(
            "INSERT INTO productos
            (nombre, precio, imagen, stock, id_categoria, id_proveedor)
            VALUES
            (:nombre, :precio, :imagen, :stock, :id_categoria, :id_proveedor)"
        );

        return $stmt->execute([
            ':nombre' => $nombre,
            ':precio' => $precio,
            ':imagen' => $imagen,
            ':stock' => $stock,
            ':id_categoria' => $id_categoria,
            ':id_proveedor' => $id_proveedor
        ]);

    } catch (PDOException $e) {
        die("Error al registrar producto: " . $e->getMessage());
    }
}
    


    public function obtenerPorId($id) {

        try {

            $stmt = $this->db->prepare(
                "SELECT * FROM productos WHERE id = :id LIMIT 1"
            );

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {

            die("Error al buscar por ID: " . $e->getMessage());
        }
    }

public function actualizar($id, $nombre, $precio, $imagen, $stock, $id_categoria) {

    try {

        $stmt = $this->db->prepare(
            "UPDATE productos 
             SET nombre = :nombre,
                 precio = :precio,
                 imagen = :imagen,
                 stock = :stock,
                 id_categoria = :id_categoria
             WHERE id = :id"
        );

        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':precio' => $precio,
            ':imagen' => $imagen,
            ':stock' => $stock,
            ':id_categoria' => $id_categoria
        ]);

    } catch (PDOException $e) {

        die("Error al actualizar producto: " . $e->getMessage());

    }
}
    
      

    public function descontarStock($id, $cantidad) {

        try {

            $stmt = $this->db->prepare(
                "UPDATE productos 
                 SET stock = stock - :cantidad 
                 WHERE id = :id 
                 AND stock >= :cantidad"
            );

            return $stmt->execute([
                ':id' => $id,
                ':cantidad' => $cantidad
            ]);

        } catch (PDOException $e) {

            die("Error al descontar inventario: " . $e->getMessage());
        }
    }


    public function eliminar($id) {

        try {

            $stmt = $this->db->prepare(
                "DELETE FROM productos WHERE id = :id"
            );

            return $stmt->execute([
                ':id' => $id
            ]);

        } catch (PDOException $e) {

            die("Error al eliminar producto: " . $e->getMessage());
        }
    }
    public function obtenerCategorias() {

    try {

        $stmt = $this->db->prepare(
            "SELECT * FROM categorias ORDER BY nombre ASC"
        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

        die("Error al obtener categorías: " . $e->getMessage());

    }
}
public function obtenerProveedores(){

    $sql = "SELECT * FROM proveedores";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    
    
}