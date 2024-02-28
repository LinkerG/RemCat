window.addEventListener('load', function () {
    var dataText = ["Companyerisme", "Dedicació", "Compromís", "Disciplina", "Sacrifici", "Constància", "Esforç", "Respecte", "Esportivitat"];

    function typeWriter(text, i, fnCallback) {
        if (i < text.length) {
            document.querySelector(".selfWrittingText").innerHTML = text.substring(0, i + 1) + '<span aria-hidden="true"></span>';

            setTimeout(function () {
                typeWriter(text, i + 1, fnCallback)
            }, 300);
        } else if (typeof fnCallback == 'function') {
            setTimeout(fnCallback, 700);
        }
    }

    function StartTextAnimation(i) {
        if (i < dataText.length) {
            typeWriter(dataText[i], 0, function () {
                setTimeout(function () {
                    StartTextAnimation(i + 1);
                }, 1000); // Agregamos un retraso antes de pasar al siguiente texto
            });
        } else {
            // Si hemos llegado al final del array, reiniciamos la animación desde el principio
            setTimeout(function () {
                StartTextAnimation(0);
            }, 1000); // Agregamos un retraso antes de reiniciar
        }
    }

    StartTextAnimation(0);
});
