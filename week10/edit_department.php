<?php require("mysqli_connect.php"); ?>


<?php 
// If this form has been submitted do the update process
if ($SERVER["REQUEST_METHOD"] == "POST") {

    print_r($_POST);

    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name'];
    $num_of_employees = $_POST['num_of_employees'];
    $building_number = $_POST['building_number'];
    $status = $_POST['status'];

    $update_query = 
        "UPDATE DEPARTMENT
        SET department_name = '$department_name',
        num_of_employees = '$num_of_employees',
        building_number = '$building_numbear',
        status = '$status'
        WHERE department_id = $department_id";

    echo $update_query

    exit("Testing");

}

else {
    $department_id = $_GET['id'];
    $query = "SELECT * FROM DEPARTMENTS WHERE department_id = $department_id";

    // USER TESTING
    echo $department_id;
    echo $query;
}
// $result = mysqli_query($connection, $query);
// $row = mysqli_fetch_array($result);
?>

<h1>Update Department</h1>
<form action="edit_department.php" method="post">
    <p>Department ID: <input type="text" name="department_id" readonly value="<?php echo $row['department_id']; ?>"></p>
    <p>Department Name: <input type="text" name="department_name" value="<?php echo $row['department_name']; ?>" required></p>
    <p>Number of Employees: <input type="text" name="num_of_employees" value="<?php echo $row['num_of_employees']; ?>" required></p>
    <p>Building Number: <input type="text" name="building_number" value="<?php echo $row['building_number']; ?>" required></p>
    <p>Status: <input type="text" name="status" value="<?php echo $row['status']; ?>" required></p>
    <p><input type="submit" value="Update Department"></p>
</form>