<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

$orderQuery = "SELECT orderId FROM ORDERS WHERE userId = ? ORDER BY orderDate DESC LIMIT 1";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$orderResult = $stmt->get_result();

if ($orderResult && $orderResult->num_rows > 0) {
    $order = $orderResult->fetch_assoc();
    $orderId = $order['orderId'];

    echo "<html>
        <head>
            <title>Checkout</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <div class='navbar'>
                <a href='home.php'>Home</a>
                <a href='logout.php'>Logout</a>
            </div>
            <h1>Checkout</h1>
            <p>Thank you for your order!</p>
            <p>Your Order ID is: <strong>$orderId</strong></p>
        </body>
    </html>";
} else {
    echo "<html>
        <head>
            <title>Checkout</title>
            <link rel='stylesheet' href='styles.css'>
        </head>
        <body>
            <div class='navbar'>
                <a href='home.php'>Home</a>
                <a href='logout.php'>Logout</a>
            </div>
            <h1>Checkout</h1>
            <p>Thank you for your order!</p>
        </body>
    </html>";
}
?>
