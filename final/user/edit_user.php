<?php require("../mysqli_connect.php"); ?>

<?php 
// If this form has been submitted do the update process
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    print_r($_POST);

    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $role = $_POST['role'];
    $photo = $_POST['photo'];
    $team = $_POST['team'];

    $update_query = 
        "UPDATE FINAL_USERS
        SET first_name = '$first_name',
        last_name = '$last_name',
        email_address = '$email_address',
        role = '$role',
        photo = '$photo',
        team = '$team'
        WHERE user_id = $user_id";

    echo $update_query;

    $update_result = mysqli_query($connection, $update_query);
    if ($update_result){
        echo '<h4>Success! The user has been successfully updated!</h4> <p><a href="user_list.php">Return to List</a></p>';
        exit;
    }
    else {
        echo "Update failed.";
    }

    exit("Testing");
}
else {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM FINAL_USERS WHERE user_id = $user_id";

    // USER TESTING
    echo $user_id;
    echo $query;
}

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
?>

<h1>Update User</h1>
<form action="edit_user.php" method="post">
    <p>User ID: <input type="text" name="user_id" readonly value="<?php echo $row['user_id']; ?>"></p>
    <p>First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required></p>
    <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required></p>
    <p>Email Address: <input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" required></p>
    <p>Role: <input type="text" name="role" value="<?php echo $row['role']; ?>" required></p>
    <p>Photo: <input type="text" name="photo" value="<?php echo $row['photo']; ?>"></p>
    <p>Team: <input type="text" name="team" value="<?php echo $row['team']; ?>" required></p>
    <p><input type="submit" value="Update User"></p>
</form>
