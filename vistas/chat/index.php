<div id="chat-box" class="p-3 border" style="height:400px; overflow-y:auto;"></div>

<input id="msg" class="form-control mt-3" placeholder="Escribe...">
<button onclick="enviarMensaje()" class="btn btn-success mt-2">Enviar</button>

<script>
function enviarMensaje(){
    let m = document.getElementById("msg").value;

    fetch("/api/chatbot",{
        method:"POST",
        body: JSON.stringify({msg:m})
    })
    .then(r=>r.json())
    .then(data=>{
        document.getElementById("chat-box").innerHTML += 
        "<p><b>Tú:</b> "+m+"</p>"+
        "<p><b>IA:</b> "+data.respuesta+"</p>";
    })
}
</script>
