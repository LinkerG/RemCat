window.addEventListener("load", function(){
    let form = document.getElementsByTagName("form")[0];
    let submitButton = document.getElementById("submit-button")
    let inputs = form.getElementsByTagName("input");

    submitButton.addEventListener("click", function(){
        let errors = [];
        for (let i = 0; i < inputs.length; i++) {
            const input = inputs[i];
            switch (input.name) {
                case "cif":
                    if(!validateCif(input.value)) {
                        console.log(input.value);
                        errors.push("cif");
                        //input.classList.add("formInvalid")
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "block"
                    } else {
                        //input.classList.remove("formInvalid")
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "none"
                    }
                    break;
                case "name":
                case "address":
                    console.log(input.value);
                    if(!validateNonEmptyText(input.value)) {
                        errors.push("empty");
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "block"
                    } else {
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "none"
                    }
                    break;
                case "email":
                    if(!validateEmail(input.value)) {
                        errors.push("email");
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "block"
                    } else {
                        //input.parentElement.querySelector(".invalid-feedback").style.display = "none"
                    }
                    break;
                case "password":
                    //añadir
                    break;
                default:
                    break;
            }
        }
        console.log(errors);
        if(errors.length === 0) form.submit();
        else form.classList.add("was-validated")
    });
})

function validateCif(cif){
    // Regular expression to check CIF format
    let cifRegex = /^[A-HJNPQRSUVW]{1}[0-9]{7}[0-9A-J]$/;

    // Check if CIF matches the regular expression
    if (!cifRegex.test(cif)) {
        return false; // CIF format is incorrect
    }

    // Separate the CIF into its components
    let letters = cif.substr(0, 1);
    let digits = cif.substr(1, 7);
    let controlDigit = cif.substr(8, 1);

    // Calculate control digit
    let sum = 0;
    for (let i = 0; i < digits.length; i++) {
        let digit = parseInt(digits[i]);
        if (i % 2 === 0) {
            digit *= 2;
            if (digit > 9) {
                digit -= 9;
            }
        }
        sum += digit;
    }
    let calculatedControlDigit = (10 - (sum % 10)) % 10;

    let result
    // Validate control digit
    if (calculatedControlDigit !== parseInt(controlDigit)) {
        result = false; // Control digit is incorrect
    }

    result = true; // CIF is valid
    return result;
}

function validateNonEmptyText(string) {
    let regex = /^[\S]+.*[\S]+$/;

    return regex.test(string);
}

function validateEmail(email) {
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return emailRegex.test(email);
}