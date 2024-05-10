$('#signup-form').submit(function(e) {
    e.preventDefault();
    $('#Sign-in').attr('disabled', true).html('Signing Up...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'ajax.php?action=register',
        method: 'POST',
        data: $(this).serialize(),
        error: function(err) {
            console.log(err);
            $('#Sign-in').removeAttr('disabled').html('Sign Up');
        },
        success: function(resp) {
            if (resp.trim() == '1') { // Changed to check if the response is '1'
                // Redirect to login page or display success message
                window.location.href = 'login.php'; // Redirect to login page
            } else if (resp.trim() == '2') { // Check if response is '2' for existing username
                $('#signup-form').prepend('<div class="alert alert-danger">Username already exists. Please choose another username.</div>');
                $('#Sign-in').removeAttr('disabled').html('Sign Up');
            } else { // If response is neither '1' nor '2', display generic error message
                $('#signup-form').prepend('<div class="alert alert-danger">Registration failed. Please try again.</div>');
                $('#Sign-in').removeAttr('disabled').html('Sign Up');
            }
        }
    });
});
