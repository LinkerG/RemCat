window.addEventListener("load", function(){
    let button = document.getElementById("addSponsorsToList");

    button.addEventListener("click", function(){
        let input = document.getElementById("sponsors-list");
        //let value = JSON.parse(input.value);
        fetch('/api/sponsors/fetchAll')
        .then(response => {
            if (!response.ok) {
            throw new Error('Hubo un problema al realizar la solicitud.');
            }
            return response.json(); // convierte la respuesta a JSON
        })
        .then(data => {
            console.log(data); // haz algo con los datos recibidos
        })
        .catch(error => {
            console.error('Error:', error);
        });

    })
})