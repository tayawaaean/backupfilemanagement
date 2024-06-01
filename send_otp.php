<?php
session_start();
include_once 'db_connect.php'; // Include your database connection file here

$response = array();

if(isset($_POST['username2']) && isset($_POST['username3'])){
    $username = $_POST['username2'];
    $email = $_POST['username3'];
    // SQL query to insert user details into the database
    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    //get id from the users table

    $qry = $conn->query($sql);
    if($qry->num_rows > 0){
        $id = $qry->fetch_assoc()['id'];
        //see if there is already an otp for the user  
        $sql = "SELECT * FROM verification WHERE id = '$id'";
        $qry = $conn->query($sql);
        if($qry->num_rows > 0){
            $sql = "DELETE FROM verification WHERE id = '$id'";
            $conn->query($sql);
        }
        
        $otp = rand(100000, 999999);
        $sql = "INSERT INTO verification (id, otp) VALUES ('$id', '$otp')";
        if ($conn->query($sql) === TRUE) {
            $response['status'] = '1';
        } else {
            $response['status'] = '0';
            $response['message'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $response['status'] = '0';
        $response['message'] = 'Invalid username or email';
    }

    $conn->close();
} else {
    $response['status'] = '0';
    $response['message'] = 'Enter username and email';
}

echo json_encode($response);
exit;

?>
