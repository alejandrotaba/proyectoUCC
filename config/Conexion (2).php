<?php
class Conexion {
    static public function conectar(){
        $host = '127.0.0.1';
        $db   = 'inventario';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (Exception $e) {
            die('DB Error: '.$e->getMessage());
        }
    }
}
