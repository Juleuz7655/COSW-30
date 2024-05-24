<html>
    <head>
        <title>Star Wars Space Transit Network</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <header>
            <h1>Space Transit Network</h1>
            <nav>
                <ul>
                    <li><a href="planets.php">Planets</a></li>
                    <li><a href="login.php">Login/Sign Up</a></li>
                    <li><a href="users.php">Users</a></li>
                    <?php if ($role === 'Admin'): ?>
                        <li><a href="list_planets.php">Planet list</a></li>
                        <li><a href="list_user.php">User list</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </header>
        <main>
            <h2><strong>Please login so the Galactic Empire can ensure your safety</strong></h2>
        </main>
    </body>
</html>