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
                    <form id="register-form" >
                        <div class="form-group">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="control-label">Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                        </div>
                        <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Register</button></center>
                    </form>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="login.php" class="btn btn-link">Already have an account? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
    $('#register-form').submit(function(e){
        e.preventDefault()
        $('#register-form button[type="button"]').attr('disabled',true).html('Registering...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'ajax.php?action=register',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
        $('#register-form button[type="button"]').removeAttr('disabled').html('Register');

            },
            success:function(resp){
                if(resp == 1){
                    location.reload('login.php');
                }else{
                    $('#register-form').prepend('<div class="alert alert-danger">Registration failed. Please try again.</div>')
                    $('#register-form button[type="button"]').removeAttr('disabled').html('Register');
                }
            }
        })
    })
</script>    
</html>
