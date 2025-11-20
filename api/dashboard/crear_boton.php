<?php
session_start();
require_once "../../../Modelos/ModeloUsuarios.php";
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$per = ModeloUsuarios::mdlObtenerPermisos($_SESSION['id_usuario']);
if(!$per['crear_botones']){ echo json_encode(['ok'=>false,'msg'=>'Sin permiso']); exit; }

$titulo = trim($data['titulo']);
if($titulo == ''){ echo json_encode(['ok'=>false,'msg'=>'Título vacío']); exit; }

// insertar en tabla botones_dashboard (usa tu propia tabla)
$stmt = Conexion::conectar()->prepare("INSERT INTO botones_dashboard (titulo,usuario_id) VALUES (:t,:u)");
$stmt->bindParam(":t",$titulo); $stmt->bindParam(":u",$_SESSION['id_usuario']);
if($stmt->execute()) echo json_encode(['ok'=>true]); else echo json_encode(['ok'=>false,'msg'=>'DB error']);
