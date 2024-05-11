<?php
// Include database connection
include 'db_connect.php';

// Check if ID parameter is provided and it's not empty
if(isset($_POST['id']) && !empty($_POST['id'])){
    $id = $_POST['id']; // Get the user ID from the POST request

    // Perform delete operation
    $delete_query = $conn->query("DELETE FROM users WHERE id = $id");

    // Check if delete operation was successful
    if($delete_query){
        echo 1; // Return 1 indicating success
    } else {
        echo 0; // Return 0 indicating failure
    }
} else {
    echo "Invalid request"; // If ID parameter is not provided or empty
}
?>
