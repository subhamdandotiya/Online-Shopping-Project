<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_POST['userId']) || empty($_POST['userId'])) {
    die("Error: User ID not provided.");
}

$userId = (int)$_POST['userId'];

$conn->begin_transaction();

try {
    $deleteCartItemsQuery = "DELETE ci FROM CART_ITEMS ci 
                             JOIN CART c ON ci.cartId = c.cartId 
                             WHERE c.userId = ?";
    $stmt = $conn->prepare($deleteCartItemsQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $deleteCartQuery = "DELETE FROM CART WHERE userId = ?";
    $stmt = $conn->prepare($deleteCartQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $deleteUserQuery = "DELETE FROM USERS WHERE userId = ?";
    $stmt = $conn->prepare($deleteUserQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $conn->commit();
    header("Location: manage_users.php?message=User+deleted+successfully");
    exit();
} catch (Exception $e) {
    $conn->rollback();
    die("Error deleting user: " . $e->getMessage());
}
?>
