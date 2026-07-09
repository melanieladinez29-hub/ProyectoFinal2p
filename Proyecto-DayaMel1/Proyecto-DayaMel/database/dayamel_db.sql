CREATE DATABASE IF NOT EXISTS dayamel_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dayamel_db;

-- Entidad 1: Productos (Catálogo)
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Entidad 2: Mensajes de Contacto (Atención al cliente)
CREATE TABLE IF NOT EXISTS mensajes_contacto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    mensaje TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Carga inicial de tus productos de Skincare originales
INSERT INTO productos (id, nombre, precio, imagen) VALUES
(1, 'Kit Skincare Esencial', 35.00, 'imagenes/Skincare.jpg'),
(2, 'Serum Crema Dr. Atenea', 20.50, 'imagenes/serum.jpg'),
(3, 'Crema Hidratante Medicube', 22.00, 'imagenes/crema.jpg'),
(4, 'Exfoliante Centella', 20.00, 'imagenes/exfoliante.jpg')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), precio=VALUES(precio), imagen=VALUES(imagen);