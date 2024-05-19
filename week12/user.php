<?php

$pagetitle = "User Information";

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $user_id = $_GET['id'];
        $query = "SELECT * FROM BLOG_USERS_TBL WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        echo "user ID: " . $user_id . " ";
        echo $query;
        } else {
            echo "wasn't me";
        }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle; ?></title>
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <h1><?php echo $pagetitle; ?></h1>
    <p style="background: url(<? echo $row['user_photo']; ?>); background-position: center; background-size: cover; border-radius: 50px; height: 100px; width: 100px">&nbsp;</p>
    <p><?php echo $row['first_name']  . ' ' . $row['last_name'] . ', ' . $row['role']; ?><br />
    <?php echo $row['email_address']; ?>, <?php if ($row['status'] == 'A') { echo 'Active'; } else { echo 'Inactive'; }; ?>
    <p><a href="edit_user.php?id=<?php echo $user_id;?>">Edit this user</a></p>
</body>
</html>