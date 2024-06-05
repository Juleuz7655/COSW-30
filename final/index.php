<?php include('includes/header.html'); ?>

<main>
<?php
// Just to make sure if session_start is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['first_name'])) {
    echo "<p>Welcome, {$_SESSION['first_name']}!</p>";
} else {
    echo "<p>Welcome, Guest! Please <a href='login.php'>log in</a> or <a href='register.php'>register</a> so the Galactic Empire can ensure your safety.</p>";
}
?>
</main>

<?php include('includes/footer.html'); ?>
