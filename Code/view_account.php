<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

$userQuery = "SELECT userName, firstName, lastName, email, shippingAddress FROM USERS WHERE userId = '$userId'";
$user = $conn->query($userQuery)->fetch_assoc();

$orderQuery = "SELECT ORDERS.orderId, ORDERS.totalAmount, ORDERS.orderDate, 
                      GROUP_CONCAT(CONCAT(PRODUCTS.productName, ' (x', ORDER_ITEMS.quantity, ')')) AS items
               FROM ORDERS
               JOIN ORDER_ITEMS ON ORDERS.orderId = ORDER_ITEMS.orderId
               JOIN PRODUCTS ON ORDER_ITEMS.productId = PRODUCTS.productId
               WHERE ORDERS.userId = '$userId'
               GROUP BY ORDERS.orderId";
$orders = $conn->query($orderQuery);
?>

<html>
<head>
    <title>My Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>My Account</h1>

    <h2>Profile Information</h2>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($user['userName']); ?></p>
    <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($user['shippingAddress']); ?></p>

    <a href="update_account.php"><button>Update Account</button></a>

    <h2>Order History</h2>
    <?php if ($orders->num_rows > 0): ?>
        <ul>
            <?php while ($order = $orders->fetch_assoc()): ?>
                <li>
                    <p><strong>Order ID:</strong> <?php echo $order['orderId']; ?></p>
                    <p><strong>Items:</strong> <?php echo htmlspecialchars($order['items']); ?></p>
                    <p><strong>Total:</strong> $<?php echo htmlspecialchars($order['totalAmount']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($order['orderDate']); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</body>
</html>
