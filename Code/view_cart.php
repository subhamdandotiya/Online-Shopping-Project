<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];

$cartQuery = "SELECT ci.cartItemId, ci.productId, ci.quantity, p.productName, p.price 
              FROM CART_ITEMS ci
              JOIN CART c ON ci.cartId = c.cartId
              JOIN PRODUCTS p ON ci.productId = p.productId
              WHERE c.userId = ?";
$stmt = $conn->prepare($cartQuery);
$stmt->bind_param("i", $userId);
$stmt->execute();
$cartResult = $stmt->get_result();

if ($cartResult->num_rows === 0) {
    echo "<html>
    <head>
        <title>Shopping Cart</title>
        <link rel='stylesheet' href='styles.css'>
        <style>
            .empty-cart-container {
                text-align: center;
                margin-top: 100px;
            }
            .button {
                background-color: #007BFF;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-size: 16px;
                margin-top: 20px;
                display: inline-block;
            }
            .button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class='navbar'>
            <a href='home.php'>Home</a>
            <a href='view_products.php'>Products</a>
            <a href='logout.php'>Logout</a>
        </div>
        <div class='empty-cart-container'>
            <h1>Your Shopping Cart</h1>
            <h2>Your shopping cart is empty.</h2>
            <a href='view_products.php' class='button'>Browse Products</a>
        </div>
    </body>
    </html>";
    exit();
}

$totalPrice = 0; 
?>

<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="view_products.php">Products</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Your Shopping Cart</h1>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = $cartResult->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['productName']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    <td>
                        <form method="POST" action="remove_from_cart.php">
                            <input type="hidden" name="cartItemId" value="<?php echo $item['cartItemId']; ?>">
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php $totalPrice += $item['price'] * $item['quantity']; ?>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total</td>
                <td colspan="2">$<?php echo number_format($totalPrice, 2); ?></td>
            </tr>
        </tfoot>
    </table>

    <form method="POST" action="payment.php">
        <button type="submit">Proceed to Checkout</button>
    </form>
</body>
</html>
