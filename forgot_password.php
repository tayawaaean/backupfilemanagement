<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin | Blog Site</title>
    
<?php include('./header.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>

</head>
<style>
    body{
        width: 100%;
        height: calc(100%);
        /*background: #007bff;*/
    }
    main#main{
        width:100%;
        height: calc(100%);
        background:white;
    }
    #login-right{
        position: absolute;
        right:0;
        width:40%;
        height: calc(100%);
        background:white;
        display: flex;
        align-items: center;
    }
    #login-left{
        position: absolute;
        left:0;
        width:60%;
        height: calc(100%);
        background:#00000061;
        display: flex;
        align-items: center;
    }
    #login-right .card{
        margin: auto
    }
    .logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.8em;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<body>


  <main id="main" class=" alert-info">
        <div id="login-left">
            <div class="logo">
                <i class="fa fa-share-alt"></i>
            </div>
        </div>
        <div id="login-right">
            <div class="card col-md-8">
                <div class="card-body">
                    <form id="forgot-password-form" >
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="new_password" class="control-label">New Password</label>
                            <input type="password" id="new_password" name="new_password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_new_password" class="control-label">Confirm New Password</label>
                            <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control">
                        </div>
                        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Reset Password</button></center>
                    </form>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="login.php" class="btn btn-link">Remembered your password? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
    $('#forgot-password-form').submit(function(e){
        e.preventDefault()
        $('#forgot-password-form button[type="button"]').attr('disabled',true).html('Resetting Password...');
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
                    $('#forgot-password-form').prepend('<div class="alert alert-danger">Password reset failed. Please try again.</div>')
                    $('#forgot-password-form button[type="button"]').removeAttr('disabled').html('Reset Password');
                }
            }
        })
    })
</script>    
</html>
