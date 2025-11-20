<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";
require_once "../../../../vendor/PHPMailer/PHPMailerAutoload.php"; // si usas composer ajusta

$correo = $_POST['correo'];
$usuario = ModeloUsuarios::mdlObtenerUsuarioPorCorreo($correo);
if(!$usuario){
    echo "<script>alert('Correo no registrado'); history.back();</script>"; exit;
}

// Generar código y guardar en DB (y fecha)
$codigo = rand(100000,999999);
$expira = date("Y-m-d H:i:s", time() + 600); // 10 minutos

ModeloUsuarios::mdlGuardarCodigo2FA($usuario['id'], $codigo, $expira);

// Enviar correo (ejemplo con mail())
$asunto = "Código de verificación";
$mensaje = "Tu código es: {$codigo}\nVálido 10 minutos.";
$headers = "From: no-reply@tudominio.com\r\n";

mail($correo, $asunto, $mensaje, $headers);

// Redirigir a página para validar código
$_SESSION['correo_2fa'] = $correo;
echo "<script>window.location='/public/vistas/administrativas/profile/validar_codigo.php';</script>";
