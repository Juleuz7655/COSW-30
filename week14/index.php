<?php include('includes/header.html');?>


<?php
// Just to make sure if session_start is active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



?>



<?php
"<p>Welcome, {$_SESSION['first_name']}!</p>"
?>
<?php include('includes/footer.html');?>
