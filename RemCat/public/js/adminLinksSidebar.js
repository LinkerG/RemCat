document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.nav_link');

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function(event) {
            event.preventDefault();

            var pathName = window.location.pathname;
            var page = this.getAttribute('data-page');
            var newPathName = pathName.replace(/dashboard/, "dynamic-content/" + page);

            fetch(newPathName)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(function(data) {
                    document.getElementById('main-content').innerHTML = data;
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    });
});