<?php
session_start();

include('includes/header.html');

$first_name = isset($_SESSION['first_name']) ? $_session['first_name'] : '';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>


    <main>
        <h2></h2>
    </main>

    <?php include('includes/footer.html'); ?>
