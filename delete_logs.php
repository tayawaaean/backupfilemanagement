<?php
session_start();
include 'db_connect.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['deleteAll']) && $data['deleteAll'] == true) {
        // Delete all logs
        if ($_SESSION['login_type'] == 1) {
            $sql = "DELETE FROM activity_log";
            $stmt = $conn->prepare($sql);
        } else if ($_SESSION['login_type'] == 2) {
            $author = $_SESSION['login_name'];
            $sql = "DELETE FROM activity_log WHERE Author = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $author);
        }
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    } else if (isset($data['ids']) && !empty($data['ids'])) {
        // Delete selected logs
        $ids = implode(',', array_map('intval', $data['ids']));
        $sql = "DELETE FROM activity_log WHERE id IN ($ids)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid request']);
    }
}
?>
