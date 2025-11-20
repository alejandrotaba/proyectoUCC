<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $codigo = trim($_POST['codigo']);
    $correo = $_SESSION['correo_2fa'] ?? null;
    if(!$correo){ echo "<script>alert('Sesión expiró'); window.location='/profile';</script>"; exit; }
    $usuario = ModeloUsuarios::mdlObtenerUsuarioPorCorreo($correo);
    if(!$usuario){ echo "<script>alert('Usuario no encontrado'); window.location='/profile';</script>"; exit; }

    // verificar codigo
    if($usuario['codigo_2fa'] === $codigo && strtotime($usuario['codigo_2fa_expira']) > time()){
        // permitir cambiar
        $_SESSION['2fa_validado'] = $usuario['id'];
        echo "<script>window.location='cambiar_contra_2fa.php';</script>";
        exit;
    } else {
        echo "<script>alert('Código inválido o expirado'); history.back();</script>"; exit;
    }
}
?>
<!doctype html>
<form method="post">
    <h3>Introduce el código enviado a tu correo</h3>
    <input type="text" name="codigo" required>
    <button>Validar</button>
</form>
