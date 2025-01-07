<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['userId'];
$success = "";
$error = "";

$userQuery = "SELECT userName, firstName, lastName, email, shippingAddress FROM USERS WHERE userId = '$userId'";
$user = $conn->query($userQuery)->fetch_assoc();

if (isset($_POST['userName'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['shippingAddress'])) {
    $userName = $conn->real_escape_string($_POST['userName']);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $shippingAddress = $conn->real_escape_string($_POST['shippingAddress']);

    $passwordQuery = "";
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $passwordQuery = ", passwordHash='$password'";
    }

    $updateQuery = "UPDATE USERS 
                    SET userName='$userName', firstName='$firstName', lastName='$lastName', 
                        email='$email', shippingAddress='$shippingAddress' $passwordQuery
                    WHERE userId='$userId'";
    if ($conn->query($updateQuery)) {
        $success = "Account updated successfully!";
    } else {
        $error = "Error updating account: " . $conn->error;
    }
}

if (isset($_POST['deleteAccount'])) {
    $conn->query("DELETE FROM USERS WHERE userId='$userId'");
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<html>
<head>
    <title>Update Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="view_account.php">Back to My Account</a>
    </div>

    <h1>Update Account</h1>

    <form method="POST">
        <input type="text" name="userName" value="<?php echo htmlspecialchars($user['userName']); ?>" required>
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['firstName']); ?>" required>
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($user['lastName']); ?>" required>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <textarea name="shippingAddress" required><?php echo htmlspecialchars($user['shippingAddress']); ?></textarea>
        <input type="password" name="password" placeholder="New Password (optional)">
        <button type="submit">Update Account</button>
    </form>
    <?php if ($success) echo "<p class='success'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="hidden" name="deleteAccount" value="1">
        <button type="submit">Delete Account</button>
    </form>
</body>
</html>
