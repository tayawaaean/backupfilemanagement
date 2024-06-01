$(document).ready(function() {
    $('#login-form').submit(function(e) {
      e.preventDefault();
      $('#Login').attr('disabled', true).html('Logging in...');

      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        success: function(resp) {
          $('#Login').removeAttr('disabled').html('Login');
          if (resp == 1) {
            // Login successful
            window.location.href = 'index.php?page=home';
          } else if (resp == 2) {
            // Incorrect password
            $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
          } else if (resp == 3) {
            // User not found
            $('#login-form').prepend('<div class="alert alert-danger">User not found. Please check your username.</div>');
          } else if (resp == 4) {
            // User not yet approved
            $('#login-form').prepend('<div class="alert alert-danger">Your account is pending for Admin approval.</div>');
          } else {
            $('#login-form').prepend('<div class="alert alert-danger">An unknown error occurred. Please try again.</div>');
          }
          // Redirect to login.php after 2 seconds
          setTimeout(function() {
            window.location.href = 'login.php';
          }, 2000);
        },
        error: function(err) {
          console.log(err);
          $('#Login').removeAttr('disabled').html('Login');
          $('#login-form').prepend('<div class="alert alert-danger">An error occurred. Please try again.</div>');
          // Redirect to login.php after 2 seconds
          setTimeout(function() {
            window.location.href = 'login.php';
          }, 2000);
        }
      });
    });
  });

// JavaScript code to handle the signup button click event
document.getElementById("Signup").addEventListener("click", function() {
    document.getElementById("login-section").style.display = "none";
    document.getElementById("signup-section").style.display = "block";
});

document.getElementById("forgotpass").addEventListener("click", function() {
    document.getElementById("login-section").style.display = "none";
    document.getElementById("forgot-pass-section").style.display = "block";
});

function startCountdown() {
    const button = document.querySelector('.otp-button');
    let timeLeft = 30;

    button.disabled = true;
    button.classList.add('disabled');

    const countdownInterval = setInterval(() => {
        button.textContent = `Resend(${timeLeft})`;
        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(countdownInterval);
            button.textContent = 'Send';
            button.disabled = false;
            button.classList.remove('disabled');
        }
    }, 1000);
}

