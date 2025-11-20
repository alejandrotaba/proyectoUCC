<?php
session_start();
if(empty($_SESSION['2fa_ok'])) { header('Location: /recuperar'); exit; }
?>
<!doctype html><html><head><meta charset='utf-8'><title>Nueva contraseña</title></head><body>
<h3>Coloca nueva contraseña</h3>
<form action="/recuperar/nueva_accion" method="POST">
    <input type="password" name="nueva" placeholder="Nueva contraseña" required><br><br>
    <button>Cambiar contraseña</button>
</form>
</body></html>
