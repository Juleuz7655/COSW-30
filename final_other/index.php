<?php
session_start();

// Set a default role if not already set
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'User';
}

// Check if the form has been submitted to toggle the role
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_role'])) {
    // Toggle the role between 'Admin' and 'User'
    if ($_SESSION['role'] === 'Admin') {
        $_SESSION['role'] = 'User';
    } else {
        $_SESSION['role'] = 'Admin';
    }
}

// Get the current role
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standard PHP Page</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Space Transit Network</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="logout.php">Logout</a>';
                    } else {
                        echo '<a href="login.php">Login</a>';
                    }
                    ?>
                </li>
                <?php if ($role === 'Admin'): ?>
                    <li><a href="admin.php">Admin Panel</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Current Role: <?= $role; ?></h2>
        <form method="post" action="">
            <input type="hidden" name="toggle_role" value="toggle">
            <button type="submit">
                <?= ($role === 'Admin') ? 'Change Role to User' : 'Change Role to Admin'; ?>
            </button>
        </form>
        <p>This is the main content area.</p>
    </main>

    <footer>
        <p>&copy; 2024 Standard PHP Page. All rights reserved.</p>
    </footer>
</body>
</html>
