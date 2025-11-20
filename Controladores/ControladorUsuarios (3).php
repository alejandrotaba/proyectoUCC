<?php
require_once __DIR__ . '/../Modelos/ModeloUsuarios.php';
class ControladorUsuarios {
    static public function obtener($id){
        return ModeloUsuarios::obtenerPorId($id);
    }

    static public function actualizarPerfil(){
        session_start();
        if(!isset($_SESSION['id_usuario'])) { header('Location: /ingreso'); exit; }
        $id = $_SESSION['id_usuario'];
        $nombre = trim($_POST['nombre'] ?? '');
        $correo = trim($_POST['correo'] ?? '');
        $fotoPath = '';

        $user = ModeloUsuarios::obtenerPorId($id);
        $fotoPath = $user['foto'] ?? '';

        if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
            $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $safe = 'user_'.$id.'_'.time().'.'.$ext;
            $targetDir = __DIR__ . '/../public/uploads/';
            if(!is_dir($targetDir)) mkdir($targetDir, 0755, true);
            $target = $targetDir . $safe;
            move_uploaded_file($_FILES['foto']['tmp_name'], $target);
            $fotoPath = 'public/uploads/' . $safe;
        }

        $datos = ['id'=>$id, 'nombre'=>$nombre, 'correo'=>$correo, 'foto'=>$fotoPath];
        ModeloUsuarios::actualizarPerfil($datos);
        header('Location: /profile?m=updated');
        exit;
    }

    static public function cambiarPassword(){
        session_start();
        if(!isset($_SESSION['id_usuario'])) { header('Location: /ingreso'); exit; }
        $id = $_SESSION['id_usuario'];
        $actual = $_POST['actual'] ?? '';
        $nueva = $_POST['nueva'] ?? '';

        $user = ModeloUsuarios::obtenerPorId($id);
        if(!$user) { header('Location: /profile?e=nouser'); exit; }

        if(password_verify($actual, $user['password'])){
            $hash = password_hash($nueva, PASSWORD_DEFAULT);
            ModeloUsuarios::actualizarPassword($id, $hash);
            header('Location: /profile?m=passchanged');
            exit;
        } else {
            header('Location: /profile?e=wrongpass');
            exit;
        }
    }

    static public function enviarCodigo2FA(){
        session_start();
        $correo = $_POST['correo'] ?? $_SESSION['correo_2fa_request'] ?? null;
        if(!$correo) { header('Location: /recuperar?e=noemail'); exit; }

        $codigo = rand(100000,999999);
        ModeloUsuarios::guardarCodigo2FA($correo, $codigo);

        // send email using PHPMailer if available
        $cfg = require __DIR__ . '/../config/mail.php';
        $sent = false;
        if(file_exists(__DIR__ . '/../vendor/autoload.php')){
            require __DIR__ . '/../vendor/autoload.php';
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = $cfg['host'];
                $mail->SMTPAuth = true;
                $mail->Username = $cfg['username'];
                $mail->Password = $cfg['password'];
                $mail->SMTPSecure = 'tls';
                $mail->Port = $cfg['port'];
                $mail->setFrom($cfg['from_email'], $cfg['from_name']);
                $mail->addAddress($correo);
                $mail->isHTML(true);
                $mail->Subject = 'Código de recuperación';
                $mail->Body = 'Tu código es: <strong>'.$codigo.'</strong>';
                $mail->send();
                $sent = true;
            } catch (Exception $e) {
                // fallback to mail()
            }
        }
        if(!$sent){
            @mail($correo, 'Código de recuperación', 'Tu código es: '.$codigo);
        }

        $_SESSION['correo_2fa'] = $correo;
        header('Location: /recuperar/validar');
        exit;
    }

    static public function validarCodigo2FA(){
        session_start();
        $correo = $_SESSION['correo_2fa'] ?? ($_POST['correo'] ?? null);
        $codigo = trim($_POST['codigo'] ?? '');
        $keyword = trim($_POST['keyword'] ?? '');

        // keyword allowed if it matches users.keyword
        if($keyword){
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare('SELECT keyword FROM usuarios WHERE correo = :c LIMIT 1');
            $stmt->execute([':c'=>$correo]);
            $row = $stmt->fetch();
            if($row && $row['keyword'] === $keyword){
                $_SESSION['2fa_ok'] = true;
                header('Location: /recuperar/nueva');
                exit;
            }
        }

        if(ModeloUsuarios::validarCodigo2FA($correo, $codigo)){
            $_SESSION['2fa_ok'] = true;
            header('Location: /recuperar/nueva');
            exit;
        } else {
            header('Location: /recuperar/validar?e=badcode');
            exit;
        }
    }

    static public function actualizarPermisos(){
        session_start();
        if(!isset($_SESSION['id_usuario'])) { header('Location: /ingreso'); exit; }
        $id = $_SESSION['id_usuario'];
        $p = [
            'editar' => isset($_POST['editar'])?1:0,
            'crear'  => isset($_POST['crear'])?1:0,
            'eliminar'=> isset($_POST['eliminar'])?1:0
        ];
        ModeloUsuarios::actualizarPermisos($id, $p);
        header('Location: /profile?m=perm');
        exit;
    }
}
