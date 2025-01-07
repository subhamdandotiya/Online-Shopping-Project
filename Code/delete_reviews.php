<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if (isset($_GET['reviewId']) && is_numeric($_GET['reviewId'])) {
    $reviewId = $conn->real_escape_string($_GET['reviewId']);
    $userId = $_SESSION['userId']; 

    $query = "SELECT * FROM REVIEWS WHERE reviewId = $reviewId AND userId = $userId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $deleteQuery = "DELETE FROM REVIEWS WHERE reviewId = $reviewId AND userId = $userId";
        if ($conn->query($deleteQuery)) {
            $success = "Review deleted successfully.";
        } else {
            $error = "Error deleting review: " . $conn->error;
        }
    } else {
        $error = "You can only delete your own reviews.";
    }
} else {
    $error = "Invalid review ID.";
}

header("Location: view_reviews.php?success=" . urlencode($success) . "&error=" . urlencode($error));
exit();
?>
