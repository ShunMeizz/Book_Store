<?php
include 'connect.php';
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $password = $_POST['password'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $type = $_POST['acct_type'];
  $status = $_POST['status'];

  $sql = "UPDATE `tbluseraccount` SET `emailadd`='$email',`username`='$username',`acct_type`='$type',`password`='$password',`status`='$status' WHERE acctID = $id";

  $result = mysqli_query($connection, $sql);

  if ($result) {
    header("Location: admin_index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($connection);
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Application</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/admin-style.css" />
</head>

<body>
    <div class="edit-userdata">
        <h3 class="edit-header">Edit User Information</h3>
        <p class="edit-sub-header">Click update after changing any information</p>

        <?php
            $sql = "SELECT * FROM `tbluseraccount` WHERE acctID = $id LIMIT 1";
            $result = mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>

        <form action="" method="post">
            <div class="edit-inputs">
                <div class="col">
                    <label class="form-label">Email Address:</label>
                    <input type="text" class="box" name="email" value="<?php echo $row['emailadd'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Username:</label>
                    <input type="text" class="box" name="username" value="<?php echo $row['username'] ?>">
                </div>
                <div class="col">
                    <label class="form-label">Account Type:</label>
                    <select name="acct_type" class="box">
                      <option value="user">user</option>
                      <option value="admin">admin</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Status:</label>
                    <select name="status" class="box">
                        <option value="active" <?php if ($row['status'] == 'active') echo 'selected'; ?>>active</option>
                        <option value="inactive" <?php if ($row['status'] == 'inactive') echo 'selected'; ?>>inactive</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label">Password:</label>
                    <input type="password" class="box" name="password" value="<?php echo $row['password'] ?>">
                </div>
            </div>
            <div class="update_cancel">
                <button type="submit" class="buttons" name="submit">Update</button>
                <a href="admin_index.php" class="buttons">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>