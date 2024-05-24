<?php
require('../mysqli_connect.php'); // Include the database connection file

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Validate and upload the file:
    if (isset($_FILES['photo'])) {

        // Define the directory where the file will be saved
        $target_dir = "uploads/";

        // Check if the uploads directory exists, if not create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Define the target file path
        $target_file = $target_dir . basename($_FILES['photo']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo '<p class="error">File is not an image.</p>';
            $uploadOk = 0;
        }

        // Check file size (limit to 750KB)
        if ($_FILES['photo']['size'] > 750000) {
            echo '<p class="error">Sorry, your file is too large.</p>';
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
            echo '<p class="error">Sorry, only JPG, JPEG, & PNG files are allowed.</p>';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo '<p class="error">Sorry, your file was not uploaded.</p>';
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                echo '<p><em>The file has been uploaded!</em></p>';
                $photo_path = $target_file;

                // Insert the user data into the database
                $stmt = $connection->prepare("INSERT INTO FINAL_PERSON (first_name, last_name, email_address, role, photo, status, team) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $first_name, $last_name, $email_address, $role, $photo_path, $status, $team);

                // Set the values for the variables
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email_address = $_POST['email_address'];
                $role = $_POST['role'];
                $status = $_POST['status'];
                $team = $_POST['team'];

                if ($stmt->execute()) {
                    echo '<p>New record created successfully.</p>';
                } else {
                    echo '<p class="error">Error: ' . $stmt->error . '</p>';
                }

                $stmt->close();
                $connection->close();

            } else {
                echo '<p class="error">Sorry, there was an error uploading your file.</p>';
            }
        }
    } else {
        echo '<p class="error">No file was uploaded.</p>';
    }

    // Check for an error:
    if ($_FILES['photo']['error'] > 0) {
        echo '<p class="error">The file could not be uploaded because: <strong>';

        // Print a message based upon the error.
        switch ($_FILES['photo']['error']) {
            case 1:
                print 'The file exceeds the upload_max_filesize setting in php.ini.';
                break;
            case 2:
                print 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
                break;
            case 3:
                print 'The file was only partially uploaded.';
                break;
            case 4:
                print 'No file was uploaded.';
                break;
            case 6:
                print 'No temporary folder was available.';
                break;
            case 7:
                print 'Unable to write to the disk.';
                break;
            case 8:
                print 'File upload stopped.';
                break;
            default:
                print 'A system error occurred.';
                break;
        } // End of switch.

        print '</strong></p>';

    } // End of error IF.

    // Delete the file if it still exists:
    if (file_exists($_FILES['photo']['tmp_name']) && is_file($_FILES['photo']['tmp_name'])) {
        unlink($_FILES['photo']['tmp_name']);
    }

} // End of the submitted conditional.
?>
