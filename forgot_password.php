<?php
session_start();
include_once 'db_connect.php'; // Include your database connection file here

$response = array();

if(isset($_POST['username2']) && isset($_POST['password2']) && isset($_POST['username3']) && isset($_POST['otp']) && isset($_POST['password3'])) {
    $username = $_POST['username2'];
    $otp = $_POST['otp'];
    $new_password = md5($_POST['password2']); // Hashing the password using MD5
    $confirm_password = md5($_POST['password3']);
    $email = $_POST['username3'];
    if($new_password != $confirm_password){
        $response['status'] = 'error';
        $response['message'] = 'Passwords do not match!';
        echo json_encode($response);
        exit;
    }
    // Sql query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        //find otp code from user and verification table
        //get id
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $sql = "SELECT * FROM verification WHERE id = '$id' AND otp = '$otp'";
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
            //delete otp code from verification table
            $sql = "DELETE FROM verification WHERE id = '$id' AND otp = '$otp'";
            $conn->query($sql);
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid OTP, Please send a new one!';
            echo json_encode($response);
            exit;
        }
        $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
        if($conn->query($sql) === TRUE) {
            $response['status'] = 'success';
            $response['message'] = 'Password reset successfully';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error resetting password';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid username or email address';
    }
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request parameters';
}

echo json_encode($response);
?>
