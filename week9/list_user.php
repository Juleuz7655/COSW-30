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
<?php 
require('mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>List of Website Users</h1>";
//And now to perform a simple query to make sure it's working
$query = "SELECT * FROM USER";
$result = mysqli_query($connection, $query);


echo "<table><thead><td class='center'>ID</td><td>Email Address</td></thead>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
echo "<tr><td class='center'>" . $row['user_id'] . "</td><td>" . $row['email_address'] . "</td></tr>";
}
echo "</table>"; // close table

?>
</body>
</html>