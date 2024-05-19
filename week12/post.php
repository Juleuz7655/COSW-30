<?php

$pagetitle = "Posts";

require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $post_id = $_GET['id'];
        $query = "SELECT * FROM BLOG_POSTS_TBL WHERE post_id = $post_id";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        echo "post ID: " . $post_id . " ";
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
    <h2><?php echo $row['post_title']; ?></h2>
    <?php echo $row['post_content']; ?>
    <p><a href="edit_post.php?id=<?php echo $post_id;?>">Edit this post</a></p>
</body>
</html>