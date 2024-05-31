var qrContainer;
window.addEventListener("load", () => {
    qrContainer = document.getElementById("qr-container");
    const data = JSON.parse(qrContainer.dataset.competitions);
    console.log(data);

    generateQR(data);
});

function generateQR(competitions) {
    competitions.forEach(competition => {
        const div = document.createElement("div");
        const img = document.createElement("img");
        const p = document.createElement("p");

        const url = `http://${window.location.hostname}:${window.location.port}/validateTime/${competition._id}`; // Define la URL según tus necesidades

        QRCode.toDataURL(url, function (err, url) {
            if (err) {
                console.error(err);
                return;
            }
            img.src = url;
            div.appendChild(img);

            // Añadir la categoría de la competición
            p.textContent = competition.category;
            div.appendChild(p);

            qrContainer.appendChild(div);
        });
    });
}