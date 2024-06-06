<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'mysqli_connect.php'; // Ensure this file sets up $connection properly

    // Check if the connection was successful
    if (!isset($connection) || !$connection) {
        die("Database connection failed.");
    }

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $role = $_POST['role'];
    $team = $_POST['team'];
    $password = $_POST['password']; // Storing password as plain text (not recommended for production)
    $photo = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (limit to 5MB)
            if ($_FILES["photo"]["size"] <= 5000000) {
                // Allow certain file formats
                if (in_array($imageFileType, ['jpg', 'png', 'jpeg'])) {
                    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                        $photo = $target_file;
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo "File is not an image.";
        }
    }

    // Prepare and bind
    $stmt = $connection->prepare("INSERT INTO FINAL_USERS (first_name, last_name, email_address, role, team, password, photo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssss", $first_name, $last_name, $email_address, $role, $team, $password, $photo);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New user registered successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $connection->error;
    }

    // Close the connection
    $connection->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<?php include('includes/header.html'); ?>

<body>
    <h2>User Registration</h2>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <label for="email_address">Email:</label><br>
        <input type="email" id="email_address" name="email_address" required><br><br>
        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="User">User</option>
            <option value="Admin">Admin</option>
        </select><br><br>
        <label for="team">Team:</label><br>
        <select id="team" name="team" required>
            <option value="Light">Light</option>
            <option value="Dark">Dark</option>
            <option value="Neutral">Neutral</option>
        </select><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <label for="photo">Photo:</label><br>
        <input type="file" id="photo" name="photo"><br><br>
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
<?php include('includes/footer.html'); ?>
