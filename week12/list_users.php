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

echo "<h1>List of Website Users</h1>";
//And now to perform a simple query to make sure it's working
$query_active = "SELECT * FROM BLOG_USERS_TBL WHERE STATUS = 'A'";
$result_active = mysqli_query($connection, $query_active);

echo "<h2>Active Users</h2>";
echo "<table><thead><td class='center'>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Role</td><td>Status</td><td>Action</td></thead>"; // open table and include table headings

while ($row_active = mysqli_fetch_assoc($result_active)) {
echo "<tr><td class='center'>" . $row_active['user_id'] . "</td><td>" . $row_active['first_name'] . "</td><td>" . $row_active['last_name'] . "</td><td>" . $row_active['email_address'] . "</td><td>" . $row_active['role'] . "</td><td>" . $row_active['status'] . "</td><td><a href='user.php?id=" . $row_active['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_active['user_id'] . "'>Edit</a></td></tr>";
}
echo "</table>"; // close table


//Table for Inactive Users
//And now to perform a simple query to make sure it's working
$query_inactive = "SELECT * FROM BLOG_USERS_TBL WHERE STATUS = 'I'";
$result_inactive = mysqli_query($connection, $query_inactive);

echo "<h2>Inactive Users</h2>";
echo "<table><thead><td class='center'>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Role</td><td>Status</td><td>Action</td></thead>"; // open table and include table headings

while ($row_inactive = mysqli_fetch_assoc($result_inactive)) {
echo "<tr><td class='center'>" . $row_inactive['user_id'] . "</td><td>" . $row_inactive['first_name'] . "</td><td>" . $row_inactive['last_name'] . "</td><td>" . $row_inactive['email_address'] . "</td><td>" . $row_inactive['role'] . "</td><td>" . $row_inactive['status'] . "</td><td><a href='user.php?id=" . $row_inactive['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_inactive['user_id'] . "'>Edit</a></td></tr>";
}
echo "</table>"; // close table



?>
</body>
</html>