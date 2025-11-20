<?php
session_start();
require_once __DIR__ . '/../../../config/Conexion.php';
if(empty($_SESSION['2fa_ok']) || empty($_SESSION['correo_2fa'])) { header('Location: /recuperar'); exit; }
$nueva = $_POST['nueva'] ?? '';
$hash = password_hash($nueva, PASSWORD_DEFAULT);
$pdo = Conexion::conectar();
$stmt = $pdo->prepare('UPDATE usuarios SET password = :p WHERE correo = :c');
$stmt->execute([':p'=>$hash, ':c'=>$_SESSION['correo_2fa']]);
session_destroy();
echo 'Contraseña actualizada. <a href="/">Ir a ingreso</a>';
