let tokenInput;
window.addEventListener("load", function(){
    tokenInput = document.querySelector('input[name="_token"]');
    //formEvent();
    loginEvent();
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
        <label for="email">Email</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
        <label for="name">`+currentDictionary['password']+`</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <button type="button" id="login-submit-button" class="btn btn-primary">Log in</button>
    <hr>
    <p class="align-center">or</p>
    <hr>
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
        <label for="name" id="nameLabel">`+currentDictionary['fullName']+`</label>
        <div class="invalid-feedback ms-2">Por favor rellena correctamente este campo</div>
    </div>
    <div class="input-group input-group-lg  mb-3">
        <div class="input-group-text">
            <input type="checkbox" name="isTeam" id="isTeamCheck">
        </div>
        <input type="text" class="form-control" value="`+currentDictionary['isTeam']+`" disabled >
    </div>
    <div class="mb-3">
        <label for="image-user" class="form-label ms-2 mt-2">`+currentDictionary['photo']+`</label>
        <input class="form-control" type="file" id="image-user" name="image-user">
    </div>
    <button type="button" id="switch-button" class="btn btn-primary">Back to Login</button>
    <button type="button" id="submit-button" class="btn btn-primary">Register</button>
`;

function loginEvent(){
    let form = document.getElementsByTagName("form")[0];
    emailInput = document.getElementById("email");
    loginButton = document.getElementById("login-submit-button");
    let passwordInput = document.getElementById("password");
    loginButton.addEventListener("click", function(){
        if(validateEmail(emailInput.value) && validateNonEmptyText(passwordInput.value)){
            emailInput.classList.remove("formInvalid")
            emailInput.parentElement.querySelector(".invalid-feedback").style.display = "none"
            passwordInput.classList.remove("formInvalid")
            passwordInput.parentElement.querySelector(".invalid-feedback").style.display = "none"

            let formData = new FormData();
            formData.append('email', emailInput.value);
            formData.append('password', passwordInput.value);
            // Obtener el token CSRF del meta tag en el documento
            let token = document.head.querySelector('meta[name="csrf-token"]').content;
            // Agregar el token CSRF a los datos del formulario
            formData.append('_token', token);
            loginButton.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;
            fetch("/api/matchEmail", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Hubo un problema al realizar la solicitud.');
                }
                return response.json();
            })
            .then(response => {
                if(response.exists && response.valid){
                    if(response.isUser){
                        form.action = "/" + lang + "/userLogin";
                    } else {
                        form.action = "/" + lang + "/teamLogin";
                    }
                    form.submit();
                } else {
                    console.log("Preguntar si lleva a registro");
                    let parent = loginButton.parentElement;
                    loginButton.remove();
                    let question = `
                    <p>Este correo no tiene ninguna cuenta asociada, crear cuenta?</p>
                    <button id="no-signup">No</button>
                    <button id="yes-signup">Si</button>
                    `
                    parent.innerHTML += question;
                    yesnoButtonEvents();
                }
            })
            .catch(error => {
                console.error(error)
            })
        } else {
            emailInput.classList.add("formInvalid")
            emailInput.parentElement.querySelector(".invalid-feedback").style.display = "block"
            passwordInput.classList.add("formInvalid")
            passwordInput.parentElement.querySelector(".invalid-feedback").style.display = "block"
        }
    })
}

function signupEvent(){
    let form = document.getElementsByTagName("form")[0];
    let isTeamCheck = document.getElementById("isTeamCheck");
    if(isTeamCheck) {
        isTeamCheck.addEventListener("change", function(){
            let nameLabel = document.getElementById("nameLabel")
            if (isTeamCheck.checked) {
                nameLabel.innerHTML = currentDictionary['teamName'];
                form.action = "/"+lang+"/register/team"
            } else {
                nameLabel.innerHTML = currentDictionary['fullName'];
                form.action = "/"+lang+"/register/user"
            }
        });
    }
    let submit_button = document.getElementById("submit-button");
    submit_button.addEventListener("click", function(){
        form.submit()
    });
}

function yesnoButtonEvents(){
    let noButton = document.getElementById("no-signup");
    let yesButton = document.getElementById("yes-signup");
    let form = document.getElementsByTagName("form")[0];
    noButton.addEventListener("click", function(){
        form.innerHTML = loginHtml;
        form.action = "/"+lang+"/login"
        form.appendChild(tokenInput);
        loginEvent();
    })

    yesButton.addEventListener("click", function(){
        form.innerHTML = signupHtml;
        form.action = "/"+lang+"/register/user"
        form.appendChild(tokenInput);
        signupEvent();
    })
}

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

function validateEmail(email) {
    var regex = /^(?=.*\S).+@.+\..+$/;

    return regex.test(email);
}

function validateNonEmptyText(string) {
    let regex = /^[\S]+.*[\S]+$/;

    return regex.test(string);
}