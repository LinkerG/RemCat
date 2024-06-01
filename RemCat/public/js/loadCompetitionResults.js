let pathname;
let year;
let competition_id;
let token;

window.addEventListener("load", function() {
    token = document.head.querySelector('meta[name="csrf-token"]').content;
    pathname = window.location.pathname;
    let regex = /^\/\w+\/competitions\/(\d+)_(\d+)\/(viewResults)\/(\w+)$/;
    let match = pathname.match(regex);
    if (match) {
        year = match[1] + "_" + match[2];
        competition_id = match[4];
        console.log(year);
        console.log(competition_id);
    } else {
        console.error("No se encontraron year y competition_id en el pathname.");
    }
    getResults();
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
            if (result.timeValidated) {
                let category = result.category;
                if (!resultsByCategory[category]) {
                    resultsByCategory[category] = [];
                }
                resultsByCategory[category].push(result);
            }
        });
        generateCompetitions(resultsByCategory);
    })
    .catch(error => console.error('Error:', error));
}

function generateCompetitions(resultsByCategory){
    let categories = Object.keys(resultsByCategory);
    let navBar = document.getElementById("nav-tab");
    let contentDiv = document.getElementById("nav-tabContent");
    let isFirst = true;
    for (let category of categories) {
        let button = generateButton(category, isFirst);
        navBar.appendChild(button);
        let sortedResults = resultsByCategory[category].sort((a, b) => {
            return convertTimeToSeconds(a.time) - convertTimeToSeconds(b.time);
        });
        let content = generateContent(category, sortedResults, isFirst);
        contentDiv.appendChild(content);
        if (isFirst) isFirst = false;
    }
}

function generateButton(category, isFirst) {
    let button = document.createElement("button");
    button.classList.add("nav-link");
    if (isFirst) button.classList.add("active");
    button.id = "nav-" + category + "-tab";
    button.setAttribute("data-bs-toggle", "tab");
    button.setAttribute("data-bs-target", "#nav-" + category);
    button.type = "button";
    button.setAttribute("role", "tab");
    button.setAttribute("aria-controls", "nav-" + category);
    button.textContent = category;
    return button;
}

function generateContent(category, resultsArray, isFirst) {
    const div = document.createElement("div");
    div.classList.add("tab-pane", "fade");
    if (isFirst) div.classList.add("show", "active");
    div.id = "nav-" + category;
    div.setAttribute("role", "tabpanel");
    div.setAttribute("aria-labelledby", "nav-" + category + "-tab");

    const containerDiv = document.createElement("div");
    containerDiv.classList.add("container");

    resultsArray.forEach(result => {
        const rowDiv = document.createElement("div");
        rowDiv.classList.add("row");

        const teamNameDiv = document.createElement("div");
        teamNameDiv.classList.add("col-6");
        teamNameDiv.textContent = result.teamName;

        const teamTimeDiv = document.createElement("div");
        teamTimeDiv.classList.add("col-6");
        teamTimeDiv.textContent = result.time;

        rowDiv.appendChild(teamNameDiv);
        rowDiv.appendChild(teamTimeDiv);
        containerDiv.appendChild(rowDiv);
    });

    div.appendChild(containerDiv);
    return div;
}

function convertTimeToSeconds(time) {
    const [minutes, seconds, milliseconds] = time.split(':').map(Number);
    return minutes * 60 + seconds + milliseconds / 1000;
}
