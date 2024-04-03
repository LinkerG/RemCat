// Variables usadas en todo el doc
var competition_id;
var token;
var teamName;
var isEditing = false;
window.addEventListener("load", function(){
    competition_id = window.location.pathname.substring(window.location.pathname.lastIndexOf("/") + 1);
    token = document.head.querySelector('meta[name="csrf-token"]').content;
    teamName = document.getElementById("teamName").value;
    saveButtonEvtHandler();
    getAllTeamRegistrationsForCompetition();
});

function saveButtonEvtHandler(){
    document.getElementById("save-team").addEventListener("click", function(){
        
        // Obtener el token CSRF del meta tag en el documento
        

        let category1 = document.querySelector('[name="category1"]').value;

        let category2 = document.getElementsByName('category2');
        let category2Selected;

        category2.forEach(function(option) {
            if (option.checked) category2Selected = option.value;
        });

        let teamMembers = [];
        let teamMembersInputs = document.getElementsByName("teamMembers[]");   
        teamMembersInputs.forEach(input => {
            teamMembers.push(input.value)
        });
        teamMembers = teamMembers.join(",")

        let substitutes = document.querySelector("[name='substitutes']").value;
        console.log(typeof(teamMembers));
        console.log(teamMembers);

        //TODO : VALIDAR
        if(valido = true){
            sendData(token, competition_id, teamName, category1, category2Selected, teamMembers, substitutes);
        } else{
            // CACA
        }
    });
    
}

function sendData(token, competition_id, teamName, category1, category2, teamMembers, substitutes, _id = null){
    let formData = new FormData();

    formData.append('_token', token);
    formData.append('competition_id', competition_id);
    formData.append('teamName', teamName);
    formData.append('category1', category1);
    formData.append('category2', category2);
    formData.append('teamMembers', teamMembers);
    formData.append('substitutes', substitutes);
    if(_id) formData.append('_id', _id);


    fetch('/api/competitions/join', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.ok){
            if(data.edit == false){
                generateNewRegistrationComponent(data._id.$oid, category1+category2, true);
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

function generateNewRegistrationComponent(_id, category, sendAlert = false){
    let dataContainer = document.getElementById("data-container");
    
    let component = document.createElement("div");
    component.classList.add("competition-registration-component");
    component.id = _id;
    let insideElement = document.createElement("p")
    insideElement.innerHTML = category;
    component.appendChild(insideElement);
    
    dataContainer.appendChild(component);
}

function getAllTeamRegistrationsForCompetition(){
    let formData = new FormData();
    formData.append('_token', token);
    formData.append('competition_id', competition_id);
    formData.append('teamName', teamName);

    fetch('/api/competitions/getCompetitionsFromTeam', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(registration => {
            generateNewRegistrationComponent(registration._id, registration.category, false)
        });
    })
    .catch(error => console.error('Error:', error));
}