<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";

$id = intval($_POST['id']);
$actual = $_POST['actual'];
$nueva = $_POST['nueva'];
$nueva2 = $_POST['nueva2'];

if($nueva !== $nueva2){
    echo "<script>alert('Las contraseñas no coinciden'); history.back();</script>"; exit;
}

$usuario = ModeloUsuarios::mdlObtenerUsuarioPorId($id);

if(!password_verify($actual, $usuario['password'])){
    echo "<script>alert('Contraseña actual incorrecta'); history.back();</script>"; exit;
}

$hash = password_hash($nueva, PASSWORD_DEFAULT);

if(ModeloUsuarios::mdlCambiarPassword($id, $hash)){
    echo "<script>alert('Contraseña actualizada'); window.location='/ingreso';</script>";
} else {
    echo "<script>alert('Error al actualizar'); history.back();</script>";
}
