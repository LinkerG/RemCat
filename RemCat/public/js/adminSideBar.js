document.addEventListener("DOMContentLoaded", function(event) {
    const showNavbar = (toggleId, navId, bodyId, headerId, logoId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId),
        logo = document.getElementById(logoId);
        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd && logo){
            toggle.addEventListener('click', ()=>{
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')

                //const newImageId = nav.classList.contains('show') ? 'logo-img-expanded' : 'logo-img';
                logo.src = nav.classList.contains('show') ? imageUrl + '/logo-white.png' : imageUrl + '/logo-white-sin-texto.png';
                //logo.id = newImageId;
                logo.classList.toggle('expanded', nav.classList.contains('show'));
                logo.classList.toggle('collapsed', !nav.classList.contains('show'));
            });
        }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header','logo-img')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(event) {
        event.preventDefault(); // Evita la acción predeterminada del enlace (la redirección)
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        }
    }
    
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
     // Your code to run since DOM is loaded and ready
});