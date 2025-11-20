<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";
$id = $_SESSION['id_usuario'] ?? null;
if(!$id) exit;
$palabra = trim($_POST['palabra']);
if($palabra === ''){ echo "<script>alert('Palabra vacía'); history.back();</script>"; exit; }
$hash = password_hash($palabra, PASSWORD_DEFAULT);
ModeloUsuarios::mdlGuardarPalabraClave($id, $hash);
echo "<script>alert('Palabra guardada'); window.location='/profile';</script>";
