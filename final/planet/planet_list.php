<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Star Wars Space Transit Center</title>
<link href="../css/planet_list.css" rel="stylesheet">
</head>
<body>
<h1>Star Wars Transit Center</h1>
<nav>
		<ul>
			<li><a href="../index.php">Home</a></li>
			<li><a href="../register.php">Register</a></li>
			<li><a href="../user/user_list.php">View Users</a></li>
			<li><a href="planet_list.php">View Planets</a></li>
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
<!-- Script 12.10 - header.html -->
<body>
<?php 
require('../mysqli_connect.php'); // use require because we want to force this to exist before running our queries

echo "<h1>List of Planets</h1>";

$query = "SELECT * FROM FINAL_PLANETS";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

echo "<table><thead><tr><td class='center'>ID</td><td>Name</td><td>Status</td><td>Biome</td><td>Population</td><td>Action</td></tr></thead><tbody>"; // open table and include table headings

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='" . strtolower($row['planet_status']) . "-planets'><td class='center'>" . $row['planet_id'] . "</td><td>" . $row['planet_name'] . "</td><td>" . $row['planet_status'] . "</td><td>" . $row['planet_biome'] . "</td><td>" . $row['planet_pop'] . "</td><td><a href='planet.php?id=" . $row['planet_id'] . "'>View</a> / <a href='edit_planet.php?id=" . $row['planet_id'] . "'>Edit</a></td></tr>";
}
echo "</tbody></table>"; // close table

?>
</body>
</html>
