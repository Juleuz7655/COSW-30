<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>
    <h1>Update User</h1>
    <main>
        <?php 
        // Include your PHP script here

        require("../mysqli_connect.php");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $user_id = $_POST['user_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email_address = $_POST['email_address'];
            $role = $_POST['role'];
            $team = $_POST['team'];
            $photo = $_POST['current_photo']; // Default to the current photo

            // Handle file upload if a new file is provided
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
                $target_dir = "uploads/";

                // Check if the uploads directory exists, if not, create it
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true); // Create directory with read/write/execute permissions
                }

                $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if image file is an actual image or fake image
                $check = getimagesize($_FILES["photo"]["tmp_name"]);
                if ($check !== false) {
                    // Check file size (limit to 5MB)
                    if ($_FILES["photo"]["size"] <= 5000000) {
                        // Allow certain file formats
                        if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
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

            // Update query
            $update_query = 
                "UPDATE FINAL_USERS
                SET first_name = '$first_name',
                last_name = '$last_name',
                email_address = '$email_address',
                role = '$role',
                photo = '$photo',
                team = '$team'
                WHERE user_id = $user_id";

            $update_result = mysqli_query($connection, $update_query);
            if ($update_result){
                echo '<h4>Success! The user has been successfully updated!</h4> <p><a href="user_list.php">Return to List</a></p>';
                exit;
            } else {
                echo "Update failed.";
            }
        }
        else {
            $user_id = $_GET['id'];
            $query = "SELECT * FROM FINAL_USERS WHERE user_id = $user_id";
        }

        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        ?>

        <form action="edit_user.php" method="post" enctype="multipart/form-data">
            <p>User ID: <input type="text" name="user_id" readonly value="<?php echo $row['user_id']; ?>"></p>
            <p>First Name: <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required></p>
            <p>Last Name: <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required></p>
            <p>Email Address: <input type="text" name="email_address" value="<?php echo $row['email_address']; ?>" required></p>
            <label for="role">Role:</label><br>
            <select id="role" name="role" required>
                <option value="User" <?php if ($row['role'] == 'User') echo 'selected'; ?>>User</option>
                <option value="Admin" <?php if ($row['role'] == 'Admin') echo 'selected'; ?>>Admin</option>
            </select><br><br>
            <label for="team">Team:</label><br>
            <select id="team" name="team" required>
                <option value="Light" <?php if ($row['team'] == 'Light') echo 'selected'; ?>>Light</option>
                <option value="Dark" <?php if ($row['team'] == 'Dark') echo 'selected'; ?>>Dark</option>
                <option value="Neutral" <?php if ($row['team'] == 'Neutral') echo 'selected'; ?>>Neutral</option>
            </select><br><br>
            <p>Current Photo: <img src="<?php echo $row['photo']; ?>" alt="User Photo" width="100"><br>
            <input type="hidden" name="current_photo" value="<?php echo $row['photo']; ?>"></p>
            <p>New Photo: <input type="file" name="photo"></p>
            <p><input type="submit" value="Update User"></p>
        </form>
    </main>
    <footer>
        <p class="text-muted">&copy; 2024 Star Wars Space Transit Center</p>
    </footer>
</body>
</html>
