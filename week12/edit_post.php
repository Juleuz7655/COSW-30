<?php
// Create a variable that is used for the <title> tag and for the <h1> if you want them to match.
$pagetitle = "Edit Post";

// Sets the timezone for the date time stamp for the modified date field
date_default_timezone_set("America/Los_Angeles");

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $post_id = $_POST['post_id'];
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $modified_date = $_POST['modified_date'];

    // Prepare the SQL statement with placeholders
    $update_query = $connection->prepare("UPDATE BLOG_POSTS_TBL SET post_title = ?, post_content = ?, modified_date = ? WHERE post_id = ?");

    // Check if the preparation was successful
    if ($update_query === false) {
        die("Prepare failed: " . $connection->error);
    }

    // Bind parameters to the statement
    $update_query->bind_param("sssi", $post_title, $post_content, $modified_date, $post_id);

    // Execute the statement
    $update_query->execute();

    // Check if the execution was successful
    if ($update_query === false) {
        die("Execute failed: " . $update_query->error);
    }

    // Close the statement
    $update_query->close();

    // Redirect after successful update
    header("Location: post.php?id=$post_id");
    exit;
} else {
    // Display the form for editing
    $post_id = $_GET['id'];
    $query = "SELECT * FROM BLOG_POSTS_TBL WHERE post_id = $post_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
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
    <form action="edit_post.php" method="post">
        <p>Post ID: <?php echo $row['post_id']; ?><input type="hidden" value="<?php echo $row['post_id']; ?>" name="post_id"></p>
        <p>Post Title: <input type="text" name="post_title" value="<?php echo $row['post_title']; ?>" required></p>
        <p>Post Content:<br />
        <textarea name="post_content" rows="10" cols="30"><?php echo $row['post_content']; ?></textarea><br />
        <input type="hidden" name="modified_date" value="<?php echo date("Y-m-d H:i:s"); ?>">
        <p><input type="submit"></p>
    </form>
</body>
</html>