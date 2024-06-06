<!DOCTYPE html>
<html>
<head>
<title>List Users</title>
<link rel="stylesheet" href="../css/user_list.css">
</head>
<body>
<nav>
		<ul>
			<li><a href="../index.php">Home</a></li>
			<li><a href="../register.php">Register</a></li>
			<li><a href="../user/user_list.php">View Users</a></li>
			<li><a href="../planet/planet_list.php">View Planets</a></li>
			<li><?php // Create a login/logout link:
			if (isset($_SESSION['user_id'])) {
				echo '<a href="../logout.php">Logout</a>';
			} else {
				echo '<a href="../login.php">Login</a>';
			}
			?>
			</li>
		</ul>
</nav>
<?php 
 require('../mysqli_connect.php'); // Use require because we want to force this to exist before running our queries

echo "<h1>List of Website Users</h1>";

// Neutral Users
$query_neutral = "SELECT * FROM FINAL_USERS WHERE TEAM = 'Neutral'";
$result_neutral = mysqli_query($connection, $query_neutral);

echo '<div class="neutral-users">';
echo "<h2>Neutral Users</h2>";
echo "<table><thead><tr><th class='center'>ID</th><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Role</th><th>Team</th><th>Photo</th><th>Action</th></tr></thead><tbody>"; // open table and include table headings

while ($row_neutral = mysqli_fetch_assoc($result_neutral)) {
    echo "<tr><td class='center'>" . $row_neutral['user_id'] . "</td><td>" . $row_neutral['first_name'] . "</td><td>" . $row_neutral['last_name'] . "</td><td>" . $row_neutral['email_address'] . "</td><td>" . $row_neutral['role'] . "</td><td>" . $row_neutral['team'] . "</td><td><img src='" . $row_neutral['photo'] . "' alt='User Photo' width='50'></td><td><a href='user.php?id=" . $row_neutral['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_neutral['user_id'] . "'>Edit</a></td></tr>";
}
echo "</tbody></table>"; // close table
echo '</div>'; // close div

// Light Users
$query_light = "SELECT * FROM FINAL_USERS WHERE TEAM = 'Light'";
$result_light = mysqli_query($connection, $query_light);

echo '<div class="light-users">';
echo "<h2>Light Users</h2>";
echo "<table><thead><tr><th class='center'>ID</th><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Role</th><th>Team</th><th>Photo</th><th>Action</th></tr></thead><tbody>"; // open table and include table headings

while ($row_light = mysqli_fetch_assoc($result_light)) {
    echo "<tr><td class='center'>" . $row_light['user_id'] . "</td><td>" . $row_light['first_name'] . "</td><td>" . $row_light['last_name'] . "</td><td>" . $row_light['email_address'] . "</td><td>" . $row_light['role'] . "</td><td>" . $row_light['team'] . "</td><td><img src='" . $row_light['photo'] . "' alt='User Photo' width='50'></td><td><a href='user.php?id=" . $row_light['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_light['user_id'] . "'>Edit</a></td></tr>";
}
echo "</tbody></table>"; // close table
echo '</div>'; // close div

// Dark Users
$query_dark = "SELECT * FROM FINAL_USERS WHERE TEAM = 'Dark'";
$result_dark = mysqli_query($connection, $query_dark);

echo '<div class="dark-users">';
echo "<h2>Dark Users</h2>";
echo "<table><thead><tr><th class='center'>ID</th><th>First Name</th><th>Last Name</th><th>Email Address</th><th>Role</th><th>Team</th><th>Photo</th><th>Action</th></tr></thead><tbody>"; // open table and include table headings

while ($row_dark = mysqli_fetch_assoc($result_dark)) {
    echo "<tr><td class='center'>" . $row_dark['user_id'] . "</td><td>" . $row_dark['first_name'] . "</td><td>" . $row_dark['last_name'] . "</td><td>" . $row_dark['email_address'] . "</td><td>" . $row_dark['role'] . "</td><td>" . $row_dark['team'] . "</td><td><img src='" . $row_dark['photo'] . "' alt='User Photo' width='50'></td><td><a href='user.php?id=" . $row_dark['user_id'] . "'>View</a> / <a href='edit_user.php?id=" . $row_dark['user_id'] . "'>Edit</a></td></tr>";
}
echo "</tbody></table>"; // close table
echo '</div>'; // close div

?>

</body>
</html>
