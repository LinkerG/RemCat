window.addEventListener("load", function(){
    let icon = document.getElementById("header-dropdown-icon");
    let button = document.getElementById("header-dropdown-button")

    // Evento para que al hacer clic en el boton y no solo en el dropdown se anime el icono
    button.addEventListener("click", function(){
        icon.playerInstance.playFromBeginning();
    })
});