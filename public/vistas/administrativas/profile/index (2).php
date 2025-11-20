<?php
session_start();
require_once __DIR__ . '/../../../Controladores/ControladorUsuarios.php';
require_once __DIR__ . '/../../../Modelos/ModeloUsuarios.php';
$id = $_SESSION['id_usuario'] ?? 1;
$user = ControladorUsuarios::obtener($id);
$permisos = ModeloUsuarios::obtenerPermisos($id);
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Perfil</title></head><body>
<h2>Perfil de <?= htmlspecialchars($user['nombre'] ?? 'Usuario') ?></h2>

<?php if(isset($_GET['m'])): ?><div style="color:green">Operación realizada</div><?php endif; ?>
<?php if(isset($_GET['e'])): ?><div style="color:red">Error: <?=htmlspecialchars($_GET['e'])?></div><?php endif; ?>

<form action="/profile/update" method="POST" enctype="multipart/form-data">
    <label>Nombre</label><br>
    <input type="text" name="nombre" value="<?=htmlspecialchars($user['nombre'] ?? '')?>"><br><br>

    <label>Correo</label><br>
    <input type="email" name="correo" value="<?=htmlspecialchars($user['correo'] ?? '')?>"><br><br>

    <label>Foto</label><br>
    <input type="file" name="foto"><br>
    <?php if(!empty($user['foto'])): ?>
        <img src="/<?=htmlspecialchars($user['foto'])?>" width="120"><br>
    <?php endif; ?>

    <button>Guardar perfil</button>
</form>

<hr>
<h3>Cambiar contraseña</h3>
<form action="/profile/password" method="POST">
    <input type="password" name="actual" placeholder="Contraseña actual"><br><br>
    <input type="password" name="nueva" placeholder="Nueva contraseña"><br><br>
    <button>Cambiar</button>
</form>

<hr>
<h3>Permisos</h3>
<form action="/profile/permisos" method="POST" onsubmit="return confirm('¿Estás seguro de actualizar permisos?');">
    <label><input type="checkbox" name="editar" <?=(!empty($permisos['puede_editar_dashboard'])?'checked':'')?>> Puede editar dashboard</label><br>
    <label><input type="checkbox" name="crear" <?=(!empty($permisos['puede_crear_botones'])?'checked':'')?>> Puede crear botones</label><br>
    <label><input type="checkbox" name="eliminar" <?=(!empty($permisos['puede_eliminar_botones'])?'checked':'')?>> Puede eliminar botones</label><br>
    <button>Guardar permisos</button>
</form>

<hr>
<p><a href="/dashboard">Volver al dashboard</a> | <a href="/recuperar">Recuperar contraseña (2FA)</a></p>

</body></html>
