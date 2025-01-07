<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM PRODUCTS";
$result = $conn->query($query);
?>

<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="view_cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Products</h1>
    <ul>
        <?php while ($product = $result->fetch_assoc()): ?>
            <li>
                <img src="<?php echo htmlspecialchars($product['productImage']); ?>" alt="Product Image">
                <p>
                    <strong><?php echo htmlspecialchars($product['productName']); ?></strong> - 
                    $<?php echo htmlspecialchars($product['price']); ?><br>
                    <small>In Stock: <?php echo htmlspecialchars($product['inventory']); ?></small>
                </p>
                <form method="POST" action="add_to_cart.php">
                    <input type="hidden" name="productId" value="<?php echo $product['productId']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
