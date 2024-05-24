<?php
require('../mysqli_connect.php');


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


$stmt = $connection->prepare("INSERT INTO FINAL_PERSON (first_name, last_name, email_address, role, photo, status) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $first_name, $last_name, $email_address, $role, $photo, $status);


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$role = $_POST['role'];
$photo = $_POST['photo'];
$status = $_POST['status'];

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>