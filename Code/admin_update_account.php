<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$userQuery = "SELECT * FROM USERS";
$result = $conn->query($userQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['userId']) ? (int)$_POST['userId'] : 0;
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $role = isset($_POST['role']) ? trim($_POST['role']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $shippingAddress = isset($_POST['shippingAddress']) ? trim($_POST['shippingAddress']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if ($userId && $firstName && $lastName && $email && $role && $username && $shippingAddress) {
        if (!empty($password)) {
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE USERS SET firstName = ?, lastName = ?, email = ?, role = ?, username = ?, shippingAddress = ?, passwordHash = ? WHERE userId = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sssssssi", $firstName, $lastName, $email, $role, $username, $shippingAddress, $passwordHash, $userId);
        } else {
            $updateQuery = "UPDATE USERS SET firstName = ?, lastName = ?, email = ?, role = ?, username = ?, shippingAddress = ? WHERE userId = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("ssssssi", $firstName, $lastName, $email, $role, $username, $shippingAddress, $userId);
        }

        if ($stmt->execute()) {
            $message = "User updated successfully.";
        } else {
            $message = "Error updating user: " . $stmt->error;
        }
    } else {
        $message = "Please fill in all required fields.";
    }
}
?>

<html>
<head>
    <title>Update User Accounts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="manage_users.php">Back to Manage Users</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Update User Accounts</h1>

    <?php if (isset($message)): ?>
        <p style="color: <?php echo strpos($message, 'successfully') !== false ? 'green' : 'red'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
                <th>Shipping Address</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <form method="POST" action="admin_update_account.php">
                        <td><?php echo $user['userId']; ?>
                            <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
                        </td>
                        <td>
                            <input type="text" name="firstName" value="<?php echo htmlspecialchars($user['firstName'] ?? ''); ?>" required>
                        </td>
                        <td>
                            <input type="text" name="lastName" value="<?php echo htmlspecialchars($user['lastName'] ?? ''); ?>" required>
                        </td>
                        <td>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                        </td>
                        <td>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" required>
                        </td>
                        <td>
                            <input type="password" name="password" placeholder="Leave blank to keep current password">
                        </td>
                        <td>
                            <input type="text" name="shippingAddress" value="<?php echo htmlspecialchars($user['shippingAddress'] ?? ''); ?>" required>
                        </td>
                        <td>
                            <select name="role" required>
                                <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                            </select>
                        </td>
                        <td>
                            <button type="submit">Update</button>
                        </td>
                    </form>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
