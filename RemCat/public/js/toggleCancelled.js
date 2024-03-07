window.addEventListener("load", function(){
    let toggles = document.getElementsByClassName("toggle-cancelled");
    let model = document.querySelector('[data-model]').getAttribute("data-model");
    for (let i = 0; i < toggles.length; i++) {
        const toggle = toggles[i];
        toggle.addEventListener("change", function(){
            let id = toggle.id.replace(/_cancelled$/, "");
            if(toggle.checked){
                sendUpdateIsCancelledRequest(id, model, true);
            } else {
                sendUpdateIsCancelledRequest(id, model, false);
            }
        });
    }
});

function sendUpdateIsCancelledRequest(id, model, newStatus){
    let formData = new FormData();
    formData.append('_id', id);
    formData.append('newStatus', newStatus);
    try{
        let year = document.querySelector('[data-year]').getAttribute("data-year");
        if(year) formData.append('year', year);
    } catch (error){
        
    }
    // Obtener el token CSRF del meta tag en el documento
    let token = document.head.querySelector('meta[name="csrf-token"]').content;
    // Agregar el token CSRF a los datos del formulario
    formData.append('_token', token);
    
    let route = "/api/" + model + "/changeIsCancelled"
    fetch(route, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}