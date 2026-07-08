<?php

class Conexion {

    public static function conectar() {

        try {

            $host = getenv('DB_HOST') ?: 'localhost';
            $dbName = getenv('DB_NAME') ?: 'dayamel_db';
            $username = getenv('DB_USER') ?: 'root';
            $password = getenv('DB_PASSWORD') ?: '';

            $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";

            $pdo = new PDO(
                $dsn,
                $username,
                $password
            );

            $pdo->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $pdo;


        } catch(PDOException $e) {

            die(
                "Error de conexión: " . $e->getMessage()
            );

        }

    }

}