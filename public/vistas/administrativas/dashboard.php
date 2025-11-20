<?php
session_start();
// for demo: logged in user id 1
if(!isset($_SESSION['id_usuario'])) $_SESSION['id_usuario'] = 1;
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Dashboard</title></head>
<body>
<h1>Dashboard - Inventario</h1>
<p>Bienvenido. <a href="/profile">Mi perfil</a> | <a href="/recuperar">Recuperar contraseña</a></p>
<hr>
<h3>Chat IA</h3>
<div id="chat-box" style="border:1px solid #ddd; padding:10px; height:200px; overflow:auto;"></div>
<input id="msg" placeholder="Escribe..." style="width:60%"><button onclick="send()">Enviar</button>
<script>
function send(){
    let m = document.getElementById('msg').value;
    fetch('/api/chatbot', {method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({msg:m})})
    .then(r=>r.json()).then(d=>{
        let cb = document.getElementById('chat-box');
        cb.innerHTML += '<p><b>Tú:</b> '+m+'</p><p><b>IA:</b> '+d.respuesta+'</p>';
    });
}
</script>
</body></html>
