<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";
require_once "../../../../Controladores/ControladorUsuarios.php";

if(!isset($_SESSION["id_usuario"])) exit;

$id = intval($_POST['id']);
$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);

$fotoNombre = null;
if(isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0){
    $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
    $fotoNombre = "user_{$id}_" . time() . "." . $ext;
    move_uploaded_file($_FILES["foto"]["tmp_name"], "../../../../public/uploads/{$fotoNombre}");
}

$result = ModeloUsuarios::mdlActualizarPerfilConFoto($id, $nombre, $correo, $fotoNombre);

if($result){
    $_SESSION["nombre"] = $nombre;
    echo "<script>alert('Perfil actualizado'); window.location='/profile';</script>";
} else {
    echo "<script>alert('Error al actualizar'); history.back();</script>";
}
