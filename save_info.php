<?php
include 'db_connect.php';
session_start();

$login_id = $_SESSION['login_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $contact_number = $_POST['contact_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $job_title = $_POST['job_title'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $civil_status = $_POST['civil_status'];

    // Update user information in the database
    $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, contact_number = ?, email = ?, address = ?, position = ?, birthday = ?, gender = ?, civil_status = ? WHERE id = ?");
    $stmt->bind_param('sssssssssi', $name, $username, $contact_number, $email, $address, $job_title, $birthday, $gender, $civil_status, $login_id);

    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
