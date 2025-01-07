<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];
$success = false;
$error = "";

$userQuery = "SELECT firstName, lastName, email, shippingAddress FROM USERS WHERE userId = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();

$totalAmountQuery = "SELECT SUM(p.price * ci.quantity) AS totalAmount
                     FROM CART_ITEMS ci
                     JOIN PRODUCTS p ON ci.productId = p.productId
                     JOIN CART c ON ci.cartId = c.cartId
                     WHERE c.userId = ?";
$stmt = $conn->prepare($totalAmountQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$totalAmountResult = $stmt->get_result();
$totalAmount = $totalAmountResult->fetch_assoc()['totalAmount'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $creditCard = isset($_POST['creditCard']) ? $_POST['creditCard'] : '';
    $cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

    if (preg_match('/^\d{16}$/', $creditCard) && preg_match('/^\d{3}$/', $cvv)) {
        $hashedCreditCard = password_hash($creditCard, PASSWORD_BCRYPT);
        $hashedCvv = password_hash($cvv, PASSWORD_BCRYPT);

        $conn->begin_transaction();

        try {
            $paymentQuery = "INSERT INTO PAYMENTS (userId, creditCardHash, cvvHash, totalAmount) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($paymentQuery);
            $stmt->bind_param("issd", $userId, $hashedCreditCard, $hashedCvv, $totalAmount);
            if (!$stmt->execute()) {
                throw new Exception("Error inserting payment: " . $stmt->error);
            }
            $paymentId = $stmt->insert_id;

            $orderQuery = "INSERT INTO ORDERS (userId, paymentId, totalAmount) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($orderQuery);
            $stmt->bind_param("iid", $userId, $paymentId, $totalAmount);
            if (!$stmt->execute()) {
                throw new Exception("Error creating order: " . $stmt->error);
            }
            $orderId = $stmt->insert_id;

            $orderItemsQuery = "INSERT INTO ORDER_ITEMS (orderId, productId, quantity, price)
                                SELECT ?, ci.productId, ci.quantity, p.price
                                FROM CART_ITEMS ci
                                JOIN PRODUCTS p ON ci.productId = p.productId
                                JOIN CART c ON ci.cartId = c.cartId
                                WHERE c.userId = ?";
            $stmt = $conn->prepare($orderItemsQuery);
            $stmt->bind_param("ii", $orderId, $userId);
            if (!$stmt->execute()) {
                throw new Exception("Error transferring items to order: " . $stmt->error);
            }

            $clearCartItemsQuery = "DELETE ci FROM CART_ITEMS ci
                                    JOIN CART c ON ci.cartId = c.cartId
                                    WHERE c.userId = ?";
            $stmt = $conn->prepare($clearCartItemsQuery);
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Error clearing cart items: " . $stmt->error);
            }

            $clearCartQuery = "DELETE FROM CART WHERE userId = ?";
            $stmt = $conn->prepare($clearCartQuery);
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                throw new Exception("Error clearing cart: " . $stmt->error);
            }

            $conn->commit();
            $success = true;

            header("Location: checkout.php");
            exit();

        } catch (Exception $e) {
            $conn->rollback();
            $error = $e->getMessage();
        }
    } else {
        $error = "Invalid credit card or CVV. Please try again.";
    }
}
?>

<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Payment</h1>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST">
        <p>Name: <?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></p>
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Shipping Address: <?php echo htmlspecialchars($user['shippingAddress']); ?></p>
        <p>Total Amount: $<?php echo number_format($totalAmount, 2); ?></p>
        <p>
            <label for="creditCard">Credit Card Number (16 digits):</label>
            <input type="text" name="creditCard" id="creditCard" maxlength="16" required>
        </p>
        <p>
            <label for="cvv">CVV (3 digits):</label>
            <input type="text" name="cvv" id="cvv" maxlength="3" required>
        </p>
        <button type="submit">Submit Payment</button>
    </form>
</body>
</html>
