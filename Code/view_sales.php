<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$query = "SELECT ORDERS.orderId, USERS.userName, ORDERS.totalAmount, ORDERS.orderDate
          FROM ORDERS
          JOIN USERS ON USERS.userId = ORDERS.userId";
$result = $conn->query($query);
?>

<html>
<head>
    <title>View Sales</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Sales</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Username</th>
                <th>Total Amount</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($sale = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($sale['orderId']); ?></td>
                    <td><?php echo htmlspecialchars($sale['userName']); ?></td>
                    <td>$<?php echo htmlspecialchars($sale['totalAmount']); ?></td>
                    <td><?php echo htmlspecialchars($sale['orderDate']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
