<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $author = $_POST['author'];
    $jobTitle = $_POST['jobTitle'];
    $dateTime = $_POST['dateTime'];
    $description = $_POST['description'];
    $action = $_POST['action'];

    $stmt = $conn->prepare("INSERT INTO activity_log (Author, Job_Title, DateTime, Description, Action) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $author, $jobTitle, $dateTime, $description, $action);

    if ($stmt->execute()) {
        echo "Activity logged successfully.";
    } else {
        echo "Error logging activity.";
    }

    $stmt->close();
    $conn->close();
}
?>
