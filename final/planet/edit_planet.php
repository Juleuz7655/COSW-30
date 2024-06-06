<!DOCTYPE html>
<html>
<head>
<title>List Users</title>
<link rel="stylesheet" href="../css/planet.css">
</head>
<body></body>

<?php require("../mysqli_connect.php"); ?>

<?php 
// If this form has been submitted do the update process
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    print_r($_POST);

    $planet_id = $_POST['planet_id'];
    $planet_name = $_POST['planet_name'];
    $planet_status = $_POST['planet_status'];
    $planet_biome = $_POST['planet_biome'];
    $planet_picture = $_POST['planet_picture'];
    $planet_pop = $_POST['planet_pop'];

    $update_query = 
        "UPDATE FINAL_PLANETS
        SET planet_name = '$planet_name',
        planet_status = '$planet_status',
        planet_biome = '$planet_biome',
        planet_picture = '$planet_picture',
        planet_pop = '$planet_pop'
        WHERE planet_id = $planet_id";

    echo $update_query;

    $update_result = mysqli_query($connection, $update_query);
    if ($update_result){
        echo '<h4>Success! The planet has been successfully updated!</h4> <p><a href="planet_list.php">Return to List</a></p>';
        exit;
    }
    else {
        echo "Update failed.";
    }

    exit("Testing");
}
else {
    $planet_id = $_GET['id'];
    $query = "SELECT * FROM FINAL_PLANETS WHERE planet_id = $planet_id";



}

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
?>

<h1>Update Planet</h1>
<form action="edit_planet.php" method="post">
    <p>Planet ID: <input type="text" name="planet_id" readonly value="<?php echo $row['planet_id']; ?>"></p>
    <p>Planet Name: <input type="text" name="planet_name" value="<?php echo $row['planet_name']; ?>" required></p>
    <p>Planet Status: <input type="text" name="planet_status" value="<?php echo $row['planet_status']; ?>" required></p>
    <p>Planet Biome: <input type="text" name="planet_biome" value="<?php echo $row['planet_biome']; ?>" required></p>
    <p>Planet Picture: <input type="text" name="planet_picture" value="<?php echo $row['planet_picture']; ?>" required></p>
    <p>Planet Population: <input type="text" name="planet_pop" value="<?php echo $row['planet_pop']; ?>" required></p>
    <p><input type="submit" value="Update Planet"></p>
</form>
