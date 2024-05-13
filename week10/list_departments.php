<!Doctype html>
<html>
    <head>
        <title>List Departments</title>
        <style> 
        td {
            width: 100px;
        }
        thead {
            font-weight: bold;
        }
        .center {
            text-align: center;
        }
        </style>
    </head>
    <body>
        <?php
        require('mysqli_connect.php');
        
        echo "<h1> List of Departments";

        $query = "SELECT * FROM DEPARTMENT ORDER BY department_name";
        $result = mysqli_query($connection, $query);

        echo "<table><thead><td class ='center'> Department ID<td><td>Department Name</td><td>Number of Employees</td><td>Building Number</td><td>Status</td></thead>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td class= 'center'>" . $row['department_id']. "</td><td>" . $row['department_name'] . "</td><td>" . $row['num_of_employees']
            . "</td><td>" . $row['building_number'] . "</td><td>" . $row['status'] . "</td></tr>";
        }
        echo "/table";
        ?>
        <p> <a href="../week9/list_user.php">List Users</a></p>

    </body>
</html>
