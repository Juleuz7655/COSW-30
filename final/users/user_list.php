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
<!--    <header>
        <?php// include 'nav.php'; ?>
    </header>
-->
<?php 
require('../mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>List of Website Users</h1>";
//And now to perform a simple query to make sure it's working
$query_active = "SELECT * FROM FINAL PERSON WHERE TEAM = 'neutral'";
$result_active = mysqli_query($connection, $query_active);

echo "<h2>Neutral Users</h2>";
echo "<table><thead><td class='center'>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Role</td><td>Status</td><td>Action</td><td>Team</td></thead>"; // open table and include table headings

while ($row_neutral = mysqli_fetch_assoc($result_active)) {
echo "<tr><td class='center'>" . $row_neutral['user_id'] . "</td><td>" . $row_neutral['first_name'] . "</td><td>" . $row_neutral['last_name'] . "</td><td>" . $row_neutral['email_address'] . "</td><td>" . $row_neutral['role'] . "</td><td>" . "</td><td>" . $row_neutral['status'] . $row_neutral['team'] . "</td><td><a href='user.php?id=" . $row_neutral['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_neutral['user_id'] . "'>Edit</a></td></tr>";
}
echo "</table>"; // close table


//Table for Inactive Users
//And now to perform a simple query to make sure it's working
$query_inactive = "SELECT * FROM FINAL PERSON WHERE TEAM = 'light'";
$result_inactive = mysqli_query($connection, $query_inactive);

echo "<h2>Light Users</h2>";
echo "<table><thead><td class='center'>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Role</td><td>Status</td><td>Action</td><td>Team</td></thead>"; // open table and include table headings

while ($row_light = mysqli_fetch_assoc($result_inactive)) {
echo "<tr><td class='center'>" . $row_light['user_id'] . "</td><td>" . $row_light['first_name'] . "</td><td>" . $row_light['last_name'] . "</td><td>" . $row_light['email_address'] . "</td><td>" . $row_light['role'] . "</td><td>" . $row_light['status'] . "</td><td>" . $row_neutral['team'] . "</td><td><a href='user.php?id=" . $row_light['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_light['user_id'] . "'>Edit</a></td></tr>";
}
echo "</table>"; // close table

$query_dark = "SELECT * FROM FINAL PERSON WHERE TEAM = 'dark'";
$result_dark = mysqli_query($connection, $query_dark);

echo "<h2>Dark Users</h2>";
echo "<table><thead><td class='center'>ID</td><td>First Name</td><td>Last Name</td><td>Email Address</td><td>Role</td><td>Status</td><td>Action</td><td>Team</td></thead>"; // open table and include table headings

while ($row_dark = mysqli_fetch_assoc($result_dark)) {
echo "<tr><td class='center'>" . $row_dark['user_id'] . "</td><td>" . $row_dark['first_name'] . "</td><td>" . $row_dark['last_name'] . "</td><td>" . $row_dark['email_address'] . "</td><td>" . $row_dark['role'] . "</td><td>" . $row_dark['status'] . "</td><td>" . $row_dark['team'] . "</td><td><a href='user.php?id=" . $row_dark['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_dark['user_id'] . "'>Edit</a></td></tr>";
}
echo "</table>"; // close table

?>
</body>
</html>