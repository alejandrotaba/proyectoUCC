<?php
session_start();
require_once "../../../../Modelos/ModeloUsuarios.php";
if(!isset($_SESSION['2fa_validado'])){ header("Location: /profile"); exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_SESSION['2fa_validado'];
    $nueva = $_POST['nueva'];
    $nueva2 = $_POST['nueva2'];
    if($nueva !== $nueva2){ echo "<script>alert('No coinciden'); history.back();</script>"; exit; }
    $hash = password_hash($nueva, PASSWORD_DEFAULT);
    if(ModeloUsuarios::mdlCambiarPassword($id, $hash)){
        unset($_SESSION['2fa_validado']);
        echo "<script>alert('Contraseña cambiada. Inicia sesión'); window.location='/ingreso';</script>";
    } else {
        echo "<script>alert('Error'); history.back();</script>";
    }
    exit;
}
?>
<form method="post">
    <h3>Escribe nueva contraseña</h3>
    <input name="nueva" type="password" required>
    <input name="nueva2" type="password" required>
    <button>Cambiar</button>
</form>
