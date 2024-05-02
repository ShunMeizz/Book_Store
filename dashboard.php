<?php
session_start();
include 'connect.php';

$mysqli = new mysqli('localhost', 'root', '', 'dbsebialf2') or die(mysqli_error($mysqli));
$resultset = $mysqli->query("SELECT * FROM tbluserprofile") or die($mysqli->error);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<body>
<h2>Dashboard</h2>

<table style="width:100%">
    <tr>
        <th>Seq Number</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Birthdate</th>
        <th>Age</th>
        <th>Phone Number</th>
        <th>Address</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $resultset->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['userID']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['birthdate']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['phonenumber']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><!-- Add action buttons here if needed --></td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

