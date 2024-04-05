let pathname;
let year;
let competition_id;

window.addEventListener("load", function(){
    pathname = window.location.pathname.split("/");
    year = pathname[3];
    competition_id = pathname[5];
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
        generateResultsPage(resultsByCategory);
    })
    .catch(error => console.error('Error:', error));
}

function generateResultsPage(resultsByCategory) {
    console.log(resultsByCategory);

    let categories = Object.keys(resultsByCategory);
    let navBar = document.getElementById("nav-tab");
    let contentDiv = document.getElementById("nav-tabContent")
    let isFirst = true;
    for (let category of categories) {
        let button = generateButton(category, isFirst);
        navBar.appendChild(button);

        let content = generateContent(category, resultsByCategory[category], isFirst);
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

function generateContent(category, results, isFirst) {
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

    // Crear el elemento div row para el título de la categoría
    const titleRowDiv = document.createElement("div");
    titleRowDiv.classList.add("row");

    // Crear el elemento div col-12 para el título de la categoría
    const titleColDiv = document.createElement("div");
    titleColDiv.classList.add("col-12");
    titleColDiv.textContent = category;

    // Añadir el título de la categoría al div row correspondiente
    titleRowDiv.appendChild(titleColDiv);

    // Crear el elemento div row para la tabla de resultados
    const tableRowDiv = document.createElement("div");
    tableRowDiv.classList.add("row");

    // Crear el elemento div col-12 para la tabla de resultados
    const tableColDiv = document.createElement("div");
    tableColDiv.classList.add("col-12");

    // Crear la tabla y su encabezado
    const table = document.createElement("table");
    const headerRow = document.createElement("tr");
    const headers = ["Posicion", "Equipo", "Tiempo"];
    headers.forEach(headerText => {
        const th = document.createElement("th");
        th.textContent = headerText;
        headerRow.appendChild(th);
    });
    table.appendChild(headerRow);

    // Añadir los resultados a la tabla
    results.forEach((result, index) => {
        const row = document.createElement("tr");
        const positionCell = document.createElement("td");
        positionCell.textContent = index + 1;
        const teamCell = document.createElement("td");
        teamCell.textContent = result.teamName;
        const timeCell = document.createElement("td");
        timeCell.textContent = result.time;
        row.appendChild(positionCell);
        row.appendChild(teamCell);
        row.appendChild(timeCell);
        table.appendChild(row);
    });

    // Añadir la tabla al div col-12 correspondiente
    tableColDiv.appendChild(table);

    // Añadir los divs de título y tabla al div container
    containerDiv.appendChild(titleRowDiv);
    containerDiv.appendChild(tableRowDiv);
    tableRowDiv.appendChild(tableColDiv);

    // Añadir el div container al div principal
    div.appendChild(containerDiv);

    // Devolver el HTML generado
    return div;
}
