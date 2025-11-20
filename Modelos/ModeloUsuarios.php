<?php
// =======================================
// ModeloUsuarios.php
// Ejemplo de clase modelo en PHP con PDO
// =======================================

// Importa la clase de conexión
require_once "Modelos/Conexion.php";

class ModeloUsuarios {

    /**
     * Buscar un usuario por su email
     * 
     * @param string $email Correo electrónico a buscar
     * @return array|null   Retorna un array asociativo con los datos del usuario o null si no existe
     */
    public static function findByEmail(string $email): ?array
    {
        // Consulta SQL con marcador (placeholder)
        $consultaSql = "
            SELECT 
                id_usuario, 
                nombre_usuario, 
                email_usuario, 
                password_usuario 
            FROM usuarios 
            WHERE email_usuario = :email_usuario
            LIMIT 1
        ";

        try {
            // Preparamos la consulta
            $stmt = Conexion::pdo()->prepare($consultaSql);

            // Enlazamos el parámetro para evitar inyección SQL
            $stmt->bindParam(":email_usuario", $email, PDO::PARAM_STR);

            // Ejecutamos
            $stmt->execute();

            // Obtenemos el resultado como array asociativo
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si no encuentra nada, fetch devuelve false → convertimos en null
            return $usuario ?: null;

        } catch (PDOException $e) {
            // Registramos el error en el log (nunca mostramos detalles al usuario)
            error_log("Error en findByEmail: " . $e->getMessage());
            return null;
        }
    }

    static public function mdlActualizarPerfil($datos){

    $pdo = Conexion::conectar()->prepare("UPDATE usuarios SET nombre=:nombre, correo=:correo WHERE id=:id");

    $pdo->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
    $pdo->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
    $pdo->bindParam(":id", $datos["id"], PDO::PARAM_INT);

    if($pdo->execute()){
        return "ok";
    } else {
        return "error";
    }
   }

   class ModeloUsuarios {
    static public function mdlObtenerUsuarioPorId($id){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function mdlObtenerUsuarioPorCorreo($correo){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE correo = :correo");
        $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    static public function mdlActualizarPerfilConFoto($id, $nombre, $correo, $foto = null){
        if($foto){
            $sql = "UPDATE usuarios SET nombre=:nombre, correo=:correo, foto=:foto WHERE id=:id";
        } else {
            $sql = "UPDATE usuarios SET nombre=:nombre, correo=:correo WHERE id=:id";
        }
        $stmt = Conexion::conectar()->prepare($sql);
        $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
        $stmt->bindParam(":correo",$correo,PDO::PARAM_STR);
        if($foto) $stmt->bindParam(":foto",$foto,PDO::PARAM_STR);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        return $stmt->execute();
    }

    static public function mdlCambiarPassword($id, $hash){
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET password = :pw WHERE id = :id");
        $stmt->bindParam(":pw",$hash);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }

    static public function mdlGuardarCodigo2FA($id, $codigo, $expira){
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET codigo_2fa=:c, codigo_2fa_expira=:e WHERE id=:id");
        $stmt->bindParam(":c",$codigo);
        $stmt->bindParam(":e",$expira);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }

    static public function mdlGuardarPalabraClave($id, $hash){
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET palabra_clave=:p WHERE id=:id");
        $stmt->bindParam(":p",$hash);
        $stmt->bindParam(":id",$id);
        return $stmt->execute();
    }

    static public function mdlObtenerPermisos($id){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM permisos WHERE usuario_id = :id LIMIT 1");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$r){
            // devolver valores por defecto
            return [
                'editar_dashboard'=>0,'crear_botones'=>0,'eliminar_botones'=>0,'cambiar_nombre'=>1,'cambiar_correo'=>1
            ];
        }
        return $r;
    }
  }


}
