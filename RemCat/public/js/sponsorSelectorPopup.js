window.addEventListener("load", function(){
    const button = document.getElementById("openAddSponsors");
    const dismissModalElements = document.querySelectorAll('[data-bs-dismiss="modal"]');
    const addSponsorsButton = document.getElementById("addSponsorsToList")
    let modal = document.getElementById("sponsorList");
    let modalBody = modal.querySelector(".modal-body");
    let input = document.getElementById("sponsors-list");
    
    let sponsorsJson;
    button.addEventListener("click", function(){
        try {
            sponsorsJson = JSON.parse(input.value);
        } catch(error){
            sponsorsJson = JSON.parse("[]");
        }
        console.log(sponsorsJson);
        fetch('/api/sponsors/fetchAll')
        .then(response => {
            if (!response.ok) {
                throw new Error('Hubo un problema al realizar la solicitud.');
            }
            return response.json();
        })
        .then(data => {
            let spinner = modalBody.querySelector(".spinner-border");
            spinner.remove();

            let checkboxList = document.createElement("div");
            checkboxList.classList.add("container-fluid");
            
            data.forEach(sponsor => {
                console.log(sponsor);
                let listElement = document.createElement("div");
                listElement.classList.add("form-check");
                if(sponsorsJson.find(json => json._id === sponsor._id)){
                    console.log("encontrado");
                    listElement.innerHTML = "<input checked class='form-check-input' type='checkbox' value='" + JSON.stringify(sponsor) + "' name='sponsorCheck' id='" + sponsor._id + "'><label class='form-check-label' for='sponsorCheck'>" + sponsor.name + "</label>";
                } else {
                    listElement.innerHTML = "<input class='form-check-input' type='checkbox' value='" + JSON.stringify(sponsor) + "' name='sponsorCheck' id='" + sponsor._id + "'><label class='form-check-label' for='sponsorCheck'>" + sponsor.name + "</label>";
                }
                checkboxList.appendChild(listElement);
            });
            modalBody.appendChild(checkboxList);

        })
        .catch(error => {
            console.error('Error:', error);
        });

    })

    dismissModalElements.forEach(closeBtn => {
        closeBtn.addEventListener("click", function(){
            modalBody.innerHTML = "<div class='spinner-border'></div>";
        });
    });

    addSponsorsButton.addEventListener("click", function(){
        let checkedBoxes = modalBody.querySelectorAll('input[type="checkbox"]:checked');
        sponsorsJson = JSON.parse("[]");
        checkedBoxes.forEach(input => {
            let sponsor = JSON.parse(input.value);
            sponsorsJson.push(sponsor)
        });
        input.value = JSON.stringify(sponsorsJson);
        dismissModalElements[0].click();
    });
})