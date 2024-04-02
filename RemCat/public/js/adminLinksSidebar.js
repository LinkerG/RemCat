$(document).ready(function() {
    $('.nav_link').click(function(event) {
        event.preventDefault();
        
        var page = $(this).data('page');
        
        $.ajax({
            url: '{{ $route }}admin/' + page,
            method: 'GET',
            success: function(response, status, xhr) {
                if (xhr.status === 200) {
                    $('#main-content').html(response);
                } else {
                    console.error('Error: Unexpected response status', xhr.status);
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400) {
                    console.error('Error:', error);
                } else {
                    console.error('Error: Unexpected error status', xhr.status);
                }
            }
        });
    });
});
