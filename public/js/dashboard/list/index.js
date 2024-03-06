$(document).ready(function() {
    $('.input-search').on('keyup', function() {
        let query = $(this).val();

        $.ajax({
            url: '/list/search',
            type: 'GET',
            data: {'search': query},
            success: function(data) {
                $('tbody').html(data);
            }
        });
    });
});