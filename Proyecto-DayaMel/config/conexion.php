<?php

class Conexion {

    private static $host = 'sql.freedb.tech';
    private static $dbName = 'freedb_qw6SHRHX';
    private static $username = 'u_Cu3N0H';
    private static $password = 'OQNdraNSk0Xf';

    public static function conectar() {

        try {

            $dsn = "mysql:host=" . self::$host . ";port=3306;dbname=" . self::$dbName . ";charset=utf8mb4";

            $pdo = new PDO($dsn, self::$username, self::$password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }

    }
}

         
