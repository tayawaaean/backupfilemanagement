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
							<input type="text" id="username2" name="username2" required>
							<span>Username</span>
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
							<input type="text" id="username3" name="username3" required>
							<span>Username</span>
						</div>

						<div class="form-group">
							<input type="password" id="password3" name="password3" required>
							<span>New Password</span>
						</div>

						<div class="form-group">
							<input type="password" id="confirm_password2" name="confirm_password2" required>
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
<script src= "./js/register.js"></script>
<script src= "./js/forgotpass.js"></script>
</html>