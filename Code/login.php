<?php
session_start();
require_once 'dbinfo.php';

// Sanitization functions
function mysql_entities_fix_string($conn, $string) {
    return htmlentities(mysql_fix_string($conn, $string));    
}

function mysql_fix_string($conn, $string) {
    $string = stripslashes($string);
    return $conn->real_escape_string($string);
}


$error = "";

if (isset($_POST['userName'], $_POST['password'])) {
    $userName = $conn->real_escape_string($_POST['userName']);
    $password = $_POST['password'];

    $query = "SELECT userId, passwordHash, role FROM USERS WHERE userName = '$userName'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['passwordHash'])) {
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['userName'] = $userName;

            $conn->query("UPDATE USERS SET lastLogin = NOW() WHERE userId = " . $user['userId']);

            header("Location: home.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST">
            <input type="text" name="userName" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <p><a href="create_account.php">Create an Account here</a>.</p>
    </div>
</body>
</html>
