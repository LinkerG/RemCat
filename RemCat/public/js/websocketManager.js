window.addEventListener("load", function(){
    var socket = new WebSocket('ws://' + window.location.hostname + ':6001');
    console.log(socket);
    socket.onopen = function(event) {
        enviarMensaje("conexion establecida")
        console.log("conexion establecida")
    };
    
    // Evento que se dispara cuando se recibe un mensaje del servidor
    socket.onmessage = function(event) {
        enviarMensaje('Mensaje del servidor:', event.data);
        console.log('Mensaje del servidor:', event.data)
    };
    
    // Evento que se dispara cuando se produce un error en la conexión
    socket.onerror = function(error) {
        enviarMensaje('Error en la conexión:', error);
        console.log('Error en la conexión:', error)
    };
    
    // Evento que se dispara cuando la conexión se cierra
    socket.onclose = function(event) {
        enviarMensaje('Conexión cerrada');
        console.log('Conexión cerrada')
    };
    
    // Función para enviar un mensaje al servidor  
})

function enviarMensaje(mensaje) {
    let responseDiv = document.getElementById("response");
    responseDiv.innerHTML = mensaje;
}