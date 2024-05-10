$('#login-form').submit(function(e){
    e.preventDefault()

    $('#Login').attr('disabled',true).html('Logging in...');
    if($(this).find('.alert-danger').length > 0 )
        $(this).find('.alert-danger').remove();
    $.ajax({
        url:'ajax.php?action=login',
        method:'POST',
        data:$(this).serialize(),
        error:err=>{
            console.log(err)
    $('#Login').removeAttr('disabled').html('Login');

        },
        success:function(resp){
            if(resp == 1){
                location.reload('index.php?page=home');
            }else{
                $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
                $('#Login').removeAttr('disabled').html('Login');
            }
        }
    })
})

// JavaScript code to handle the signup button click event
document.getElementById("Signup").addEventListener("click", function() {
    document.getElementById("login-section").style.display = "none";
    document.getElementById("signup-section").style.display = "block";
});

document.getElementById("forgotpass").addEventListener("click", function() {
    document.getElementById("login-section").style.display = "none";
    document.getElementById("forgot-pass-section").style.display = "block";
});
