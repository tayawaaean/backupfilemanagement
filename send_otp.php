<?php
session_start();
include_once 'db_connect.php'; // Include your database connection file here
require './vendor/autoload.php'; // Include PHPMailer autoload file

$response = array();

if(isset($_POST['username2']) && isset($_POST['username3'])){
    $username = $_POST['username2'];
    $email = $_POST['username3'];

    // SQL query to check if the user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $qry = $conn->query($sql);

    if($qry->num_rows > 0){
        $id = $qry->fetch_assoc()['id'];

        // Check if there is already an OTP for the user
        $sql = "SELECT * FROM verification WHERE id = '$id'";
        $qry = $conn->query($sql);
        if($qry->num_rows > 0){
            $sql = "DELETE FROM verification WHERE id = '$id'";
            $conn->query($sql);
        }
        
        // Generate a new OTP
        $otp = rand(100000, 999999);
        $sql = "INSERT INTO verification (id, otp) VALUES ('$id', '$otp')";
        if ($conn->query($sql) === TRUE) {
            // Send OTP to email
            $mail = new PHPMailer\PHPMailer\PHPMailer();

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp-mail.outlook.com'; // Set the SMTP server to send through
                $mail->SMTPAuth = true;
                $mail->Username = 'iotgarlicgreenhouseg0@outlook.com'; // SMTP username
                $mail->Password = 'garlicgreenhouse2023'; // SMTP password
                $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; 
                $mail->Port = 587; 

                //Recipients
                $mail->setFrom('iotgarlicgreenhouseg0@outlook.com', 'File Management System OTP Sender');
                $mail->addAddress($email); // Add a recipient

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "Your OTP code is $otp";

                $mail->send();
                $response['status'] = '1';
                $response['message'] = 'OTP sent to your email';
            } catch (Exception $e) {
                $response['status'] = '0';
                $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
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
