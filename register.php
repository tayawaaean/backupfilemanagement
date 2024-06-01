<?php
session_start();
include_once 'db_connect.php'; // Include your database connection file here

$response = array();

if (isset($_POST['name']) && isset($_POST['username2']) && isset($_POST['password2']) && isset($_POST['confirm_password']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username2'];
    $password = $_POST['password2'];
    $confirm_password = $_POST['confirm_password'];

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        $response['status'] = 'password_mismatch';
        $response['message'] = 'Password and confirm password do not match.';
    } else {
        $password = md5($password); // Hashing the password using MD5

        // Setting default values for profile_pic and type
        $profile_pic = '';
        $type = 0;

        // Check if the username already exists
        $check_username_query = "SELECT id FROM users WHERE username = '$username'";
        $result = $conn->query($check_username_query);

        if ($result->num_rows > 0) {
            // Username already exists
            $response['status'] = 'username_exists';
            $response['message'] = 'Username already exists. Please choose a different username.';
        } else {
            // SQL query to insert user details into the database
            $sql = "INSERT INTO users (name, username, email, password, profile_pic, type) VALUES ('$name', '$username', '$email', '$password', '$profile_pic', '$type')";

            if ($conn->query($sql) === TRUE) {
                $response['status'] = 'success';
                $response['message'] = 'User registered successfully!';
            } else {
                $response['status'] = 'error';
                $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request parameters';
}

echo json_encode($response);
?>
