<?php
session_start();
include_once 'db_connect.php'; // Include your database connection file here

$response = array();

if(isset($_POST['name']) && isset($_POST['username2']) && isset($_POST['password2']) && isset($_POST['username3']) && isset($_POST['confirm_password'])){
    $name = $_POST['name'];
    $username = $_POST['username2'];
    $password = md5($_POST['password2']); // Hashing the password using MD5
    $email = $_POST['username3'];
    $confirm_password = md5($_POST['confirm_password']);

    if($password != $confirm_password){
        $response['status'] = 'error';
        $response['message'] = 'Passwords do not match!';
        echo json_encode($response);
        exit;
    }
    // Setting default values for profile_pic and type
    $profile_pic = '';
    $type = 0;

    // SQL query to insert user details into the database
    $sql = "INSERT INTO users (name, username, password, profile_pic, type,email) VALUES ('$name', '$username', '$password', '$profile_pic', '$type','$email')";

    if ($conn->query($sql) === TRUE) {
        $response['status'] = 'success';
        $response['message'] = 'User registered successfully!';
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request parameters';
}

echo json_encode($response);
?>
