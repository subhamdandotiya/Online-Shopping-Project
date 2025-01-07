<?php
session_start();
require_once 'dbinfo.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$userQuery = "SELECT * FROM USERS";
$result = $conn->query($userQuery);
?>

<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="logout.php">Logout</a>
    </div>

    <h1>Manage Users</h1>

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['success']); ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>

    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['userId']; ?></td>
                    <td><?php echo htmlspecialchars($user['firstName']); ?></td>
                    <td><?php echo htmlspecialchars($user['lastName']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <form method="GET" action="admin_update_account.php" style="display: inline;">
                            <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
                            <button type="submit" style="background-color: blue; color: white;">Update</button>
                        </form>

                        <form method="POST" action="admin_delete_account.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this account?');">
                            <input type="hidden" name="userId" value="<?php echo $user['userId']; ?>">
                            <button type="submit" style="background-color: blue; color: white;">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
