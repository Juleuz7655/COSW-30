<?php
session_start();

include('includes/header.html');

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'User';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_role'])) {
    if ($_SESSION['role'] === 'Admin') {
        $_SESSION['role'] = 'User';
    } else {
        $_SESSION['role'] = 'Admin';
    }
}

$role = $_SESSION['role'];
?>


    <main>
        <h2></h2>
    </main>

    <?php include('includes/footer.html'); ?>
