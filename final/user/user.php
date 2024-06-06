<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="../css/user.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <main>
        <h1><?php echo $pagetitle; ?></h1>
        <div class="user-info">
            <div class="user-photo" style="background-image: url(<?php echo $row['photo']; ?>);">&nbsp;</div>
            <div class="user-details">
                <p><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
                <p>Role: <?php echo $row['role']; ?></p>
                <p>Email: <?php echo $row['email_address']; ?></p>
                <p>Team: <?php echo $row['team']; ?></p>
                <p><a href="edit_user.php?id=<?php echo $user_id;?>">Edit this user</a></p>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Star Wars Space Transit Center</p>
    </footer>
</body>
</html>
