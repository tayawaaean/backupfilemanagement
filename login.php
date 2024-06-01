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
  				<img src= "./assets/img/4.png">
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
							<input type="text" id="username2" name="username2" required>
							<span>Username</span>
						</div>

						<div class="form-group">
							<input type="text" id="email" name="email" required>
							<span>Email</span>
						</div>

						<div class="form-group">
							<input type="password" id="password2" name="password2" required>
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
						<a class= "forgotpass" href="login.php">Login</a>
					</div>
  				</div>

				<!-- Forgot Password-->
				<div class="card-body forgot-pass" id= "forgot-pass-section">
					<div class= "logo-container">
						<img src= "./assets/img/BNHS Logo.png" width= 150 height=150>
						<div class="text">
							<p id='bold_2'>Reset Password</p>
							<small>Fill up the form to reset your password</small>
						</div>
					</div>

					<form id="forgot-pass-form">

						<div class="form-group">
							<input type="text" id="username2" name="username2" required>
							<span>Username</span>
						</div>

						<div class="form-group">
							<input type="text" id="username3" name="username3" required>
							<span>Email</span>
						</div>

						<div class="form-group">
							<input type="text" id="otp" name="otp" required>
							<span>Verification Number</span>
							<button type="button" class="otp-button" >Send</button>
						</div>

						<div class="form-group">
							<input type="password" id="password3" name="password3" required>
							<span>New Password</span>
						</div>

						<div class="form-group">
							<input type="password" id="password2" name="password2" required>
							<span>Confirm Password</span>
						</div>

						<div class="center-button">
							<button class="btn-sm col-md-12" id="submit-pass" type="submit">Reset Password</button>
						</div>
					</form>

					<div class="forgot">
						<text>Remembered your password?&nbsp</text>
						<a class= "forgotpass" href="login.php">Login</a>
					</div>
  				</div>
  			</div>
  		</div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

</body>

<script src= "./js/login.js"></script>
<script>
$('#forgot-pass-form').submit(function(e) {
	console.log('submitting resets');
    e.preventDefault();
    $('#submit-pass').attr('disabled', true).html('Resetting Password...');
    if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
    $.ajax({
        url: 'forgot_password.php',
        method: 'POST',
        data: $(this).serialize(),
		dataType: 'json',
        error: function(err) {
            console.log(err);
            $('#submit-pass').removeAttr('disabled').html('Reset Password');
        },
        success: function(resp) {
            if (resp.status == 'success') { // Success case
                // Display success message or redirect to login page
                alert('Password reset successful. Please login with your new password.');
                window.location.href = 'login.php'; // Redirect to login page
            } else if (resp.status == 'error') { // Failure case
                // Display error message
				
                $('#forgot-pass-form').prepend('<div class="alert alert-danger">'+resp.message+'</div>');
                $('#submit-pass').removeAttr('disabled').html('Reset Password');
            }
        }
    });
});

$('.otp-button').click(function(e) {
	// Implement OTP generation and sending logic here
	$.ajax({
		url: 'send_otp.php',
		method: 'POST',
		data: $('#forgot-pass-form').serialize(),
		dataType: 'json',
		success: function(d) {
			if (d.status == '1') { // Success case
				// Display success message or redirect to login page
				alert('OTP sent successfully!');
				startCountdown(); // Start the countdown timer
			} else if (d.status == '0') { // Failure case
				// Display error message
				alert(d.message);
			} else {
				// Handle other response cases
				alert('An error occurred. Please try again later.');
			}
		},error: function(err) {
			console.log(err);
			console.log(err.responseText);
		}
	});
});

$(document).ready(function() {
    $('#signup-form').submit(function(e) {
        e.preventDefault();
        $('#Sign-in').attr('disabled', true).html('Signing Up...');

        $.ajax({
            url: 'register.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json', // Specify JSON response type
            error: function(err) {
                console.log(err);
                $('#Sign-in').removeAttr('disabled').html('Sign Up');
                var errorAlert = $('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                $('#signup-form').prepend(errorAlert);
                setTimeout(function() {
                    errorAlert.remove();
                }, 2000);
            },
            success: function(resp) {
                $('#Sign-in').removeAttr('disabled').html('Sign Up');
                if (resp.status === 'success') {
                    // Display success message and redirect
                    var successAlert = $('<div class="alert alert-success">You are now registered. Please wait for approval.</div>');
                    $('#signup-form').prepend(successAlert);
                    setTimeout(function() {
                        successAlert.remove();
                        window.location.href = 'login.php';
                    }, 2000);
                } else if (resp.status === 'username_exists') {
                    // Display username exists error
                    var usernameExistsAlert = $('<div class="alert alert-danger">Username already exists. Please choose a different username.</div>');
                    $('#signup-form').prepend(usernameExistsAlert);
                    setTimeout(function() {
                        usernameExistsAlert.remove();
                    }, 2000);
                } else if (resp.status === 'password_mismatch') {
                    // Display password mismatch error
                    var passwordMismatchAlert = $('<div class="alert alert-danger">Password and confirm password do not match.</div>');
                    $('#signup-form').prepend(passwordMismatchAlert);
                    setTimeout(function() {
                        passwordMismatchAlert.remove();
                    }, 2000);
                } else {
                    // Handle other error messages
                    var errorAlert = $('<div class="alert alert-danger">' + resp.message + '</div>');
                    $('#signup-form').prepend(errorAlert);
                    setTimeout(function() {
                        errorAlert.remove();
                    }, 2000);
                }
            }
        });
    });
});



</script>
</html>