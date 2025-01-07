<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['cartItemId']) || empty($_POST['cartItemId'])) {
    die("Error: Invalid cart item ID.");
}

$cartItemId = (int)$_POST['cartItemId'];
$userId = $_SESSION['userId'];

$deleteQuery = "DELETE ci
                FROM CART_ITEMS ci
                JOIN CART c ON ci.cartId = c.cartId
                WHERE ci.cartItemId = ? AND c.userId = ?";
$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param("ii", $cartItemId, $userId);

if ($stmt->execute()) {
    header("Location: view_cart.php");
    exit();
} else {
    die("Error removing item from cart: " . $stmt->error);
}
?>
