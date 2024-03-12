window.addEventListener("load", function(){
    formEvent();
});

function formEvent(){
    let form = document.getElementsByTagName("form")[0];
    let switchButton = document.getElementById("switch-button");
    let submitButton = document.getElementById("submit-button");
    switchButton.addEventListener("click", function(){
        let action = form.action;
        let lang = document.querySelector("html").getAttribute("lang");
        let pathname = window.location.href;
        console.log(pathname);
        if (action === pathname) {
            form.action = "/"+lang+"/signup"
            switchButton.innerHTML = "Log in"
            submitButton.innerHTML = "Sign up"
        } else {
            form.action = "/"+lang+"/login"
            switchButton.innerHTML = "Sign up"
            submitButton.innerHTML = "Log in"
        }

    })
}