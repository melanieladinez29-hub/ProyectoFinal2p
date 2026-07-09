<?php

require_once __DIR__ . '/../../config/conexion.php';

class Proveedor {

    private $db;

    public function __construct(){
        $this->db = Conexion::conectar();
    }


    public function obtenerTodos(){

        $sql="SELECT * FROM proveedores ORDER BY id DESC";

        $stmt=$this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerPorId($id){

        $sql="SELECT * FROM proveedores WHERE id=:id";

        $stmt=$this->db->prepare($sql);
        $stmt->execute([
            ':id'=>$id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function registrar($nombre,$empresa,$correo,$telefono,$direccion){

        $sql="INSERT INTO proveedores
        (nombre,empresa,correo,telefono,direccion)
        VALUES
        (:nombre,:empresa,:correo,:telefono,:direccion)";


        $stmt=$this->db->prepare($sql);

        return $stmt->execute([
            ':nombre'=>$nombre,
            ':empresa'=>$empresa,
            ':correo'=>$correo,
            ':telefono'=>$telefono,
            ':direccion'=>$direccion
        ]);

    }


    public function actualizar($id,$nombre,$empresa,$correo,$telefono,$direccion){

        $sql="UPDATE proveedores SET
        nombre=:nombre,
        empresa=:empresa,
        correo=:correo,
        telefono=:telefono,
        direccion=:direccion
        WHERE id=:id";


        $stmt=$this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id,
            ':nombre'=>$nombre,
            ':empresa'=>$empresa,
            ':correo'=>$correo,
            ':telefono'=>$telefono,
            ':direccion'=>$direccion
        ]);
    }


    public function eliminar($id){

        $sql="DELETE FROM proveedores WHERE id=:id";

        $stmt=$this->db->prepare($sql);

        return $stmt->execute([
            ':id'=>$id
        ]);

    }

}