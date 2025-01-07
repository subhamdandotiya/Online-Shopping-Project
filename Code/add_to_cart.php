<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    die("Error: User is not logged in.");
}

$userId = $_SESSION['userId'];
if (empty($userId)) {
    die("Error: userId is invalid or not set in the session.");
}

$productId = isset($_POST['productId']) ? (int)$_POST['productId'] : 0;
if (!$productId) {
    die("Error: Invalid productId.");
}

$quantity = 1;

$createCartQuery = "INSERT INTO CART (userId, cartVersion) VALUES (?, 1)";
$stmt = $conn->prepare($createCartQuery);
$stmt->bind_param("i", $userId);
if (!$stmt->execute()) {
    die("Error creating cart: " . $stmt->error);
}
$cartId = $conn->insert_id;

$addItemQuery = "INSERT INTO CART_ITEMS (cartId, productId, quantity, cartVersion, userId) 
                 VALUES (?, ?, ?, 1, ?)";
$stmt = $conn->prepare($addItemQuery);
$stmt->bind_param("iiii", $cartId, $productId, $quantity, $userId);
if (!$stmt->execute()) {
    die("Error adding item: " . $stmt->error);
}

header("Location: view_cart.php");
exit();
?>
