<?php
require_once __DIR__ . '/../config/Conexion.php';
class ModeloUsuarios {
    static public function obtenerPorId($id){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT id, nombre, correo, foto, password, keyword FROM usuarios WHERE id = :id LIMIT 1');
        $stmt->execute([':id'=>$id]);
        return $stmt->fetch();
    }

    static public function obtenerPorCorreo($correo){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT id, nombre, correo, foto, password, keyword FROM usuarios WHERE correo = :c LIMIT 1');
        $stmt->execute([':c'=>$correo]);
        return $stmt->fetch();
    }

    static public function actualizarPerfil($datos){
        $pdo = Conexion::conectar();
        $sql = 'UPDATE usuarios SET nombre = :nombre, correo = :correo, foto = :foto WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':nombre'=>$datos['nombre'],
            ':correo'=>$datos['correo'],
            ':foto'=>$datos['foto'],
            ':id'=>$datos['id']
        ]);
    }

    static public function actualizarPassword($id, $hash){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE usuarios SET password = :password WHERE id = :id');
        return $stmt->execute([':password'=>$hash, ':id'=>$id]);
    }

    static public function guardarCodigo2FA($correo, $codigo){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('INSERT INTO recovery_codes (correo, codigo, expires_at) VALUES (:correo, :codigo, DATE_ADD(NOW(), INTERVAL 10 MINUTE))');
        return $stmt->execute([':correo'=>$correo, ':codigo'=> $codigo]);
    }

    static public function validarCodigo2FA($correo, $codigo){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM recovery_codes WHERE correo = :correo AND codigo = :codigo AND expires_at > NOW() ORDER BY id DESC LIMIT 1');
        $stmt->execute([':correo'=>$correo, ':codigo'=>$codigo]);
        return $stmt->fetch();
    }

    static public function obtenerPermisos($usuarioId){
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM permisos WHERE usuario = :u LIMIT 1');
        $stmt->execute([':u'=>$usuarioId]);
        return $stmt->fetch();
    }

    static public function actualizarPermisos($usuarioId, $permisos){
        $pdo = Conexion::conectar();
        $exists = $pdo->prepare('SELECT id FROM permisos WHERE usuario = :u');
        $exists->execute([':u'=>$usuarioId]);
        if($exists->fetch()){
            $stmt = $pdo->prepare('UPDATE permisos SET puede_editar_dashboard=:a, puede_crear_botones=:b, puede_eliminar_botones=:c WHERE usuario=:u');
            return $stmt->execute([':a'=>$permisos['editar'],':b'=>$permisos['crear'],':c'=>$permisos['eliminar'],':u'=>$usuarioId]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO permisos (usuario, puede_editar_dashboard, puede_crear_botones, puede_eliminar_botones) VALUES (:u,:a,:b,:c)');
            return $stmt->execute([':u'=>$usuarioId,':a'=>$permisos['editar'],':b'=>$permisos['crear'],':c'=>$permisos['eliminar']]);
        }
    }
}
