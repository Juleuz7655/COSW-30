<!DOCTYPE html>
<html>
<head>
    <title>List Planets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        thead {
            font-weight: bold;
            background-color: #333;
            color: white;
        }

        td, th {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .neutral-planets tbody tr {
            background-color: #ccc;
        }

        .light-planets tbody tr {
            background-color: #fff;
        }

        .dark-planets tbody tr {
            background-color: #333;
            color: white;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
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
    echo "<tr class='" . strtolower($row['planet_status']) . "-planets'><td class='center'>" . $row['planet_id'] . "</td><td>" . $row['planet_name'] . "</td><td>" . $row['planet_status'] . "</td><td>" . $row['planet_biome'] . "' alt='" . $row['planet_name'] . "' style='width:50px;height:50px;'></td><td>" . $row['planet_pop'] . "</td><td><a href='planet.php?id=" . $row['planet_id'] . "'>View</a> / <a href='edit_planet.php?id=" . $row['planet_id'] . "'>Edit</a></td></tr>";
}
echo "</tbody></table>"; // close table

?>
</body>
</html>
