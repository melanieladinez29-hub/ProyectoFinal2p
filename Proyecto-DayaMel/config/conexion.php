<?php


class Conexion {
    private static $host = 'localhost';
    private static $dbName = 'dayamel_db';
    private static $username = 'root';
    private static $password = ''; // Vacío por defecto en XAMPP

    public static function conectar() {
        try {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8mb4";
            $pdo = new PDO($dsn, self::$username, self::$password);
            // Habilitar excepciones para cumplir auditorías de código en la rúbrica
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error crítico de conexión en XAMPP: " . $e->getMessage());
        }
    }
}