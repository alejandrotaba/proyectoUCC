<?php
require_once "Modelos/Conexion.php";

class ModeloLogs {

    public static function registrar($id_usuario, $accion, $descripcion){
        try {
            $db = Conexion::pdo();
            $sql = "INSERT INTO logs_acciones (id_usuario, accion, descripcion, fecha, ip) VALUES (:id_usuario, :accion, :descripcion, NOW(), :ip)";
            $stmt = $db->prepare($sql);
            $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
            $stmt->bindParam(':id_usuario', $id_usuario);
            $stmt->bindParam(':accion', $accion);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':ip', $ip);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error en ModeloLogs::registrar: '.$e->getMessage());
            return false;
        }
    }
}
?>