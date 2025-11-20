<?php
header('Content-Type: application/json');
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$msg = $data['msg'] ?? '';
// For production: call AI provider API here (OpenAI, Google, etc).
// This is a simple stub.
$res = 'IA (demo): ' . ($msg ? $msg : 'Hola, ¿en qué puedo ayudarte?');
echo json_encode(['respuesta'=>$res]);
