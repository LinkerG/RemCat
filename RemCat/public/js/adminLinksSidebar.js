const lang = document.querySelector("html").getAttribute("lang");
let iframe;
let button;
window.addEventListener("load", function(){
    iframe = document.getElementById("main-iframe");
    button = document.getElementById("add-button");
    initNavBarLinks();
});

function initNavBarLinks(){
    let links = document.getElementsByClassName("nav_link");
    for (let i = 0; i < links.length; i++) {
        let link = links[i];
        link.addEventListener("click", function(){
            let dataRoute = link.dataset.route;
            let route = "/" + lang + "/" + dataRoute;
            iframe.src = route;
            button.href = route + "/add"
        })
    }
}