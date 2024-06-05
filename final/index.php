<?php
session_start();

include('includes/header.html');

$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars Space Transit Network</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Space Transit Network</h1>
        <nav>
            <ul>
                <li><a href="planets.php">Planets</a></li>
                <li>
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<a href="logout.php">Logout</a>';
                    } else {
                        echo '<a href="login.php">Login</a>';
                    }
                    ?>
                </li>
                <li><a href="users/user_list.php">Users</a></li>
                <?php if ($role === 'Admin'): ?>
                    <li><a href="list_planets.php">Planet list</a></li>
                    <li><a href="list_user.php">User list</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <p>Hello there...</p>
    </main>

    <?php include('includes/footer.html'); ?>
</body>
</html>
