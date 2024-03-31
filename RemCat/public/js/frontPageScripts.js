window.addEventListener("load", function(){
    //scrollOnCompetition();
    document.getElementsByTagName("header")[0].classList.add("hidden");
    document.getElementsByTagName("header")[0].style.position = "fixed";
    headerOnScroll();
});

function scrollOnCompetition(){
    let competitionScroll = document.getElementById("competitionScroll");
    competitionScroll.addEventListener("wheel", function(e) {
        e.preventDefault();
        this.scrollLeft += (e.deltaY * 3);
    });
}

function headerOnScroll(){
    let lastScrollTop = 0;
    let header = document.getElementsByTagName("header")[0];
    window.addEventListener("scroll", function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScroll > lastScrollTop && currentScroll > 0) {
            // Hacer scroll hacia abajo y no está en la parte superior de la página
            header.classList.remove("hidden");
        } else if (currentScroll <= 0){
            // Hacer scroll hacia arriba o está en la parte superior de la página
            header.classList.add("hidden");
        }
    
        lastScrollTop = currentScroll;
    });
}
