<?php
date_default_timezone_set('Asia/Manila');
// Include database connection
include 'db_connect.php';

// Check if ID parameter is provided and it's not empty
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id']; // Get the user ID from the POST request

    // Get the name of the user being deleted for the activity log
    $user_query = $conn->query("SELECT name FROM users WHERE id = $id");
    $user = $user_query->fetch_assoc();
    $username = $user['name'];

    // Perform delete operation
    $delete_query = $conn->query("DELETE FROM users WHERE id = $id");

    // Check if delete operation was successful
    if($delete_query){
        // Insert an entry into the activity log
        $author = "Admin"; // Assuming the deletion is performed by an admin
        $action = "User Deleted";
        $description = "Deleted user $username";
        $timestamp = date('Y-m-d H:i:s');
        $log_query = "INSERT INTO activity_log (Author, Action, DateTime, Description) VALUES ('$author', '$action', '$timestamp', '$description')";
        $conn->query($log_query);

        echo 1; // Return 1 indicating success
    } else {
        echo 0; // Return 0 indicating failure
    }
} else {
    echo "Invalid request"; // If ID parameter is not provided or empty
}
?>
