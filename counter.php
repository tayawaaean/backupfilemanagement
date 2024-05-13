<?php
// Assuming you have a connection to your database already established
include 'db_connect.php';

// Query to count total users
$sqlTotalUsers = "SELECT COUNT(*) as total_users FROM users";
$resultTotalUsers = $conn->query($sqlTotalUsers);

$totalUsers = 0; // Default value if no users found

if ($resultTotalUsers->num_rows > 0) {
    $rowTotalUsers = $resultTotalUsers->fetch_assoc();
    $totalUsers = $rowTotalUsers["total_users"];
}

// Query to count total files
$sqlTotalFiles = "SELECT COUNT(*) as total_files FROM files"; // Assuming "files" is the name of your files table
$resultTotalFiles = $conn->query($sqlTotalFiles);

$totalFiles = 0; // Default value if no files found

if ($resultTotalFiles->num_rows > 0) {
    $rowTotalFiles = $resultTotalFiles->fetch_assoc();
    $totalFiles = $rowTotalFiles["total_files"];
}

// Query to count total pending registrations (users where type = 0)
$sqlPendingRegister = "SELECT COUNT(*) as total_pending_register FROM users WHERE type = 0";
$resultPendingRegister = $conn->query($sqlPendingRegister);

$totalPendingRegister = 0; // Default value if no pending registrations found

if ($resultPendingRegister->num_rows > 0) {
    $rowPendingRegister = $resultPendingRegister->fetch_assoc();
    $totalPendingRegister = $rowPendingRegister["total_pending_register"];
}
?>