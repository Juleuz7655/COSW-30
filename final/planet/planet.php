<?php

$pagetitle = "Planet Information";

require('../mysqli_connect.php'); // use require because we want to force this to exist before running our queries

if ($_SERVER["REQUEST_METHOD"] == "GET")
{
    $planet_id = $_GET['id'];
    $query = "SELECT * FROM FINAL_PLANETS WHERE planet_id = $planet_id";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    echo "Planet ID: " . $planet_id . " ";
    echo $query;
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagetitle; ?></title>
    <link rel="stylesheet" href="../css/planet.css">
</head>
<body>
    <header>
        <?php include 'nav.php'; ?>
    </header>
    <main>
        <h1><?php echo $pagetitle; ?></h1>
        <div class="planet-info">
            <div class="planet-photo" style="background-image: url(<?php echo $row['planet_picture']; ?>);">&nbsp;</div>
            <div class="planet-details">
                <p>Name: <?php echo $row['planet_name']; ?></p>
                <p>Status: <?php echo $row['planet_status']; ?></p>
                <p>Biome: <?php echo $row['planet_biome']; ?></p>
                <p>Population: <?php echo $row['planet_pop']; ?></p>
                <p><a href="edit_planet.php?id=<?php echo $planet_id;?>">Edit this planet</a></p>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Star Wars Space Transit Center</p>
    </footer>
</body>
</html>
