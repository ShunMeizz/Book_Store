<?php
include 'connect.php';
$id = $_GET["id"];

$sql = "DELETE FROM `tbluseraccount` WHERE acctID = $id";
$result = mysqli_query($connection, $sql);

if ($result) {
  header("Location: admin_index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}