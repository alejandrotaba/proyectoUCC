<?php session_start(); ?>
<!doctype html><html><head><meta charset='utf-8'><title>Validar</title></head><body>
<h3>Ingresa el código enviado o la palabra clave (opcional)</h3>
<?php if(isset($_GET['e'])): ?><div style="color:red">Código inválido</div><?php endif; ?>
<form action="/recuperar/validar" method="POST">
    <input type="text" name="codigo" placeholder="Código"><br><br>
    <input type="text" name="keyword" placeholder="Palabra clave (si la configuraste)"><br><br>
    <button>Validar</button>
</form>
</body></html>
