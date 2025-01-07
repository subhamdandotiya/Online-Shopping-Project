<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM PRODUCTS WHERE isFeatured = 1 LIMIT 3";
$result = $conn->query($query);
?>

<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="view_products.php">Products</a>
        <a href="view_cart.php">Cart</a>
        <a href="view_account.php">View Account</a>
        <a href="view_reviews.php">View Reviews</a>
        <a href="logout.php">Logout</a>
        <?php if ($_SESSION['role'] === 'admin'): ?>
            <a href="add_product.php">Add Product</a>
            <a href="update_product.php">Manage Products</a>
            <a href="view_sales.php">View Sales</a>
            <a href="manage_users.php">Manage Users</a>
        <?php endif; ?>
    </div>

    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['userName']); ?></h1>

    <h2>Featured Products</h2>
    <ul>
        <?php while ($product = $result->fetch_assoc()): ?>
            <li>
                <img src="<?php echo htmlspecialchars($product['productImage']); ?>" alt="Product Image">
                <p>
                    <strong><?php echo htmlspecialchars($product['productName']); ?></strong> - 
                    $<?php echo htmlspecialchars($product['price']); ?>
                </p>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
