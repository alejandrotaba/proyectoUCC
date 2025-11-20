-- Schema for inventario profile system
CREATE DATABASE IF NOT EXISTS inventario CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventario;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150),
  correo VARCHAR(200) UNIQUE,
  foto VARCHAR(300),
  password VARCHAR(255),
  keyword VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE permisos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario INT NOT NULL,
  puede_editar_dashboard TINYINT(1) DEFAULT 0,
  puede_crear_botones TINYINT(1) DEFAULT 0,
  puede_eliminar_botones TINYINT(1) DEFAULT 0,
  FOREIGN KEY (usuario) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE recovery_codes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  correo VARCHAR(200),
  codigo VARCHAR(20),
  expires_at DATETIME,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert demo user (password: secret123)
INSERT INTO usuarios (nombre, correo, password) VALUES ('Admin Demo', 'admin@example.com', 'REPLACE_WITH_HASH');
