<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])) {
    $productId = $conn->real_escape_string($_POST['productId']);
    
    try {
        $conn->begin_transaction();

        $deleteCartItems = "DELETE FROM CART_ITEMS WHERE productId = $productId";
        if (!$conn->query($deleteCartItems)) {
            throw new Exception("Error deleting related cart items: " . $conn->error);
        }

        $deleteOrderItems = "DELETE FROM ORDER_ITEMS WHERE productId = $productId";
        if (!$conn->query($deleteOrderItems)) {
            throw new Exception("Error deleting related order items: " . $conn->error);
        }

        $deleteProduct = "DELETE FROM PRODUCTS WHERE productId = $productId";
        if (!$conn->query($deleteProduct)) {
            throw new Exception("Error deleting product: " . $conn->error);
        }

        $conn->commit();
        header("Location: update_product.php?success=Product deleted successfully.");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        header("Location: update_product.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: update_product.php?error=Invalid request.");
    exit();
}
?>
