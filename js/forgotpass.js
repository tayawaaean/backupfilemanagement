$('#forgot-pass-form').submit(function(e){
    e.preventDefault()
    $('#forgot-pass-form button[type="button"]').attr('disabled',true).html('Resetting Password...');
    if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
    $.ajax({
        url:'ajax.php?action=forgot_password',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
            console.log(err)
    $('#forgot-password-form button[type="button"]').removeAttr('disabled').html('Reset Password');

        },
        success:function(resp){
            if(resp == 1){
                // Password reset successful, redirect or show success message
                // For now, just refresh the page
                location.reload();
            }else{
                $('#forgot-pass-form').prepend('<div class="alert alert-danger">Password reset failed. Please try again.</div>')
                $('#forgot-pass-form button[type="button"]').removeAttr('disabled').html('Reset Password');
            }
        }
    })
})