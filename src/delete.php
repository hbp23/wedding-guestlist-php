<?php
include '../includes/auth.php';
include '../includes/database.php';
/** @var mysqli $conn */

if (!isset($_GET['id'])) {
    echo "No guest ID provided.";
    exit();
}

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Delete the guest record that matches both id and the current user
$stmt = $conn->prepare("DELETE FROM guests WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);

if ($stmt->execute()) {
    header("Location: home.php");
    exit();
} else {
    echo "Error deleting guest: " . $stmt->error;
}
