
<?php

class Conexion {

    private static $host = 'sql301.infinityfree.com';
    private static $dbName = 'if0_42366111_dayamel';
    private static $username = 'if0_42366111';
    private static $password = 'FNCW8PhvXqHWE';

    public static function conectar() {

        try {

            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8mb4";

            $pdo = new PDO($dsn, self::$username, self::$password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {

            die("Error de conexión: " . $e->getMessage());

        }

    }
}
