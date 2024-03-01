window.addEventListener('load', function () {
    document.getElementById("lang-en").addEventListener("click", function(){
        // Cambiar el idioma a ingles
        changeLang('en');
    })
    document.getElementById("lang-es").addEventListener("click", function(){
        // Cambiar el idioma a español
        changeLang('es');
    })
    document.getElementById("lang-ca").addEventListener("click", function(){
        // Cambiar el idioma a catalan
        changeLang('ca');
    })
});

function changeLang(lang) {
    let pathname = window.location.pathname;
    let newPathname;
    if(pathname === "/") {
        newPathname = pathname + lang;
    } else {
        newPathname = pathname.replace(/\/(ca|en|es)/, "/"+lang);
    }
    console.log(newPathname);
    window.location = newPathname;
}