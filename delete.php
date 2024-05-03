<?php
include 'connect.php';
$id = $_GET["id"];

$sql = "DELETE tbluseraccount, tbluserprofile FROM tbluseraccount INNER JOIN tbluserprofile ON tbluseraccount.userID = tbluserprofile.userID WHERE tbluseraccount.userID = $id";
$result = mysqli_query($connection, $sql);

if ($result) {
  header("Location: admin_index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($connection);
}