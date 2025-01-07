<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];
$success = "";
$error = "";

// Handle deletion of reviews
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteReviewId'])) {
    $reviewId = $conn->real_escape_string($_POST['deleteReviewId']);
    $isProductReview = isset($_POST['isProductReview']) ? true : false;

    if ($isProductReview) {
        $query = "DELETE FROM REVIEWS_PRODUCT WHERE reviewId = $reviewId AND userId = $userId";
    } else {
        $query = "DELETE FROM REVIEWS_SITE WHERE reviewId = $reviewId AND userId = $userId";
    }

    if ($conn->query($query)) {
        $success = "Review deleted successfully.";
    } else {
        $error = "Error deleting review: " . $conn->error;
    }
}

// Fetch product reviews
$productReviews = $conn->query("SELECT REVIEWS_PRODUCT.reviewId, REVIEWS_PRODUCT.reviewText, REVIEWS_PRODUCT.rating, 
    PRODUCTS.productName, REVIEWS_PRODUCT.userId 
    FROM REVIEWS_PRODUCT 
    JOIN PRODUCTS ON REVIEWS_PRODUCT.productId = PRODUCTS.productId");

// Fetch site reviews
$siteReviews = $conn->query("SELECT reviewId, reviewText, rating, userId FROM REVIEWS_SITE");
?>

<html>
<head>
    <title>Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="add_review.php">Add Review</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Reviews</h1>
    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <h2>Product Reviews</h2>
    <ul>
        <?php while ($review = $productReviews->fetch_assoc()): ?>
            <li>
                <p><strong><?php echo htmlspecialchars($review['productName']); ?>:</strong> <?php echo htmlspecialchars($review['reviewText']); ?></p>
                <p>Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                <?php if ($review['userId'] == $userId): ?>
                    <!-- Update Product Review Button -->
                    <form method="POST" action="update_review.php" style="display:inline;">
                        <input type="hidden" name="reviewId" value="<?php echo $review['reviewId']; ?>">
                        <input type="hidden" name="isProductReview" value="1"> <!-- Mark as product review -->
                        <button type="submit">Update</button>
                    </form>
                    <!-- Delete Product Review Button -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="deleteReviewId" value="<?php echo $review['reviewId']; ?>">
                        <input type="hidden" name="isProductReview" value="1"> <!-- Mark as product review -->
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>

    <h2>Site Reviews</h2>
    <ul>
        <?php while ($review = $siteReviews->fetch_assoc()): ?>
            <li>
                <p><?php echo htmlspecialchars($review['reviewText']); ?></p>
                <p>Rating: <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                <?php if ($review['userId'] == $userId): ?>
                    <!-- Update Site Review Button -->
                    <form method="POST" action="update_review.php" style="display:inline;">
                        <input type="hidden" name="reviewId" value="<?php echo $review['reviewId']; ?>">
                        <input type="hidden" name="isProductReview" value="0"> <!-- Mark as site review -->
                        <button type="submit">Update</button>
                    </form>
                    <!-- Delete Site Review Button -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="deleteReviewId" value="<?php echo $review['reviewId']; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
