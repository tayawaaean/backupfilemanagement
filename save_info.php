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

    // Profile picture upload handling
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['name'] != '') {
        $file = $_FILES['profile_picture'];
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = generateFileName($file_extension);
        $upload_path = 'profile_pics/' . $new_filename;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            // Update user information with profile picture path in the database
            $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, contact_number = ?, email = ?, address = ?, position = ?, birthday = ?, gender = ?, civil_status = ?, profile_pic = ? WHERE id = ?");
            $stmt->bind_param('ssssssssssi', $name, $username, $contact_number, $email, $address, $job_title, $birthday, $gender, $civil_status, $upload_path, $login_id);
        } else {
            $_SESSION['message'] = "Error uploading profile picture.";
            header("Location: index.php?page=personal");
            exit();
        }
    } else {
        // Update user information without profile picture path
        $stmt = $conn->prepare("UPDATE users SET name = ?, username = ?, contact_number = ?, email = ?, address = ?, position = ?, birthday = ?, gender = ?, civil_status = ? WHERE id = ?");
        $stmt->bind_param('sssssssssi', $name, $username, $contact_number, $email, $address, $job_title, $birthday, $gender, $civil_status, $login_id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Record updated successfully";
    } else {
        $_SESSION['message'] = "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirect to personal.php
    header("Location: index.php?page=personal");
    exit();
}

// Function to generate a unique filename for the uploaded image with a random number
function generateFileName($file_extension) {
    $random_number = mt_rand(100000, 999999); // Generate a random number between 100000 and 999999
    return 'profile_picture_' . $random_number . '.' . $file_extension;
}
?>
