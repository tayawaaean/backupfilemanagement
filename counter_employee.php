<?php
// Assuming you have a connection to your database already established
include 'db_connect.php';

if (!isset($_SESSION['login_id'])) {
    // Redirect or handle the case where the user is not logged in
    // For example:
    header("Location: login.php");
    exit();
}

$loginId = $_SESSION['login_id']; // Assuming you store the user's ID in the session

// Query to count total files for the logged-in user
$sqlTotalFiles = "SELECT COUNT(*) as total_files FROM files WHERE user_id = $loginId";
$resultTotalFiles = $conn->query($sqlTotalFiles);

$totalFiles = 0; // Default value if no files found

if ($resultTotalFiles->num_rows > 0) {
    $rowTotalFiles = $resultTotalFiles->fetch_assoc();
    $totalFiles = $rowTotalFiles["total_files"];
}

// Query to count total folders for the logged-in user
$sqlTotalFolders = "SELECT COUNT(*) as total_folders FROM folders WHERE user_id = $loginId";
$resultTotalFolders = $conn->query($sqlTotalFolders);

$totalFolders = 0; // Default value if no folders found

if ($resultTotalFolders->num_rows > 0) {
    $rowTotalFolders = $resultTotalFolders->fetch_assoc();
    $totalFolders = $rowTotalFolders["total_folders"];
}

// Query to count total shared files for the logged-in user
$sqlTotalSharedFiles = "SELECT COUNT(*) as total_shared_files FROM files WHERE is_public = 1 AND user_id = $loginId";
$resultTotalSharedFiles = $conn->query($sqlTotalSharedFiles);

$totalSharedFiles = 0; // Default value if no shared files found

if ($resultTotalSharedFiles->num_rows > 0) {
    $rowTotalSharedFiles = $resultTotalSharedFiles->fetch_assoc();
    $totalSharedFiles = $rowTotalSharedFiles["total_shared_files"];
}
?>
