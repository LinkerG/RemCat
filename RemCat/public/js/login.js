let tokenInput;
let loginHtml; // Necesario para guardar el HTML del formulario de inicio de sesión
let paypalButtonAdded = false;

window.addEventListener("load", function(){
    tokenInput = document.querySelector('input[name="_token"]');
    loginHtml = document.getElementsByTagName("form")[0].innerHTML; // Guarda el HTML del formulario de inicio de sesión
    formEvent();
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

const signupHtml = `
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="email" name="email" placeholder="" value="" required>
        <label for="email">Email</label>
        <div class="invalid-feedback ms-2" id="emailError"></div>
    </div>
    <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password" placeholder="" value="" required>
        <label for="password">`+currentDictionary['password']+`</label>
        <div class="invalid-feedback ms-2" id="passwordError"></div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="name" name="name" placeholder="" value="" required>
        <label for="name" id="nameLabel">`+currentDictionary['fullName']+`</label>
        <div class="invalid-feedback ms-2" id="nameError"></div>
    </div>
    <div class="mb-3">
        <label for="image-user" class="form-label ms-2 mt-2">`+currentDictionary['photo']+`</label>
        <input class="form-control" type="file" id="image-user" name="image-user">
    </div> 
    <div class="input-group input-group-lg  mb-3">
        <div class="input-group-text">
            <input type="checkbox" name="isTeam" id="isTeamCheck">
        </div>
        <input type="text" class="form-control" value="`+currentDictionary['isTeam']+`" disabled >
    </div>
    <div id="paypal-btn-container"><div id="paypal-btn"></div></div>
    <div id="cancelPopup" class="cancel-popup">
        <div class="cancel-popup-content">
            <span class="cancel-popup-close" onclick="closeCancelPopup()">&times;</span>
            <p>El pago ha sido cancelado.</p>
        </div>
    </div>
    
    <button type="button" id="switch-button" class="btn btn-primary">Back to Login</button>
    <button type="button" id="submit-button" class="btn btn-primary">Register</button>
`;

function loginEvent(){
    loginButton = document.getElementById("login-submit-button");
    switchBtn = document.getElementById('switch-button')
    loginButton.addEventListener("click", function(){
        loginButton.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;
        switchBtn.disabled = true;
    })
}

function signupEvent(){
    let form = document.getElementsByTagName("form")[0];
    let isTeamCheck = document.getElementById("isTeamCheck");
    if(isTeamCheck) {
        isTeamCheck.addEventListener("change", function(){
            let nameLabel = document.getElementById("nameLabel")
            let paypalButtonContainer = document.getElementById("paypal-btn-container");
            if (isTeamCheck.checked) {
                nameLabel.innerHTML = currentDictionary['teamName'];
                form.action = "/"+lang+"/register/team"
                if (!paypalButtonAdded) {
                    paypal.Buttons({
                        style:{
                            color: 'blue',
                            shape: 'pill',
                            label: 'pay',
                            layout: 'horizontal',
                            tagline: false  
                        },
                        createOrder: function(data,actions){
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: 100
                                    }
                                }]
                            });
                        },
                        onCancel: function(data) {
                            showCancelPopup();
                        },
                        onApprove: function(data,actions) {
                            actions.order.capture().then(function (details) {
                                console.log(details);
                            });
                        },
                    }).render('#paypal-btn')
                    paypalButtonAdded = true; 
                }
                paypalButtonContainer.style.display = "block";
            } else {
                nameLabel.innerHTML = currentDictionary['fullName'];
                form.action = "/"+lang+"/register/user"
                if (paypalButtonAdded) {
                    paypalBtn = document.getElementById('paypal-btn')
                    paypalButtonContainer.style.display = "none";
                    paypalBtn.innerHTML = '';
                    paypalButtonAdded = false; // Marcar que el botón de PayPal ha sido eliminado
                }
            }
        });
    }
    let submit_button = document.getElementById("submit-button");
    submit_button.addEventListener("click", function(){
        let emailInput = document.getElementById('email')
        let email = document.getElementById("email").value;
        let switchBtn = document.getElementById('switch-button')
        let fileInput = document.getElementById('image-user')
        let checkbox = document.getElementById('isTeamCheck')
        switchBtn.disabled = true;
        fileInput.disabled = true;
        checkbox.disabled = true;
        fetch(`/api/matchEmail/${email}`)
            .then(response => response.json())
            .then(data => {
                console.log(data.exists)
                if (data.exists) {
                    emailInput.classList.add("input-error");
                    document.getElementById("emailError").innerText = "Este correo ya esta registrado.";
                    document.getElementById("emailError").style.display = "block"; 
                    switchBtn.disabled = false;
                    fileInput.disabled = false;
                    checkbox.disabled = false;
                } else {
                    if(validateForm()) {
                        submit_button.innerHTML = `<span class="spinner-border spinner-border-sm"></span>`;
                        emailInput.classList.remove("input-error");
                        document.getElementById("emailError").innerText = "";
                        document.getElementById("emailError").style.display = "none";
                        form.submit();
                    } else {
                        switchBtn.disabled = false;
                        fileInput.disabled = false;
                        checkbox.disabled = false;
                    }
                }
            })
            .catch(error => {
                console.error('Error al verificar el correo electrónico:', error);
            });
    });
    let backToLoginBtn = document.getElementById('switch-button')
    let loginLabel = document.getElementsByClassName("loginLabel")[0];
    backToLoginBtn.addEventListener('click', function() {
        form.innerHTML = loginHtml; // Restaura el formulario de inicio de sesión
        form.action = "/"+lang+"/login"
        form.innerHTML = loginHtml;
        form.appendChild(tokenInput);
        formEvent(); // Configura los eventos del formulario de inicio de sesión
        loginLabel.innerHTML = "Log In"
        loginEvent()
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
            form.action = "/"+lang+"/register/user"
            form.innerHTML = signupHtml;
            form.appendChild(tokenInput);
            signupEvent(); // Configura los eventos del formulario de registro
            loginLabel.innerHTML = "Sign Up"
        } else {
            form.action = "/"+lang+"/login"
            form.innerHTML = loginHtml;
            form.appendChild(tokenInput);
            formEvent(); // Configura los eventos del formulario de inicio de sesión
            signupEvent();
            loginLabel.innerHTML = "Log In"
        }
    })
}
function validateForm() {
    let emailInput = document.getElementById("email");
    let passwordInput = document.getElementById("password");
    let nameInput = document.getElementById("name");

    let isValid = true;

    // Validación del correo electrónico
    if (!validateEmail(emailInput.value)) {
        emailInput.classList.add("input-error");
        document.getElementById("emailError").innerText = "Por favor, introduce una dirección de correo electrónico válida sin espacios.";
        document.getElementById("emailError").style.display = "block"; // Muestra el mensaje de error
        isValid = false;
    } else {
        emailInput.classList.remove("input-error");
        document.getElementById("emailError").innerText = "";
        document.getElementById("emailError").style.display = "none"; // Oculta el mensaje de error
    }

    // Validación de la contraseña
    if (!validatePassword(passwordInput.value)) {
        passwordInput.classList.add("input-error");
        document.getElementById("passwordError").innerText = "La contraseña no puede contener espacios.";
        document.getElementById("passwordError").style.display = "block"; // Muestra el mensaje de error
        isValid = false;
    } else {
        passwordInput.classList.remove("input-error");
        document.getElementById("passwordError").innerText = "";
        document.getElementById("passwordError").style.display = "none"; // Oculta el mensaje de error
    }

    // Validación del nombre
    if (!validateName(nameInput.value)) {
        nameInput.classList.add("input-error");
        document.getElementById("nameError").innerText = "El nombre debe contener solo letras y un espacio entre cada palabra.";
        document.getElementById("nameError").style.display = "block"; // Muestra el mensaje de error
        isValid = false;
    } else {
        nameInput.classList.remove("input-error");
        document.getElementById("nameError").innerText = "";
        document.getElementById("nameError").style.display = "none"; // Oculta el mensaje de error
    }

    return isValid;
}



function validateEmail(email) {
    // Expresión regular para validar el formato de correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.(com|cat)$/;
    return emailRegex.test(email);
}

function validatePassword(password) {
    // Verifica si la contraseña contiene espacios
    return !/\s/.test(password);
}

function validateName(name) {
    // Expresión regular para validar el nombre
    const nameRegex = /^[^\s][A-Za-z]+(?:\s[A-Za-z]+)*[^\s]$/;
    return nameRegex.test(name);
}
function showCancelPopup() {
    document.getElementById("cancelPopup").style.display = "block";
}

// Función para cerrar el popup de cancelación
function closeCancelPopup() {
    document.getElementById("cancelPopup").style.display = "none";
}