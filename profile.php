<?php
include 'connect.php';
session_start(); 

$userID = $_SESSION['userID'];
if(!isset($userID)){
  header('location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Update"])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $birthdate = $_POST['birthdate'];
        $phonenum = $_POST['phonenum'];
      
        $sql = "UPDATE `tbluserprofile` SET `firstname`='$fname',`lastname`='$lname',`age`='$age',`birthdate`='$birthdate',`phonenumber`='$phonenum' WHERE userID = $userID";
      
        $result = mysqli_query($connection, $sql);
      
        if ($result) {
            header("Location: admin_index.php?msg=Data updated successfully");
            exit(); // Add exit to prevent further execution
        } else {
            echo "Failed: " . mysqli_error($connection);
        }
    }
}

    $sql = "SELECT * FROM `tbluserprofile` WHERE userID = $userID LIMIT 1";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/admin-style.css" />
</head>

<body>
    <div class="edit-userdata">
        <h3 class="edit-header">Edit Profile Information</h3>
        <p class="edit-sub-header">Click update after changing any information</p>

        <?php
            $sql = "SELECT * FROM `tbluserprofile` WHERE userID = $userID LIMIT 1";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>

        <form action="" method="post">
            <div class="edit-inputs">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" class="box" name="fname" value="<?php echo $row['firstname'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="box" name="lname" value="<?php echo $row['lastname'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Birthdate:</label>
                    <input type="date" class="box" name="birthdate" value="<?php echo $row['birthdate'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Age:</label>
                    <input type="number" class="box" name="age" value="<?php echo $row['age'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Phone Number:</label>
                    <input type="tel" class="box" name="phonenum" value="<?php echo $row['phonenumber'] ?>">
                </div>
            </div>
            <div class="update_cancel">
                <button type="button" class="buttons" name="Update" onclick="window.history.back();">Update</button>
                <a href="#" onclick="window.history.back();" class="buttons">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>