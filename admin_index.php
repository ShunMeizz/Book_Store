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

    // PHP code to display total number of customers
    $queryTotalUsers = "SELECT acctID, COUNT(acctID) AS total_users FROM tbluseraccount";
    $resultTotalUsers = mysqli_query($connection, $queryTotalUsers);
    $rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
    $totalUsers = $rowTotalUsers['total_users'];
    $totalUsers -= 2;

    // PHP code to display total profit
    $total_revenue = 0;
    $queryTotalPayment = "SELECT total_payment, SUM(total_payment) AS total_revenue FROM tblorder";
    $result5 = mysqli_query($connection, $queryTotalPayment);
    while($rows=$result5->fetch_assoc()) {
      $total_revenue += $rows['total_revenue'];
    }

    // PHP code to display total number of books in the inventory
    $inventory_count = 0;
    $queryTotalInventory = "SELECT stock, SUM(stock) AS inventory_count FROM tblbook";
    $result6 = mysqli_query($connection, $queryTotalInventory);
    while($rows=$result6->fetch_assoc()) {
      $inventory_count += $rows['inventory_count'];
    }

    // PHP code to display average price of books
    $queryAveragePrice = "SELECT AVG(price) AS average_price FROM tblbook";
    $result9 = mysqli_query($connection, $queryAveragePrice);
    $row12 = mysqli_fetch_assoc($result9);
    $average_price = number_format($row12['average_price'], 2);//$row12['average_price']

    // PHP code to retrieve the number of books per genre
    $query1 = "SELECT genre FROM tblbook";
    $resultset1 = mysqli_query($connection, $query1);

    $genreCounts = [];
    while ($row = mysqli_fetch_assoc($resultset1)) {
        $genres = explode(',', $row['genre']);
        $genres = array_map('trim', $genres);
        
        foreach ($genres as $genre) {
            if (!isset($genreCounts[$genre])) {
                $genreCounts[$genre] = 1;
            } else {
                $genreCounts[$genre]++;
            }
        }
    }
    $genreLabels = array_keys($genreCounts);
    $genreData = array_values($genreCounts);

    // PHP code to fetch total profit per month
    $revenue_per_month = array();
    $queryRevenue = "SELECT MONTH(order_date) AS month, SUM(total_payment) AS revenue 
                    FROM tblorder 
                    GROUP BY MONTH(order_date)";
    $result7 = mysqli_query($connection, $queryRevenue);

    while ($row = mysqli_fetch_assoc($result7)) {
        $month = $row['month'];
        $revenue = $row['revenue'];
        $revenue_per_month[$month] = $revenue;
    }
    $months = array_keys($revenue_per_month);
    $monthLabels = [];
    foreach ($months as $month) {
        $monthLabels[] = date('F', mktime(0, 0, 0, $month, 1)); // Convert integer month to month name
    }
    $revenueData = array_values($revenue_per_month);

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

//Update Order Status
if(isset($_POST['statusUpdate'])){
  $selectedStatus = mysqli_real_escape_string($connection, $_POST['selectedStatus']);
  $orderID =  mysqli_real_escape_string($connection, $_POST['orderID']);
  $update_query = mysqli_query($connection, "UPDATE `tblorder` SET `status`='$selectedStatus' WHERE orderID = $orderID") or die('Delete query failed');
  if($update_query){
     $message[] = 'Order Status Updated Successfully';
  }
 }

//Order Delete
if(isset($_POST['deleteOrder'])){
  $orderID =  mysqli_real_escape_string($connection, $_POST['orderID']);
  $delete_query = mysqli_query($connection, "DELETE FROM `tblorder` WHERE orderID = '$orderID'") or die('Delete query failed');
  if($delete_query){
     $message[] = 'Order Deleted';
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php include 'admin_header.php'; ?>
</head>

<body>
    <!--MAIN BAR-->
    <div class="mainbar_container">
      <section id="statistics">
        <div class="statistics">
          <h1 >Approximately <?php echo $totalUsers ?> users are currently using GAKLAT Bookshop</h1>
          
          <!-- Display total revenue -->
          <div class="revenue_and_inventory_count">
            <div class="total_revenue">
              <p class="total_revenue_label" style="font-size: 30px">Total Revenue:</p>
              <center><h2 class="total_revenue_amount">₱<?php echo $total_revenue ?></h2></center>
            </div>


            <div class="inventory_count">
              <p class="inventory_count_label" style="font-size: 30px">Inventory Count:</p>
              <center><h2 class="inventory_count_amount"><?php echo $inventory_count ?></h2></center>
            </div>

            <div class="inventory_count">
              <p class="inventory_count_label" style="font-size: 30px">Average Price of Books:</p>
              <center><h2 class="inventory_count_amount">₱<?php echo $average_price ?></h2></center>
            </div>
          </div>

          <div class="genre-and-sales">
            <div class="genre-pie-chart">
              <h2 style="font-size: 31px">Number of Books Per Genre</h2>
              <center><canvas id="genrePieChart" width="350" height="350"></canvas></center>
            </div>
            <div class="sale-trend-chart">
              <h2 style="font-size: 31px">Sales Trend Over 4 months</h2>
              <center><canvas id="salesLineChart" width="350" height="350"></canvas></center>
            </div>
          </div>

          
        </div>
      </section>
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
                        <a href="delete.php?id=<?php echo $rows['userID'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
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
    
    <!--ORDER REVIEW SECTION-->
    <section id="admin_order">
    <div class="order-dashboard">
        
        <form action="" method="post">
        <h3>Order Review Section</h3>
            <table>
                <tr>
                    <th>UserID</th>
                    <th>Address</th>
                    <th>Order Date</th>
                    <th>Ordered Products</th>
                    <th>Quantity</th>
                    <th>Total Payment</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                    <th>Operations</th>
                </tr>
                <?php
                $select_orders = mysqli_query($connection, "SELECT * FROM `tblorder`") or die('query failed');
                if(mysqli_num_rows($select_orders) > 0){
                    while($fetch_orders = mysqli_fetch_assoc($select_orders)){
                ?>
                        <tr>
                            <td><?php echo $fetch_orders['userID'];?></td>
                            <td><?php echo $fetch_orders['addressID'];?></td>
                            <td><?php echo $fetch_orders['order_date'];?></td>
                            <td><?php echo $fetch_orders['total_products'];?></td>
                            <td><?php echo $fetch_orders['quantity'];?></td>
                            <td><?php echo $fetch_orders['total_payment'];?></td>
                            <td><?php echo $fetch_orders['payment_method'];?></td>
                            <td>
                              <form action="" method="POST">
                                <select name="status" onchange="this.form.selectedStatus.value=this.value;">
                                  <?php
                                    $selectedStatus = $fetch_orders['status'];
                                    echo '<option value="' . $selectedStatus . '">' . $selectedStatus . '</option>';
                                  ?>
                                  <option value="pending">pending</option>
                                  <option value="completed">completed</option>
                                </select>
                                <input type="hidden" name="selectedStatus" value="<?php echo $selectedStatus; ?>">
                                <input type="hidden" name="orderID" value="<?php echo $fetch_orders['orderID']; ?>">
                                <input type="submit" value="update" name="statusUpdate">
                              </form>
                            </td>
                            <td>
                              <form action="" method="POST">
                                <input type="hidden" name="orderID" value="<?php echo $fetch_orders['orderID']; ?>">
                                <button type="submit" value="delete" name="deleteOrder" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></button>
                              </form>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="8" class="empty">No orders placed yet!</td></tr>';
                }
                ?>
            </table>
        </form>
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

<script>
  // JavaScript code to render pie chart
  var ctx = document.getElementById('genrePieChart').getContext('2d');
  var genrePieChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($genreLabels); ?>,
      datasets: [{
        // label: 'Number of Books',
        data: <?php echo json_encode($genreData); ?>,
        backgroundColor: [
          'rgba(0, 0, 0, 0.7)',
          'rgba(232, 143, 89, 0.7)',
          'rgba(99, 67, 0, 0.5)',
          'rgba(69, 108, 137, 0.7)',
          'rgba(75, 192, 192, 0.7)',
          'rgba(194, 134, 44, 0.7)',
          'rgba(121, 85, 72, 0.7)',
          'rgba(148, 159, 177, 0.7)',
          'rgba(152, 76, 111, 0.7)',
          'rgba(134, 168, 131, 0.7)',
          'rgba(162, 153, 137, 0.7)'
        ],
        borderColor: [
          'rgba(0, 0, 0, 1)',
          'rgba(232, 143, 89, 1)',
          'rgba(99, 67, 0, 0.4)',
          'rgba(69, 108, 137, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(194, 134, 44, 1)',
          'rgba(121, 85, 72, 1)',
          'rgba(148, 159, 177, 1)',
          'rgba(152, 76, 111, 1)',
          'rgba(134, 168, 131, 1)',
          'rgba(162, 153, 137, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          display: false,
          position: 'left'
        }
      },
      responsive: true,
      maintainAspectRatio: false,
      aspectRatio: 1,
      scales: {
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Number of Books' // Label for x-axis
          }
        }],
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Genre' // Label for y-axis
          }
        }]
      }
    }
  });

  var ctx = document.getElementById('salesLineChart').getContext('2d');
  var salesLineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode($monthLabels); ?>,
      datasets: [{
        label: 'Sales Revenue',
        data: <?php echo json_encode($revenueData); ?>,
        backgroundColor: [
          'rgba(0, 0, 0, 0.7)',
          'rgba(232, 143, 89, 0.7)',
          'rgba(99, 67, 0, 0.5)',
          'rgba(69, 108, 137, 0.7)'
        ],
        borderColor: [
          'rgba(0, 0, 0, 1)',
          'rgba(232, 143, 89, 1)',
          'rgba(99, 67, 0, 0.4)',
          'rgba(69, 108, 137, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      aspectRatio: 1,
      scales: {
        xAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Month' // Label for x-axis
          }
        }],
        yAxes: [{
          scaleLabel: {
            display: true,
            labelString: 'Sales Revenue (Php)' // Label for y-axis
          }
        }]
      }
    }
  });

  // var ctx = document.getElementById('salesLineChart').getContext('2d');
  // var salesLineChart = new Chart(ctx, {
  //   type: 'line',
  //   data: {
  //     labels:, // Months as x-axis labels
  //     datasets: [{
  //       label: 'Sales Revenue',
  //       data: , // Revenue data for each month
  //       borderColor: 'rgba(75, 192, 192, 1)', // Line color
  //       borderWidth: 2,
  //       fill: false // Do not fill area under the line
  //     }]
  //   },
  //   options: {
  //     responsive: true,
  //     maintainAspectRatio: false,
  //     scales: {
  //       yAxes: [{
  //         scaleLabel: {
  //           display: true,
  //           labelString: 'Sales Revenue (Php)' // Label for y-axis
  //         }
  //       }]
  //     }
  //   }
  // });

  
      // plugins: {
      //   legend: {
      //     display: true,
      //     position: 'top'
      //   }
      // },
</script>