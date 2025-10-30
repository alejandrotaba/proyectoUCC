<?php

require_once "Controladores/ControladorPlantilla.php";

require_once "Controladores/ControladorAdmin.php";
require_once "Controladores/ControladorUsuarios.php";
require_once "Controladores/ControladorCategorias.php";
require_once "Controladores/ControladorProductos.php";

//para poder utilizar variables de sesión
if (session_status() !== PHP_SESSION_ACTIVE) session_start();


$plantilla = new ControladorPlantilla();
$plantilla -> mostrarPlantilla();

// $plantilla = new ControladorAdmin();
// $plantilla -> mostrarAdmin();