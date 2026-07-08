<?php
// RUTA EXACTA: app/models/Contacto.php
require_once __DIR__ . '/../../config/conexion.php';

class Contacto {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

   public function registrarMensaje($nombre, $correo, $mensaje, $id_cliente = null) {

    try {

        $stmt = $this->db->prepare(
            "INSERT INTO mensajes_contacto 
            (nombre, correo, mensaje, id_cliente)
            VALUES 
            (:nombre, :correo, :mensaje, :id_cliente)"
        );

        $stmt->execute([
            ':nombre' => $nombre,
            ':correo' => $correo,
            ':mensaje' => $mensaje,
            ':id_cliente' => $id_cliente
        ]);

        return $this->db->lastInsertId();

    } catch (PDOException $e) {

        die("Error crítico al registrar mensaje en MySQL: " . $e->getMessage());

  
            
            // Devolvemos el ID de la fila insertada. Si hay ID, es que se guardó 100% seguro.
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            die("Error crítico al registrar mensaje en MySQL: " . $e->getMessage());
        }
    }
}