<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Bingao National High School</title>
  <link rel="stylesheet" href= "./css/login.css">
  <link rel="icon" href="./assets/img/BNHS Logo.png">
 	

	<?php include('./header.php'); ?>

	<?php 
		session_start();
	
		if(isset($_SESSION['login_id']))
		header("location:index.php?page=home");
	?>

</head>

<body>
  <main id="main" class=" alert-info">
  		<div id="login-left">
  			<div class="logo">
  				<i class="fa fa-share-alt"></i>
  			</div>
  		</div>
  		<div id="login-right">
  			<div class="card col-md-8 container-card">
				<!-- Login -->
  				<div class="card-body" id= "login-section">
					<div class= "logo-container">
						<img src= "./assets/img/BNHS Logo.png" width= 150 height=150>
						<div class="text">
							<p>Hello,</p>
							<p id='bold'>Welcome!</p>
							<small>Log in to your account to continue</small>
						</div>
					</div>

  					<form id="login-form" >

  						<div class="form-group">
  							<input type="text" id="username" name="username" required>
							<span>Username</span>
  						</div>
  						<div class="form-group">
  							<input type="password" id="password" name="password" required>
							  <span>Password</span>
  						</div>
						<div class="center-button">
							<button class="btn-sm col-md-6" id= "Login">Login</button>
							<button class="btn-sm col-md-6" id= "Signup" type="button">Signup</button>
						</div>
  					</form>

					<div class="forgot">
						<button class= "btn-sm forgotpass" id= "forgotpass" >Forgot Password</button>
					</div>
  				</div>

				<!-- Signup -->
				<div class="card-body signup" id= "signup-section">
					<div class= "logo-container">
						<img src= "./assets/img/BNHS Logo.png" width= 150 height=150>
						<div class="text">
							<p id='bold'>Sign Up</p>
							<small>Create your Account to continue</small>
						</div>
					</div>

					<form id="signup-form">
				<div class="form-group">
					<input type="text" id="name" name="name" required>
					<span>Name</span>
				</div>

				<div class="form-group">
					<input type="text" id="username" name="username" required>
					<span>Username</span>
				</div>

				<div class="form-group">
					<input type="password" id="password" name="password" required>
					<span>Password</span>
				</div>

				<div class="form-group">
					<input type="password" id="confirm_password" name="confirm_password" required>
					<span>Confirm Password</span>
				</div>

				<div class="center-button">
					<button class="btn-sm col-md-12" id="Sign-in" type="submit">Sign Up</button>
				</div>
			</form>

					<div class="forgot">
						<text>Already have an account?&nbsp</text>
						<a class= "forgotpass" href="login.php">Login<a/>
					</div>
  				</div>
  			</div>
  		</div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>

<script src= "./js/login.js"></script>
<script>
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

</script>

</html>