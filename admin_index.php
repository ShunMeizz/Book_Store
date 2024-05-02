<?php
    include 'connect.php';
    session_start(); 
    $userID = $_SESSION['userID'];
    $sql = "SELECT * FROM tbluseraccount";
    $result = mysqli_query($connection, $sql);
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
      <!--USER DASHBOARD SECTION-->
      <section id="admin_dashboard">
        <div class="user-dashboard">
          <form action="" method="post">
            <h3>User Records</h3>
            <a href="add-new.php" class="add-new-user buttons">Add New</a>
            <table>
                <tr>
                    <th>Account ID</th>
                    <th>User ID</th>
                    <th>Email Address</th>
                    <th>Username</th>
                    <th>Account Type</th>
                    <th>Operations</th>
                </tr>
                <?php 
                    while($rows=$result->fetch_assoc())
                    {
                ?>
                  <tr>
                      <td><?php echo $rows['acctID'];?></td>
                      <td><?php echo $rows['userID'];?></td>
                      <td><?php echo $rows['emailadd'];?></td>
                      <td><?php echo $rows['username'];?></td>
                      <td><?php echo $rows['acct_type'];?></td>
                      <td>
                        <a href="edit.php?id=<?php echo $rows['acctID'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                        <a href="delete.php?id=<?php echo $rows['acctID'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                      </td>
                  </tr>
                <?php
                    }
                ?>
            </table>
          </form>
        </div>
      </section>
       <!--PRODUCTS SECTION-->
      <section id="admin_product" class="products_container">
        <div class="add-products">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>add product</h3>
                <input type="text" name="title" class="box" placeholder="Enter Book Title" required>
                <div class=box-group>
                <input type="text" name="genre" class="box" placeholder="Genre" required>
                <input type="text" name="author" class="box" placeholder="Author" required>
                <input type="text" name="publisher" class="box" placeholder="Publisher" required>
                </div>
                <div class=box-group>
                <input type="number" min="0" name="rating" class="box" placeholder="Ratings" required>
                <input type="number" min="0" name="price" class="box" placeholder="Price" required>
                <input type="number" min="0" name="stock" class="box" placeholder="Stock" required>
                </div>
                <label for="publishing_date">Book published:</label>
                <input type="date" name="publishing_date" class="box" required>
                <textarea name="book_details" class="box" placeholder="Enter Book Details" rows="5" required></textarea>
                <label for="book_details">Book cover image:</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                <input type="submit" value="ADD BOOK" name="add_book" class="buttons">
            </form>
        </div>
        <div class="centertext">
          <p class="subheader_text">(Click Book to Update or Delete)</p>
          <p class="header_text">GAKLAT DISPLAY BOOKS</p>
        </div>
    
      <div class="productlist_container">
      
      
        <?php
          $select_books = mysqli_query($connection, "SELECT * FROM `tblbook`") or die('query failed');
          if(mysqli_num_rows($select_books) > 0){
            while($fetch_books = mysqli_fetch_assoc($select_books)){
        ?>
            <div class="product" data-name="p-<?php echo $fetch_books['bookID']; ?>">
              <img src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="<?php echo $fetch_books['title']; ?> cover" />
              <div class="book-title"><?php echo $fetch_books['title']; ?></div>
              <div class="author_date"><?php echo $fetch_books['author']; ?>∙<?php echo date('Y', strtotime($fetch_books['publishing_date']));?></div>
              
          </div>
        <?php
        }
        }else{
          echo '<p class="empty">no products added yet!</p>';
        }?>
      </div>
      </section>
    </div>
    <!--UPDATE PRODUCTS PREVIEW DETAILS-->
    <div class="updates-preview-container">
     <?php $select_books = mysqli_query($connection, "SELECT * FROM `tblbook`") or die('query failed');
      if(mysqli_num_rows($select_books) > 0){
        while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
        <div class="update-preview" data-target="p-<?php echo $fetch_books['bookID']; ?>">
            <div class="add-products">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>UPDATE PRODUCT <img src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="<?php echo $fetch_books['title']; ?> cover" /></h3>
                <input type="text" name="title" class="box" placeholder="Enter Book Title" required value="<?php echo  $fetch_books['title']; ?>"   />
                
                <div class=box-group>
                <input type="text" name="genre" class="box" placeholder="Genre" required value="<?php echo  $fetch_books['genre']; ?>">
                <input type="text" name="author" class="box" placeholder="Author" required value="<?php echo  $fetch_books['author']; ?>">
                <input type="text" name="publisher" class="box" placeholder="Publisher" required value="<?php echo  $fetch_books['publisher']; ?>">
                </div>
                <div class=box-group>
                <input type="number" min="0" name="rating" class="box" placeholder="Ratings" required value="<?php echo  $fetch_books['rating']; ?>">
                <input type="number" min="0" name="price" class="box" placeholder="Price" required value="<?php echo  $fetch_books['price']; ?>">
                <input type="number" min="0" name="stock" class="box" placeholder="Stock" required value="<?php echo  $fetch_books['stock']; ?>">
                </div>
              
                <label for="publishing_date">Book published:</label>
                <input type="date" name="publishing_date" class="box" required value="<?php echo  $fetch_books['publishing_date']; ?>">
                <textarea name="book_details" class="box" placeholder="Enter Book Details" rows="3">
                <?php echo $fetch_books['book_details']; ?>
                </textarea>
                <label for="book_details">Book cover image:</label>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" id="book_image">
                <form action="" method="post">
                  <div class="prevbutton">
                    <input type="submit" value="UPDATE" name="update_book" class="buttons button7">
                    <button class="buttons button8" value="<?php echo $fetch_books['bookID']; ?>" type="submit" name="delete_book">DELETE</button>
                    <button class="buttons" onclick="cancelButton()">CANCEL</button>
                  </div>
              </form>
                
              
            </form>
        </div>
        </div>
      <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }?>
    </div>

    <script src="js/script1.js"></script>
    <script src="js/script.js"></script>
    <script src="js/admin_script.js"></script>
  </body>

</html>

