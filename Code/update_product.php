<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if (isset($_POST['updateProductId'], $_POST['productName'], $_POST['price'], $_POST['inventory'])) {
    $productId = $conn->real_escape_string($_POST['updateProductId']);
    $productName = $conn->real_escape_string($_POST['productName']);
    $productDescription = $conn->real_escape_string($_POST['productDescription']);
    $price = $conn->real_escape_string($_POST['price']);
    $inventory = $conn->real_escape_string($_POST['inventory']);
    $isFeatured = isset($_POST['isFeatured']) ? 1 : 0;

    $query = "UPDATE PRODUCTS 
              SET productName='$productName', productDescription='$productDescription', price='$price', 
                  inventory='$inventory', isFeatured='$isFeatured'
              WHERE productId='$productId'";
    if ($conn->query($query)) {
        $success = "Product updated successfully!";
    } else {
        $error = "Error updating product: " . $conn->error;
    }
}

$products = $conn->query("SELECT * FROM PRODUCTS");
?>

<html>
<head>
    <title>Update/Delete Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Update or Delete Products</h1>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <ul>
        <?php while ($product = $products->fetch_assoc()): ?>
            <li>
                <form method="POST">
                    <input type="hidden" name="updateProductId" value="<?php echo $product['productId']; ?>">
                    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required>
                    <textarea name="productDescription"><?php echo htmlspecialchars($product['productDescription']); ?></textarea>
                    <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
                    <input type="number" name="inventory" value="<?php echo $product['inventory']; ?>" required>
                    <label>
                        <input type="checkbox" name="isFeatured" <?php echo $product['isFeatured'] ? 'checked' : ''; ?>> Feature this product
                    </label>
                    <button type="submit">Update Product</button>
                </form>
                <form method="POST" action="delete_product.php" style="display:inline;">
                    <input type="hidden" name="productId" value="<?php echo $product['productId']; ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete Product</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
