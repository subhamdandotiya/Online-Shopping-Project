<?php
require_once 'dbinfo.php';

$success = "";
$error = "";

if (isset($_POST['userName'], $_POST['password'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['shippingAddress'])) {
    $userName = $conn->real_escape_string($_POST['userName']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstName = $conn->real_escape_string($_POST['firstName']);
    $lastName = $conn->real_escape_string($_POST['lastName']);
    $email = $conn->real_escape_string($_POST['email']);
    $shippingAddress = $conn->real_escape_string($_POST['shippingAddress']);

    $query = "INSERT INTO USERS (userName, passwordHash, firstName, lastName, email, shippingAddress, role) 
              VALUES ('$userName', '$password', '$firstName', '$lastName', '$email', '$shippingAddress', 'user')";
    if ($conn->query($query)) {
        $success = "Account created successfully! You can now <a href='login.php'>log in</a>.";
    } else {
        $error = "Error creating account: " . $conn->error;
    }
}
?>

<html>
<head>
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Create Account</h1>
        <form method="POST">
            <input type="text" name="userName" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="firstName" placeholder="First Name" required>
            <input type="text" name="lastName" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <textarea name="shippingAddress" placeholder="Shipping Address" required></textarea>
            <button type="submit">Create Account</button>
        </form>
        <?php if ($success) echo "<p class='success'>$success</p>"; ?>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <p><a href="login.php">Already have an account? Login here to return to Login page</a>.</p>
    </div>
</body>
</html>
