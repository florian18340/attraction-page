jQuery(document).ready(function($) {
    $('#attraction-contact-form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formMessages = $('#form-messages');

        $.ajax({
            type: 'POST',
            url: window.location.href,
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                formMessages.empty();
                if (response.success) {
                    formMessages.html('<p class="success">' + response.data + '</p>');
                    form[0].reset();
                } else {
                    formMessages.html('<p class="error">' + response.data + '</p>');
                }
            },
            error: function() {
                formMessages.html('<p class="error">Une erreur est survenue. Veuillez réessayer.</p>');
            }
        });
    });
});
