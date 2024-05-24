<?php

$pagetitle = "Edit User";
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Print the POST data for debugging
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $photo = $_POST['photo'];
    $status = $_POST['status'];

    // Prepared statement for updating the user
    $update_query = "UPDATE FINAL_PERSON SET first_name = ?, last_name = ?, email_address = ?, password = ?, role = ?, photo = ?, status = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $first_name, $last_name, $email_address, $password, $role, $photo, $status, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo '<p>This User has been updated, <a href="user.php?id=' . $user_id . '">please review</a> or go to the <a href="list_users.php">user list</a> page.</p>';
        exit;
    } else {
        echo "Failed to update user: " . mysqli_error($connection);
    }
} else {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM FINAL_PERSON WHERE user_id = $user_id";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_array($result);
    } else {
        echo "Failed to retrieve user: " . mysqli_error($connection);
        exit;
    }
}
?>

<html>
<head>
    <title>Login/Sign Up</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <h1>Login/Sign Up</h1>
    </header>
    <main>
        <form action="login.php" method="post">
            <p>User ID: <?php echo $row['user_id']; ?><input type="hidden" value="<?php echo $row['user_id']; ?>" name="user_id"></p>
            <p>First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required></p>
            <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required></p>
            <p>Email Address: <input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" required></p>
            <p>Password: <input type="text" name="password" value="<?php echo $row['password']; ?>" required></p>
            <p>Profile Picture: <input type="text" name="photo" value="<?php echo $row['photo']; ?>"></p>
            <p>Role:
                <select id="role" name="role" required>
                    <option value="<?php echo $row['role']; ?>" default><?php echo $row['role']; ?></option>
                    <option value="Admin">Admin</option>
                    <option value="Contributor">Contributor</option>
                </select>
            </p>
            <p>Status: <select id="status" name="status" required>
                <option value="<?php echo $row['status']; ?>" default><?php if ($row['status'] == 'A') { echo 'Active'; } else { echo 'Inactive'; } ?></option>
                <option value="A">Active (A)</option>
                <option value="I">Inactive (I)</option>
            </select></p>
            <p><input type="submit"></p>
        </form>
    </main>
</body>
</html>
