document.addEventListener("DOMContentLoaded", function() {
    let paypalButtonAdded = false;
    let purchaseConfirmed = false;

    let insuranceSelect = document.getElementById('insuranceSelect');
    let paypalButtonContainer = document.getElementById('paypal-btn-container');
    let submitButton = document.getElementById('submit-button');
    let purchaseError = document.getElementById("purchaseError");

    insuranceSelect.addEventListener('change', function() {
        let selectedOption = insuranceSelect.options[insuranceSelect.selectedIndex];
        let price = selectedOption.getAttribute('data-price');

        if (paypalButtonAdded) {
            let paypalBtn = document.getElementById('paypal-btn');
            let paypalBtnContainer = document.getElementById('paypal-btn-container');
            paypalBtnContainer.style.display = "none";
            paypalBtn.innerHTML = '';
            paypalButtonAdded = false;
        }

        paypal.Buttons({
            style: {
                color: 'blue',
                shape: 'pill',
                label: 'pay',
                layout: 'horizontal',
                tagline: false
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: price
                        }
                    }]
                });
            },
            onCancel: function(data) {},
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    console.log('Payment approved and captured');
                    purchaseConfirmed = true;
                    paypalButtonContainer.style.display = "none";
                    paypalButtonAdded = false;
                    purchaseError.innerText = "";
                    purchaseError.style.display = "none";
                    document.getElementById("purchaseSuccess").innerText = "Se ha realizado el pago con éxito!";
                    document.getElementById("purchaseSuccess").style.display = "block";
                    insuranceSelect.disabled = true;
                    console.log('purchaseConfirmed set to true');
                }).catch(function(err) {
                    console.error('Error al capturar el pago:', err);
                    purchaseConfirmed = false;
                    console.log('purchaseConfirmed set to false due to capture error');
                });
            },
            onError: function(err) {
                console.error('Error en el proceso de pago:', err);
                purchaseConfirmed = false;
                console.log('purchaseConfirmed set to false due to payment error');
            }
        }).render('#paypal-btn');

        paypalButtonContainer.style.display = "block";
        paypalButtonAdded = true;
    });

    function validateForm() {
        let categorySelect = document.querySelector('select[name="category1"]');
        let genderRadio = document.querySelector('input[name="category2"]:checked');
        let teamMembersInputs = [
            document.getElementById('participante1'),
            document.getElementById('participante3'),
            document.getElementById('participante4'),
            document.getElementById('participante7'),
            document.getElementById('participante8')
        ];
        let substitutesInput = document.getElementById('participante10');
        let valid = true;

        function showError(input, message) {
            input.classList.add("is-invalid");
            let errorElement = input.nextElementSibling;
            if (!errorElement || !errorElement.classList.contains('invalid-feedback')) {
                errorElement = document.createElement('div');
                errorElement.classList.add('invalid-feedback');
                input.parentNode.insertBefore(errorElement, input.nextSibling);
            }
            errorElement.innerText = message;
        }

        function removeError(input) {
            input.classList.remove("is-invalid");
            let errorElement = input.nextElementSibling;
            if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                errorElement.remove();
            }
        }

        if (categorySelect.selectedIndex === 0) {
            valid = false;
            showError(categorySelect, "Tienes que seleccionar una categoría.");
        } else {
            removeError(categorySelect);
        }

        if (!genderRadio) {
            valid = false;
            showError(document.querySelector('input[name="category2"]'), "Tienes que elegir Masculino o Femenino.");
        } else {
            removeError(document.querySelector('input[name="category2"]'));
        }

        let nameRegex = /^[a-zA-Z]+( [a-zA-Z]+)*$/;
        teamMembersInputs.forEach(input => {
            if (!nameRegex.test(input.value.trim())) {
                valid = false;
                showError(input, "Debe contener solo letras y cada palabra separada por un espacio.");
            } else {
                removeError(input);
            }
        });

        let substitutes = substitutesInput.value.split(',');
        substitutes.forEach(name => {
            if (!nameRegex.test(name.trim())) {
                valid = false;
                showError(substitutesInput, "Los nombres deben estar separados por comas y contener solo letras.");
            } else {
                removeError(substitutesInput);
            }
        });

        return valid;
    }

    submitButton.addEventListener("click", function(event) {
        console.log('Submit button clicked');
        if (insuranceSelect.selectedIndex === 0 || !purchaseConfirmed || !validateForm()) {
            event.preventDefault();
            if (insuranceSelect.selectedIndex === 0) {
                document.getElementById("purchaseError").innerText = "Tienes que elegir una aseguradora.";
                document.getElementById("purchaseError").style.display = "block";
            } else if (!purchaseConfirmed) {
                document.getElementById("purchaseError").innerText = "Tienes que realizar el pago antes de poder continuar.";
                document.getElementById("purchaseError").style.display = "block";
            }
            console.log('Form validation failed or payment not confirmed');
        } else {
            document.getElementById("purchaseError").style.display = "none";
            console.log('Form validation passed and payment confirmed');
            document.getElementById('joinSingleForm').submit();
        }
    });
});
