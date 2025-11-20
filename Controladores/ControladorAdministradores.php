<?php
require_once "Modelos/Conexion.php";
require_once "Modelos/ModeloLogs.php";

class ControladorAdministradores {

    public static function listar(){
        try{
            $db = Conexion::pdo();
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE perfil_usuario = 'administrador'");
            $stmt->execute();
            return $stmt->fetchAll();
        }catch(PDOException $e){
            error_log('Error listar administradores: '.$e->getMessage());
            return [];
        }
    }

    public static function obtenerPorId($id){
        try{
            $db = Conexion::pdo();
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }catch(PDOException $e){
            error_log('Error obtener admin: '.$e->getMessage());
            return null;
        }
    }

    public static function crear($data){
        try{
            $db = Conexion::pdo();
            $sql = "INSERT INTO usuarios (nombre_usuario, email_usuario, password_usuario, perfil_usuario, foto_usuario, estado_usuario, ultimo_login) VALUES (:nombre, :email, :password, 'administrador', :foto, :estado, NULL)";
            $stmt = $db->prepare($sql);
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
            $foto = isset($data['foto']) ? $data['foto'] : '';
            $estado = isset($data['estado']) ? intval($data['estado']) : 1;
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->execute();
            $id = $db->lastInsertId();
            ModeloLogs::registrar(isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']:null, 'crear', 'Creó administrador ID: '.$id.' email: '.$data['email']);
            return $id;
        }catch(PDOException $e){
            error_log('Error crear admin: '.$e->getMessage());
            return false;
        }
    }

    public static function editar($id, $data){
        try{
            $db = Conexion::pdo();
            // build query depending on password presence
            if(!empty($data['password'])){
                $password = password_hash($data['password'], PASSWORD_DEFAULT);
                $sql = "UPDATE usuarios SET nombre_usuario = :nombre, email_usuario = :email, password_usuario = :password, foto_usuario = :foto, estado_usuario = :estado WHERE id_usuario = :id";
            } else {
                $sql = "UPDATE usuarios SET nombre_usuario = :nombre, email_usuario = :email, foto_usuario = :foto, estado_usuario = :estado WHERE id_usuario = :id";
            }
            $stmt = $db->prepare($sql);
            $foto = isset($data['foto']) ? $data['foto'] : '';
            $estado = isset($data['estado']) ? intval($data['estado']) : 1;
            $stmt->bindParam(':nombre', $data['nombre']);
            $stmt->bindParam(':email', $data['email']);
            if(!empty($data['password'])){
                $stmt->bindParam(':password', $password);
            }
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            ModeloLogs::registrar(isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']:null, 'editar', 'Editó administrador ID: '.$id.' email: '.$data['email']);
            return true;
        }catch(PDOException $e){
            error_log('Error editar admin: '.$e->getMessage());
            return false;
        }
    }

    public static function eliminar($id){
        try{
            $db = Conexion::pdo();
            // Option: delete
            $stmt = $db->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            ModeloLogs::registrar(isset($_SESSION['id_usuario'])?$_SESSION['id_usuario']:null, 'eliminar', 'Eliminó administrador ID: '.$id);
            return true;
        }catch(PDOException $e){
            error_log('Error eliminar admin: '.$e->getMessage());
            return false;
        }
    }
}
?>
