<?php
// Include database connection
include 'db_connect.php';

// Check if ID parameter is provided and it's not empty
if(isset($_GET['id']) && !empty($_GET['id'])){
    $userId = $_GET['id']; // Get the user ID from the GET parameter

    // Check if a file is uploaded
    if(isset($_FILES['profileImage']) && $_FILES['profileImage']['name'] != ''){
        $file = $_FILES['profileImage'];
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_filename = generateFileName($file_extension);
        $upload_path = 'profile_pics/' . $new_filename; // Path to save the uploaded image
        
        // Move uploaded file to the destination folder
        if(move_uploaded_file($file['tmp_name'], $upload_path)){
            // Update the user's profile picture path in the database
            $update_query = $conn->query("UPDATE users SET profile_pic = '$upload_path' WHERE id = $userId");

            // Check if update operation was successful
            if($update_query){
                echo 1; // Return 1 indicating success
            } else {
                // If update fails, delete the uploaded file
                unlink($upload_path);
                echo 0; // Return 0 indicating failure
            }
        } else {
            echo 0; // Return 0 indicating failure
        }
    } else {
        echo "No file uploaded"; // If no file is uploaded
    }
} else {
    echo "Invalid request"; // If ID parameter is not provided or empty
}

// Function to generate a unique filename for the uploaded image with a random number
function generateFileName($file_extension) {
    $random_number = mt_rand(100000, 999999); // Generate a random number between 100000 and 999999
    return 'profile_picture_' . $random_number . '.' . $file_extension;
}
?>
