<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$success = "";
$error = "";

if (isset($_POST['submit'])) {
    $productName = $conn->real_escape_string($_POST['productName']);
    $productDescription = $conn->real_escape_string($_POST['productDescription']);
    $price = $conn->real_escape_string($_POST['price']);
    $inventory = $conn->real_escape_string($_POST['inventory']);
    $isFeatured = isset($_POST['isFeatured']) ? 1 : 0;

    $productImage = null;
    if (isset($_FILES['productImage']) && $_FILES['productImage']['error'] == 0) {
        $productImage = 'images/' . basename($_FILES['productImage']['name']);
        if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $productImage)) {
            $error = "Failed to upload image.";
        }
    }

    if (!$error) {
        $query = "INSERT INTO PRODUCTS (productName, productDescription, price, inventory, isFeatured, productImage) 
                  VALUES ('$productName', '$productDescription', '$price', '$inventory', '$isFeatured', '$productImage')";

        if ($conn->query($query)) {
            $success = "Product added successfully!";
        } else {
            $error = "Error adding product: " . $conn->error;
        }
    }
}
?>

<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>
    <h1>Add a New Product</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="productName" placeholder="Product Name" required>
        <textarea name="productDescription" placeholder="Product Description"></textarea>
        <input type="number" name="price" placeholder="Price" step="0.01" required>
        <input type="number" name="inventory" placeholder="Inventory" required>
        <label>
            <input type="checkbox" name="isFeatured"> Feature this product
        </label><br><br>
        <label for="productImage">Upload Product Image:</label>
        <input type="file" name="productImage" accept="image/*">
        <button type="submit" name="submit">Add Product</button>
    </form>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
</body>
</html>
