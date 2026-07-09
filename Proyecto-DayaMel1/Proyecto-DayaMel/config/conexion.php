<?php
// config/conexion.php

class Conexion {
    private static $host = 'localhost';
    private static $dbName = 'dayamel_db';
    private static $username = 'root';
    private static $password = ''; 

    public static function conectar() {
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8mb4";
            $pdo = new PDO($dsn, self::$username, self::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error crítico de conexión en XAMPP: " . $e->getMessage());
        }
    }
}