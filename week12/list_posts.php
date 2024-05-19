<!DOCTYPE html>
<html>
<head>
<title>List Users</title>
<style>
td {
width: 100px;
}
thead {
font-weight: bold;
}
.center {
text-align:center;
}

</style>
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
<?php 
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>List of Posts</h1>";
//And now to perform a simple query to make sure it's working
$query = "SELECT * FROM BLOG_POSTS_TBL";
$result = mysqli_query($connection, $query);

echo "<table><thead><td class='center'>ID</td><td>Post Title</td><td>Action</td></thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td class='center'>" . $row['post_id'] . "</td><td>" . $row['post_title'] . "</td><td><a href='post.php?id=" . $row['post_id'] . "'>View</a> / <a href='edit_post.php?id=" . $row['post_id'] . "'>Edit</a></tr>";
}
echo "</table>"; // close table

?>
</body>