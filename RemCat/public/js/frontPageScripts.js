window.addEventListener("load", function(){
    scrollOnCompetition();

    document.getElementsByTagName("header")[0].classList.add("hidden");
    headerOnScroll();
    
    heroSectionScroll();
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
    
        if (currentScroll > lastScrollTop && currentScroll > header.offsetHeight) {
            // Hacer scroll hacia abajo y no está en la parte superior de la página
            header.classList.remove("hidden");
        } else {
            // Hacer scroll hacia arriba o está en la parte superior de la página
            header.classList.add("hidden");
        }
    
        lastScrollTop = currentScroll;
    });
}
