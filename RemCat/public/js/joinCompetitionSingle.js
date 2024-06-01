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
            onCancel: function(data) {

            },
            onApprove: function(data, actions) {
                actions.order.capture().then(function(details) {
                    purchaseConfirmed = true;
                    paypalButtonContainer.style.display = "none";
                    paypalButtonAdded = false;
                    purchaseError.innerText = "";
                    purchaseError.style.display = "none";
                    document.getElementById("purchaseSuccess").innerText = "Se ha realizado el pago con éxito!";
                    document.getElementById("purchaseSuccess").style.display = "block";
                    insuranceSelect.disabled = true;
                });
            }
        }).render('#paypal-btn');

        paypalButtonContainer.style.display = "block";
        paypalButtonAdded = true;
    });

    submitButton.addEventListener("click", function(event) {
        let insuranceSelect = document.getElementById('insuranceSelect');
        if (insuranceSelect.selectedIndex === 0 || !purchaseConfirmed) {
            event.preventDefault();
            if (insuranceSelect.selectedIndex === 0) {
                document.getElementById("purchaseError").innerText = "Tienes que elegir una aseguradora.";
                document.getElementById("purchaseError").style.display = "block";
            } else if (!purchaseConfirmed) {
                document.getElementById("purchaseError").innerText = "Tienes que realizar el pago antes de poder continuar.";
                document.getElementById("purchaseError").style.display = "block";
            }
        } else {
            document.getElementById("purchaseError").style.display = "none";
            document.getElementById('joinSingleForm').submit();
        }
    });
});
