let tokenInput;
window.addEventListener("load", function(){
    tokenInput = document.querySelector('input[name="_token"]');
    console.log(tokenInput);
    formEvent();
});

const lang = document.querySelector("html").getAttribute("lang");
const dictionary = {
    "es": {
      "fullName": "Nombre completo",
      "teamName": "Nombre del equipo",
      "password": "Contraseña",
      "photo": "Foto",
      "isTeam": "Equipo federado",
    },
    "ca": {
      "fullName": "Nom complet",
      "teamName": "Nom del equip",
      "password": "Contrasenya",
      "photo": "Foto",
      "isTeam": "Equip federeat",
    },
    "en": {
      "fullName": "Full name",
      "teamName": "Team name",
      "password": "Password",
      "photo": "Photo",
      "isTeam": "Federated team",
    }
}

const currentDictionary = dictionary[lang];
  
const loginHtml = `
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required>
        <label for="name">Email</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
        <label for="name">`+currentDictionary['password']+`</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>

    <button type="button" id="submit-button" class="btn btn-primary">Log in</button>
    <button type="button" id="switch-button" class="btn btn-primary">Sign up</button>
`;

const signupHtml = `
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required>
        <label for="email">Email</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
        <label for="password">`+currentDictionary['password']+`</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
        <label for="name">`+currentDictionary['fullName']+`</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="input-group input-group-lg  mb-3">
        <div class="input-group-text">
            <input type="checkbox" name="isTeam">
        </div>
        <input type="text" class="form-control" value="`+currentDictionary['isTeam']+`" disabled >
    </div>
    <div class="mb-3">
        <label for="image-user" class="form-label ms-2 mt-2">`+currentDictionary['photo']+`</label>
        <input class="form-control" type="file" id="image-user" name="image-user">
    </div>
    <button type="button" id="submit-button" class="btn btn-primary">Sign up</button>
    <button type="button" id="switch-button" class="btn btn-primary">Log in</button>
`;



function formEvent(){
    let form = document.getElementsByTagName("form")[0];
    let switchButton = document.getElementById("switch-button");
    switchButton.addEventListener("click", function(){
        let action = form.action;
        let loginLabel = document.getElementsByClassName("loginLabel")[0];
        
        let pathname = window.location.href;
        console.log(pathname);
        if (action === pathname) {
            form.action = "/"+lang+"/signup"
            form.innerHTML = signupHtml;
            form.appendChild(tokenInput);
            formEvent();
            loginLabel.innerHTML = "Sign Up"
        } else {
            form.action = "/"+lang+"/login"
            form.innerHTML = loginHtml;
            form.appendChild(tokenInput);
            formEvent();
            loginLabel.innerHTML = "Log In"
        }

    })
}

