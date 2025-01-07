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

$products = $conn->query("SELECT productId, productName FROM PRODUCTS");

if (isset($_POST['productId'], $_POST['productReviewText'], $_POST['productRating'])) {
    $productId = $conn->real_escape_string($_POST['productId']);
    $reviewText = $conn->real_escape_string($_POST['productReviewText']);
    $rating = $conn->real_escape_string($_POST['productRating']);

    $query = "INSERT INTO REVIEWS_PRODUCT (userId, productId, reviewText, rating) 
              VALUES ('$userId', '$productId', '$reviewText', '$rating')";
    if ($conn->query($query)) {
        $success = "Product review added successfully!";
    } else {
        $error = "Error adding product review: " . $conn->error;
    }
}

if (isset($_POST['siteReviewText'], $_POST['siteRating'])) {
    $siteReviewText = $conn->real_escape_string($_POST['siteReviewText']);
    $siteRating = $conn->real_escape_string($_POST['siteRating']);

    $query = "INSERT INTO REVIEWS_SITE (userId, reviewText, rating) 
              VALUES ('$userId', '$siteReviewText', '$siteRating')";
    if ($conn->query($query)) {
        $success = "Website review added successfully!";
    } else {
        $error = "Error adding website review: " . $conn->error;
    }
}
?>

<html>
<head>
    <title>Add Review</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="view_reviews.php">Back to Reviews</a>
    </div>

    <h1>Add a Review</h1>

    <!-- Product Review Section -->
    <h2>Leave a Product Review</h2>
    <form method="POST">
        <label for="productId">Select Product:</label>
        <select name="productId" required>
            <option value="">--Select Product--</option>
            <?php while ($product = $products->fetch_assoc()): ?>
                <option value="<?php echo $product['productId']; ?>"><?php echo htmlspecialchars($product['productName']); ?></option>
            <?php endwhile; ?>
        </select>
        <textarea name="productReviewText" placeholder="Write your product review..." required></textarea>
        <input type="number" name="productRating" placeholder="Rating (1-5)" min="1" max="5" required>
        <button type="submit">Submit Product Review</button>
    </form>

    <!-- Website Review Section -->
    <h2>Leave a Website Experience Review</h2>
    <form method="POST">
        <textarea name="siteReviewText" placeholder="Write your website review..." required></textarea>
        <input type="number" name="siteRating" placeholder="Rating (1-5)" min="1" max="5" required>
        <button type="submit">Submit Website Review</button>
    </form>

    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
</body>
</html>
