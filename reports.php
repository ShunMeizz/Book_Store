<?php
    include 'connect.php';
    session_start(); 
    $userID = $_SESSION['userID'];
    // $mysqli->close();
    if(!isset($userID)){
      header ('location: login.php');
    }
    if(isset($_POST['add_book'])){
      $title = mysqli_real_escape_string($connection, $_POST['title']);
      $genre = mysqli_real_escape_string($connection, $_POST['genre']);
      $author = mysqli_real_escape_string($connection, $_POST['author']);
      $publisher = mysqli_real_escape_string($connection, $_POST['publisher']);
      $publishing_date = mysqli_real_escape_string($connection, $_POST['publishing_date']);
      $rating = $_POST['rating'];
      $price = $_POST['price'];
      $stock = $_POST['stock'];
      $book_details = mysqli_real_escape_string($connection, $_POST['book_details']);
      $image = $_FILES['image']['name'];
      $image_size = $_FILES['image']['size'];
      $image_tmp_name = $_FILES['image']['tmp_name'];
      $image_folder = 'uploaded_img/'.$image;
   
      $select_book_title = mysqli_query($connection, "SELECT title FROM `tblbook` WHERE title = '$title'") or die('query failed');
   
      if(mysqli_num_rows($select_book_title) > 0){
         $message[] = 'Book name already added';
      }else{
         $add_book_query = mysqli_query($connection, "INSERT INTO `tblbook`(title, genre, author,publisher,publishing_date,rating,price,stock,book_details,image) VALUES('$title', '$genre', '$author', '$publisher', '$publishing_date', '$rating', '$price', '$stock', '$book_details', '$image')") or die('query failed');
   
         if($add_book_query){
            if($image_size > 2000000){
               $message[] = 'image size is too large';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'Book added successfully!';
            }
         }else{
            $message[] = 'Book could not be added!';
         }
      }
   }
   if(isset($_POST['delete_book'])){
    $bookID = mysqli_real_escape_string($connection, $_POST['delete_book']);
    $delete_query = mysqli_query($connection, "DELETE FROM `tblbook` WHERE bookID = '$bookID'") or die('Delete query failed');
    
    if($delete_query){
       $message[] = 'Book deleted';
    }
   }
   if(isset($_POST['update_book'])) {
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $genre = mysqli_real_escape_string($connection, $_POST['genre']);
    $author = mysqli_real_escape_string($connection, $_POST['author']);
    $publisher = mysqli_real_escape_string($connection, $_POST['publisher']);
    $publishing_date = mysqli_real_escape_string($connection, $_POST['publishing_date']);
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $book_details = mysqli_real_escape_string($connection, $_POST['book_details']);

    $select_book_query = mysqli_query($connection, "SELECT * FROM `tblbook` WHERE title = '$title'") or die('Query failed');

    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/'.$image;

        // Update the image in the database
        $update_book_query = mysqli_query($connection, "UPDATE `tblbook` SET genre = '$genre', author = '$author', publisher = '$publisher', publishing_date = '$publishing_date', rating = '$rating', price = '$price', stock = '$stock', book_details = '$book_details', image = '$image' WHERE title = '$title'") or die('Update query failed');
        // Upload the new image
        if ($update_book_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Book updated successfully!';
            }
        } else {
            $message[] = 'Book could not be updated!';
        }
    } else {
        // No new image uploaded, update other fields
        $update_book_query = mysqli_query($connection, "UPDATE `tblbook` SET genre = '$genre', author = '$author', publisher = '$publisher', publishing_date = '$publishing_date', rating = '$rating', price = '$price', stock = '$stock', book_details = '$book_details' WHERE title = '$title'") or die('Update query failed');
        if ($update_book_query) {
            $message[] = 'Book updated successfully!';
        } else {
            $message[] = 'Book could not be updated!';
        }
    }
}

   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" 
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/style3.css" />
    <link rel="stylesheet" href="css/admin-style.css" />
    
    <?php include 'admin_header.php'; ?>
</head>

<body>
    <!--MAIN BAR-->
    <div class="mainbar_container">
      <section id="admin_report">
        <div class="report_container first-report">
          <form action="" method="post">
            <h3>Summary of Completed Orders with Customer and Book Details</h3>
                <table>
                    <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Book Titles</th>
                    <th>Authors</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                <?php 
                    $sql = "SELECT 
                        tblorder.orderID, 
                        CONCAT(tbluserprofile.firstname, ' ', tbluserprofile.lastname) AS name,
                        tbluseraccount.emailadd, 
                        CONCAT(tbladdress.region, ', ', tbladdress.city, ', ', tbladdress.street, ', ', tbladdress.zipcode) AS address,
                        tblorder.total_products AS titles, 
                        GROUP_CONCAT(tblbook.author ORDER BY tblbookorder.bookorderID SEPARATOR ', ') AS authors, 
                        tblorder.quantity AS quantities,
                        tblorder.total_payment AS total_payment
                    FROM tblorder
                    INNER JOIN tbluseraccount ON tblorder.userID = tbluseraccount.acctID
                    INNER JOIN tbluserprofile ON tbluseraccount.userID = tbluserprofile.userID
                    INNER JOIN tbladdress ON tblorder.addressID = tbladdress.addressID
                    INNER JOIN tblbookorder ON tblorder.orderID = tblbookorder.orderID
                    INNER JOIN tblbook ON tblbookorder.bookID = tblbook.bookID
                    WHERE tblorder.status = 'completed'
                    GROUP BY tblorder.orderID";        

                    $result = mysqli_query($connection, $sql);
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                    <tr>
                        <td><?php echo $rows['orderID'];?></td>
                        <td><?php echo $rows['name'];?></td>
                        <td><?php echo $rows['emailadd'];?></td>
                        <td><?php echo $rows['address'];?></td>
                        <td><?php echo $rows['titles'];?></td>
                        <td><?php echo $rows['authors'];?></td>
                        <td><?php echo $rows['quantities'];?></td>
                        <td><?php echo $rows['total_payment'];?></td>
                    </tr>
                <?php
                    }
                ?>
            </table>
          </form>
        </div>
      </section>
      <section id="admin_report">
        <div class="report_container second-report">
          <form action="" method="post">
            <h3>Best-selling Books</h3>
            <table>
                <tr>
                    <th>Genre</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Stocks Sold</th>
                </tr>
                <?php 
                    $sql = "SELECT genre, title, author, SUM(tblbookorder.quantity) AS total_quantity_sold FROM tblbookorder 
                            INNER JOIN tblbook ON tblbookorder.bookID = tblbook.bookID
                            GROUP BY tblbookorder.bookID
                            ORDER BY total_quantity_sold DESC"; 
                    $result = mysqli_query($connection, $sql);
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                  <tr>
                      <td><?php echo $rows['genre'];?></td>
                      <td><?php echo $rows['title'];?></td>
                      <td><?php echo $rows['author'];?></td>
                      <td><?php echo $rows['total_quantity_sold'];?></td>
                  </tr>  
                <?php
                    }
                ?>
            </table>
          </form>
        </div>
      </section>
      <section id="admin_report">
        <div class="report_container third-report">
          <form action="" method="post">
            <h3>User Records</h3>
            <table>
                <tr>
                    <th>Account Type</th>
                    <th>User Count</th>
                </tr>
                <?php 
                    $sql = "SELECT acct_type, COUNT(acctID) as Total FROM tbluseraccount GROUP BY acct_type ORDER BY Total";
                    $result = mysqli_query($connection, $sql);
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                  <tr>
                      <td><?php echo $rows['acct_type'];?></td>
                      <td><?php echo $rows['Total'];?></td>
                  </tr>
                <?php
                    }
                ?>
            </table>
          </form>
        </div>
        <!-- <div class="report_container second-report">
          <img src="images/report3.png" alt="">
          <span class="second_report_desc"></span>
        </div> -->
      </section>
    </div>

    <script src="js/script1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/admin_script.js"></script>
  </body>

</html>

