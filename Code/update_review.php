<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];
$reviewId = $conn->real_escape_string($_POST['reviewId']);
$isProductReview = isset($_POST['isProductReview']) && $_POST['isProductReview'] == 1;

// Determine the review type and query the appropriate table
if ($isProductReview) {
    $reviewQuery = "SELECT reviewText, rating FROM REVIEWS_PRODUCT WHERE reviewId='$reviewId' AND userId='$userId'";
} else {
    $reviewQuery = "SELECT reviewText, rating FROM REVIEWS_SITE WHERE reviewId='$reviewId' AND userId='$userId'";
}

$reviewResult = $conn->query($reviewQuery);

if ($reviewResult->num_rows > 0) {
    $review = $reviewResult->fetch_assoc();

    if (isset($_POST['reviewText'], $_POST['rating'])) {
        $reviewText = $conn->real_escape_string($_POST['reviewText']);
        $rating = $conn->real_escape_string($_POST['rating']);

        // Update the correct table
        if ($isProductReview) {
            $updateQuery = "UPDATE REVIEWS_PRODUCT SET reviewText='$reviewText', rating='$rating' WHERE reviewId='$reviewId'";
        } else {
            $updateQuery = "UPDATE REVIEWS_SITE SET reviewText='$reviewText', rating='$rating' WHERE reviewId='$reviewId'";
        }

        if ($conn->query($updateQuery)) {
            $success = "Review updated successfully!";
        } else {
            $error = "Error updating review: " . $conn->error;
        }
    }
} else {
    header("Location: view_reviews.php");
    exit();
}
?>

<html>
<head>
    <title>Update Review</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="view_reviews.php">Back to Reviews</a>
    </div>

    <h1>Update Review</h1>

    <form method="POST">
        <input type="hidden" name="reviewId" value="<?php echo $reviewId; ?>">
        <input type="hidden" name="isProductReview" value="<?php echo $isProductReview ? '1' : '0'; ?>">
        <textarea name="reviewText" required><?php echo htmlspecialchars($review['reviewText']); ?></textarea>
        <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" value="<?php echo $review['rating']; ?>" required>
        <button type="submit">Update Review</button>
    </form>

    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</body>
</html>
