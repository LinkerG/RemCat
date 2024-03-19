window.addEventListener("load", function(){
    scrollOnCompetition();
});

function scrollOnCompetition(){
    let competitionScroll = document.getElementById("competitionScroll");
    competitionScroll.addEventListener("wheel", function(e) {
        e.preventDefault();
        this.scrollLeft += (e.deltaY * 3);
    });
}