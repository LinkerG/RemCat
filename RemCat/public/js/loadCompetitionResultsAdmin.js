let pathname;
let year;
let competition_id;
let token;

window.addEventListener("load", function(){
    token = document.head.querySelector('meta[name="csrf-token"]').content;
    // Chatgptada indómita
    pathname = window.location.pathname;
    // Crear una expresión regular para extraer year y competition_id
    let regex = /\/(\d{2}_\d{2})\/(\w{24})$/;
    // Ejecutar la expresión regular en el pathname
    let match = pathname.match(regex);
    // Verificar si hubo una coincidencia
    if (match) {
        year = match[1];
        competition_id = match[2];
    } else {
        console.error("No se encontraron year y competition_id en el pathname.");
    }
    console.log(window.location.hostname);
    console.log(window.location.port);
    getResults()
});

function getResults(){
    let formData = new FormData();
    formData.append("year", year);
    formData.append("competition_id", competition_id);
    fetch('/api/competitions/getResultsFromCompetition', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        let resultsByCategory = {};
        data.forEach(result => {
            var category = result.category;
            // Verificar si ya existe un grupo para esta categoría
            if (!resultsByCategory[category]) {
                // Si no existe, crear un nuevo array para esta categoría
                resultsByCategory[category] = [];
            }
            
            // Agregar el JSON actual al grupo correspondiente
            resultsByCategory[category].push(result);
        });
        generateCompetitions(resultsByCategory)
    })
    .catch(error => console.error('Error:', error));
}

function generateCompetitions(resultsByCategory){
    console.log(resultsByCategory);

    let categories = Object.keys(resultsByCategory);
    let navBar = document.getElementById("nav-tab");
    let contentDiv = document.getElementById("nav-tabContent")
    let isFirst = true;
    for (let category of categories) {
        let button = generateButton(category, isFirst);
        navBar.appendChild(button);
        console.log(category);
        let splittedCategories = splitInGroups(resultsByCategory[category]);
        console.log(splittedCategories);
        let content = generateContent(category, splittedCategories, isFirst);
        contentDiv.appendChild(content);

        if(isFirst) isFirst = false;
    }
}

function generateButton(category, isFirst) {
    let button = document.createElement("button");
    
    button.classList.add("nav-link");
    if(isFirst) button.classList.add("active");
    button.id = "nav-" + category + "-tab";
    button.setAttribute("data-bs-toggle", "tab");
    button.setAttribute("data-bs-target", "#nav-" + category);
    button.type = "button";
    button.setAttribute("role", "tab");
    button.setAttribute("aria-controls", "nav-" + category);
    button.textContent = category;

    return button;
}

function splitInGroups(category){
    let longitudTotal = category.length;
    let numMiniArrays = Math.ceil(longitudTotal / 4);

    let tamanoMiniArray = Math.floor(longitudTotal / numMiniArrays);
    let extras = longitudTotal % numMiniArrays;

    let resultados = [];
    let inicio = 0;
    for (let i = 0; i < numMiniArrays; i++) {
        let fin = inicio + tamanoMiniArray + (i < extras ? 1 : 0);
        resultados.push(category.slice(inicio, fin));
        inicio = fin;
    }

    return resultados;
}

function generateContent(category, resultsArray, isFirst) {
    // Crear el elemento div principal
    const div = document.createElement("div");
    div.classList.add("tab-pane", "fade");
    if(isFirst) div.classList.add("show", "active")
    div.id = "nav-" + category;
    div.setAttribute("role", "tabpanel");
    div.setAttribute("aria-labelledby", "nav-" + category + "-tab");

    // Crear el elemento div container
    const containerDiv = document.createElement("div");
    containerDiv.classList.add("container");

    // Añadir los resultados a la tabla
    resultsArray.forEach((group, index) => {
        const groupDiv = document.createElement("div");
        groupDiv.classList.add("row")

        const groupName = document.createElement("div");
        groupName.classList.add("col-12");

        const groupNameText = document.createElement("h3")
        groupNameText.innerText = "Mánga " + (index+1)

        const qrDiv = document.createElement("div");
        qrDiv.classList.add("row");

        group.forEach(result => {
            console.log(result);
            
            const teamGroup = document.createElement("div")
            teamGroup.style.display = "flex"
            teamGroup.style.alignItems = "center"

            const teamName = document.createElement("p")
            teamName.innerHTML = result.teamName
            teamName.style.marginTop = "1rem"
            teamName.style.marginRight = "2rem"

            const teamTime = document.createElement("input");
            teamTime.value = result.time === "" ? "DNS" : result.time;
            teamTime.classList.add("time-" + result.category)
            teamTime.id = result._id

            teamGroup.appendChild(teamName);
            teamGroup.appendChild(teamTime);


            qrDiv.appendChild(teamGroup);
        });

        groupName.appendChild(groupNameText);
        groupDiv.appendChild(groupName)
        groupDiv.appendChild(qrDiv)

        containerDiv.appendChild(groupDiv);
    });
    const updateButton = document.createElement("button");
    updateButton.innerText = "Update"
    updateButton.classList.add("btn", "btn-primary", "btn-block")
    updateButton.addEventListener("click", function() {
        const timesToUpdate = Array.from(document.getElementsByClassName("time-" + resultsArray[0][0].category));
        console.log(timesToUpdate);
        
        let formData = new FormData();
        formData.append('_token', token);
        formData.append('competition_id', competition_id)
        formData.append('year', year)
    
        let times = [];
        timesToUpdate.forEach(time => {
            times.push({id: time.id, value: time.value});
        });
        
        // Convertimos el array de objetos a una cadena JSON
        formData.append('timesToUpdate', JSON.stringify(times));
    
        for (var pair of formData.entries()) {
            console.log(pair[0]); 
            console.log(pair[1]);
        }
    
        fetch('/api/competitions/setTimes', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log('Success:', data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
    

    // Añadir el div container al div principal
    div.appendChild(containerDiv);
    div.appendChild(updateButton);
    // Devolver el HTML generado
    return div;
}

function generateQR(texto) {
    // Crea un elemento canvas para el código QR
    const canvas = document.createElement('canvas');
    // Genera el código QR en el canvas
    QRCode.toCanvas(canvas, texto, function (error) {
        if (error) console.error(error);
        console.log('Código QR generado');
    });
    // Retorna la URL del código QR generado
    return canvas.toDataURL();
}
