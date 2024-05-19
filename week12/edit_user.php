<?php

$pagetitle = "Edit User";

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // print_r($_POST);
        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email_address = $_POST['email_address'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $user_photo = $_POST['user_photo'];
        $status = $_POST['status'];

        $update_query = 
            "UPDATE BLOG_USERS_TBL
            SET first_name = '$first_name',
            last_name = '$last_name',
            email_address = '$email_address',
            password = '$password',
            role = '$role',
            user_photo = '$user_photo',
            status = '$status' 
            WHERE user_id = $user_id";

            echo $update_query;
            
            $update_result = mysqli_query($connection, $update_query);
            if ($update_result){
                echo '<p>This User has been updated, <a href="user.php?id=' . $user_id . '">please review</a> or go to the <a href="list_users.php">user list</a> page.</p>';
                exit;
            } else {
                echo "Failed";
            }

        exit("Testing");
    } else
    {
        $user_id = $_GET['id'];
        $query = "SELECT * FROM BLOG_USERS_TBL WHERE user_id = $user_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        echo "User ID: " . $user_id . " ";
        echo $query;
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
    <form action="edit_user.php" method="post">
        <p>User ID: <?php echo $row['user_id']; ?><input type="hidden" value="<?php echo $row['user_id']; ?>" name="user_id"></p>
        <p>First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required></p>
        <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required></p>
        <p>Email Address: <input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" required></p>
        <p>Password: <input type="text" name="password" value="<?php echo $row['password']; ?>" required></p>
        <p>Profile Picture: <input type="text" name="user_photo" value="<?php echo $row['user_photo']; ?>"></p>
        <p>Role: <select id="role" name="role" required>
            <option value="<?php echo $row['role']; ?>" default><?php echo $row['role']; ?></option>
            <option value="Admin">Admin</option>
            <option value="Contributor">Contributor</option>
        </select></p>
        <p>Status: <select id="status" name="status" required>
            <option value="<?php echo $row['status']; ?>" default><?php if ( $row['status'] == 'A' ){ echo 'Active'; } else { echo 'Inactive'; } ?></option>
            <option value="A">Active (A)</option>
            <option value="I">Inactive (I)</option>
        </select></p>
        <p><input type="submit"></p>
    </form>
</body>
</html>