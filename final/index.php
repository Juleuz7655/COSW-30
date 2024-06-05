<?php
session_start();

include('includes/header.html');

$first_name = isset($_SESSION['first_name']) ? $_session['first_name'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Wars Space Transit Network</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>


    <main>
        <h2></h2>
    </main>

    <?php include('includes/footer.html'); ?>
</body>
</html>
