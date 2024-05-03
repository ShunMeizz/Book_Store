<?php
    include 'connect.php';
    session_start(); 
  
    $acctID = $_SESSION['acctID'];
    $userID = $_SESSION['userID'];
    if(!isset($userID)){
      header ('location: login.php');
    }
    

    //For Order AUTO-FILL, Retrieve the data of currentUser in tbluserprofile
    $select_account = mysqli_query($connection, "SELECT emailadd FROM tbluseraccount WHERE acctID = '$acctID'");
    $select_user_profile = mysqli_query($connection, "SELECT firstname, lastname, addressID, phonenumber FROM tbluserprofile WHERE userID = '$userID'");

    if (mysqli_num_rows($select_user_profile) > 0) {
      $userProfile = mysqli_fetch_assoc($select_user_profile);
      $firstname = htmlspecialchars($userProfile['firstname']);
      $lastname = htmlspecialchars($userProfile['lastname']);
      $phonenumber = htmlspecialchars($userProfile['phonenumber']);
      $addressID = htmlspecialchars($userProfile['addressID']);
    } 
    if (mysqli_num_rows($select_account) > 0) {
      $userAccount = mysqli_fetch_assoc($select_account);
      $emailadd = htmlspecialchars($userAccount['emailadd']);
    } 
    $select_address = mysqli_query($connection, "SELECT region, city, street, zipcode FROM tbladdress WHERE addressID = '$addressID'");
    if (mysqli_num_rows($select_address) > 0) {
        $addressData = mysqli_fetch_assoc($select_address);
        $region = htmlspecialchars($addressData['region']);
        $city = htmlspecialchars($addressData['city']);
        $street = htmlspecialchars($addressData['street']);
        $zipcode = htmlspecialchars($addressData['zipcode']);
    }

    //For some bookDetails to our tblCart
    if(isset($_POST['btnAddtoCart'])){

      $book_title = $_POST['book_title'];
      $book_cost = $_POST['book_cost'];
      $book_quantity = $_POST['book_quantity'];
      $book_image = $_POST['book_image'];
   
      $check_cart_numbers = mysqli_query($connection, "SELECT * FROM `tblcart` WHERE book_title = '$book_title' AND userID = '$userID'") or die('query failed');
   
      if(mysqli_num_rows($check_cart_numbers) == 0){
        mysqli_query($connection, "INSERT INTO `tblcart`(userID, book_title, cost, quantity, image) VALUES('$userID', '$book_title', '$book_cost', '$book_quantity' , '$book_image')") or die('query failed');
      }
   }

  /* if(isset($_POST['btnCheckout'])) {
    $fname=$_POST['inputFirstNameReceiver'];		
    $lname=$_POST['inputLastNameReceiver'];
    $full_name = mysqli_real_escape_string($connection, $fname . ' ' . $lname);

    $phonenum1=$_POST['inputPhoneNum1'];
    $phonenum2=$_POST['inputPhoneNum2'];
    $email=$_POST['inputEmail'];
    $payment=$_POST['total_payment'];

    $region = $_POST['inputRegion'];
    $province = $_POST['inputProvince'];
    $city = $_POST['inputCity']; 
    $barangay = $_POST['inputBarangay']; 
    $street = $_POST['inputStreet']; 
    $postal_code = $_POST['inputPostalCode']; 

    // Insert new address into tbladdress
    $sql1 ="Insert into tbladdress(region,province,city,barangay,street,zipcode) values('".$region."','".$province."','".$city."','".$barangay."','".$street."','".$postal_code."')";
    mysqli_query($connection,$sql1);
    $address_id = mysqli_insert_id($connection);

    // Insert new user account into tbluseraccount
    $sql2 ="Insert into tblorder(user,name,phoneNum1,phoneNum2,email,total_payment,order_date,shipping_address) values('".$acctID."','".$full_name."','".$phonenum1."','".$phonenum2."','".$email."','".$payment."',CURDATE(),$address_id)"; 
    mysqli_query($connection,$sql2);

    // echo "<script>showRecords();</script>";
   }*/
  
   if(isset($_POST['btnCheckout'])){
    //userID	addressID	order_date	total_products	total_payment	payment_method	status
    $select_address = mysqli_query($connection, "SELECT addressID FROM tbluserprofile WHERE userID = '$userID'");
    if (mysqli_num_rows($select_address) > 0) {
      $userAddress = mysqli_fetch_assoc($select_address);
      $address = htmlspecialchars($userAddress['addressID']);
    } 
    $order_date = date('Y-m-d H:i:s', strtotime('now'));

    $cart_total = 0;
    $cart_products[] = '';
 
    $cart_query = mysqli_query($connection, "SELECT * FROM `tblcart` WHERE userID = '$userID'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
       while($cart_item = mysqli_fetch_assoc($cart_query)){
          $cart_products[] = $cart_item['book_title'].' ('.$cart_item['quantity'].') ';
          $sub_total = ($cart_item['cost'] * $cart_item['quantity']);
          $cart_total += $sub_total;
       }
    }
    $total_products = implode(', ',$cart_products);
    $order_query = mysqli_query($connection, "SELECT * FROM `tblorder` WHERE userID= '$userID' AND order_date = '$order_date' AND total_products = '$total_products' AND total_payment = '$cart_total'") or die('query failed');
 
    if($cart_total == 0){
       $message[] = 'your cart is empty';
    }else{
       if(mysqli_num_rows($order_query) > 0){
          $message[] = 'order already placed!'; 
       }else{
          mysqli_query($connection, "INSERT INTO `tblorder`(userID, addressID, order_date, total_products, total_payment) VALUES('$userID', '$address', '$order_date', '$total_products', '$cart_total')") or die('query failed');
          $message[] = 'order placed successfully!';
          mysqli_query($connection, "DELETE FROM `tblcart` WHERE userID = '$userID'") or die('query failed');
       }
    }
    
 }
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'header.php'; ?>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gaklat BookShop</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
    <link rel="stylesheet" href="css/style1.css" />
    <link rel="stylesheet" href="css/style2.css" />
    <link rel="stylesheet" href="css/style3.css" />
    <link rel="stylesheet" href="css/login-register.css" />
    <link rel="stylesheet" href="css/admin_style.css" />
  </head>
  <body>
    <!--YOUR CART-->
    <div class="yourcart_container">
    <i class="fas fa-times"></i>
    <span class="text"><?php echo $_SESSION['username']; ?>'s Cart</span>
    <div class="yourcart_list">
        <?php
        // Fetch cart items for the current user
        $select_cart_items = mysqli_query($connection, "SELECT * FROM `tblcart` WHERE userID = '$userID'");
        if(mysqli_num_rows($select_cart_items) > 0) {
            while($cart_item = mysqli_fetch_assoc($select_cart_items)) {
        ?>
        <div class="yourcart_products"> 
            <img src="uploaded_img/<?php echo $cart_item['image']; ?>" />
            <div class="details">
                <span class="title"><?php echo $cart_item['book_title']; ?></span>
                <div class="price"><?php echo ($cart_item['cost'] * $cart_item['quantity']) . ".00"; ?></div>
                <div class="quantity">
                  <button onclick="updateQuantity(-1, <?php echo $cart_item['quantity']; ?>, <?php echo $cart_item['cartID']; ?>, <?php echo $cart_item['cost']; ?>)">-</button>
                  <span class="quantity-value"><?php echo $cart_item['quantity'];?></span>
                  <button onclick="updateQuantity(1, <?php echo $cart_item['quantity']; ?>, <?php echo $cart_item['cartID']; ?>, <?php echo $cart_item['cost']; ?>)">+</button>
                </div>

        `     <form id="delete_form_<?php echo $cart_item['cartID']; ?>" action="cart.php" method="POST" style="display: none;">
                <input type="hidden" name="cartID" value="<?php echo $cart_item['cartID']; ?>">
                <input type="hidden" name="deleteItem" value="true">
              </form>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<p>No items in cart</p>';
        }
        ?>
    </div>
    <div class="yourcart_bottompart">
        <span class="total">Total</span>
        <a href="javascript:void(0)" class="checkout" onclick="setOrderCheckout()">CheckOut</a>
    </div>
</div>
    
    <!--MAIN BAR-->
    <div class="mainbar_container">
      <!--LANDING PAGE-->
      <section id="homeid" class="home_container">
        <div class="welcome_content">
          <span class="subheader_text">FOR LIMITED TIME ONLY</span>
          <h2>FEATURE BOOKS OF THE MONTH</h2>
          <span class="normaltext"
            >Lorem ipsum dolor sit amet consectur adipiscing elit. Magnam
            deserunt nostrum accusamus. Nam alias sit necessitabus, aliquid ex
            minima at.</span
          >
          <br /><br />
          <img src="images/awards.PNG" alt="" />
          <div><a href="#productid" class="buttons button2">BROWSE THE LIST</a></div>
          
        </div>
      </section>
      <!--ABOUT US PAGE-->
      <section id="aboutid" class="aboutpage_container">
        <div class="centertext">
          <p class="subheader_text">DISCOVER OUR COMPANY'S STORY</p>
          <p class="header_text">About Us</p>
        </div>
        <div class="aboutus-content">
          <img src="images/logo_w_noise.png" alt="" />
          <span class="normaltext"
            >Gaklat BookShop, a local gem in the heart of New York City, has
            been a haven for book lovers since its establishment in 2012. Known
            for its diverse collection, welcoming atmosphere, and commitment to
            promoting the love of reading, Gaklat has become a cherished
            destination for literary enthusiasts.</span
          >
        </div>
        <div class="aboutus-container2">
          <div class="aboutus-section">
            <div class="aboutus-cards">
              <div class="owners-card">
                <div class="image-section">
                  <img src="images/owners_karylle.png" alt="" />
                </div>
                <div class="owners-content">
                  <h2>Owner</h2>
                  <p class="normaltext">Mary Karylle Delos Reyes</p>
                  <!--<div class="quotebox">
                    <span class ="quotetext">"Books are not just collections of pages; they are portals to different worlds. As Co-Owner and Book Curator, I strive to create experiences that bring those worlds to life."</span>
                    </div>-->
                </div>
              </div>
              <div class="owners-card">
                <img src="images/owners_shanley.png" alt="" />
                <div class="owners-content">
                  <h2>Owner</h2>
                  <p class="normaltext">Shanley Mae Sebial</p>
                  <!--<div class="quotebox">
                      <span class ="quotetext">"At Gaklat Studio, we don't just create stories- we transport readers to new worlds and ignite imaginations with immersive reading experiences that they'll never forget."</span>
                      </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
       <!--PRODUCTS PAGE-->
      <section id="productid" class="products_container">
        <div class="centertext">
          <p class="subheader_text">BUY BOOK NOW</p>
          <p class="header_text">Popular Series</p>
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
              <div class="stars">
              <?php $stars =$fetch_books['rating'];
                for ($i = 0; $i < 5; $i++) {
                if ($i < $stars) {
                    echo '<i class="fas fa-star"></i>';
                }else {
                    echo '<i class="far fa-star"></i>';
                }
              }?> 
            </div>
          </div>
        <?php
        }
        }else{
          echo '<p class="empty">no products added yet!</p>';
        }?>
        </div>
      </section>
    </div>
    <!--PRODUCTS PREVIEW DETAILS-->
    <div class="products-preview">
      <?php $select_books = mysqli_query($connection, "SELECT * FROM `tblbook`") or die('query failed');
      if(mysqli_num_rows($select_books) > 0){
        while($fetch_books = mysqli_fetch_assoc($select_books)){
      ?>
      <form action="" method="post">
        <div class="preview" data-target="p-<?php echo $fetch_books['bookID']; ?>">
        
          <!-- You may need to adjust the above hidden fields based on your database schema -->
          <i class="fas fa-times"></i>
          <img src="uploaded_img/<?php echo $fetch_books['image']; ?>" alt="<?php echo $fetch_books['title']; ?> cover" />
          <h3><?php echo $fetch_books['title']; ?></h3>
          <div style="height: 70px; overflow: auto;">
            <p><?php echo $fetch_books['book_details']; ?></p>
          </div>
          <div class="price">$<?php echo number_format($fetch_books['price'], 2); ?></div>
          
         
          <form id="addToCartForm" method="post">
              <div class="prevbutton">
              <input type="hidden" min="0" name="book_quantity" value="1">
              <input type="hidden" name="book_image" value="<?php echo $fetch_books['image']; ?>">
              <input type="hidden" name="book_title" value="<?php echo $fetch_books['title']; ?>">
              <input type="hidden" name="book_cost" value="<?php echo $fetch_books['price']; ?>">
              <button type="submit" class="buttons addtocartbutton" name="btnAddtoCart" onclick=" AddedButton('p-<?php echo $fetch_books['bookID']; ?>">ADD TO CART</button> 
              </div>
          </form>
        </div>
        </form>
      <?php
        }
      } else {
        echo '<p class="empty">no products added yet!</p>';
      }?>
    </div>
    <!-- -------------------- ORDER DETAILS SECTION -------------------------->
    <div id="order-overlay-container">
      <!-- <span class="browse-more-books">Browse</span> -->
      <form method="post" action="">
        <div class="order-details">
          <div class="order-details-heading">
            <span class="order-details-heading-text">&nbsp;&nbsp;&nbsp;ORDER DETAILS</span>
          </div>
          <div class="checkout-form">
              <div class="contact-information" >
                <!-- Contact Details Input -->  
                <span><b>Contact Information</b></span>
                <div class="detail-section">
                      <div class="input_box_ci fname">
                        <input type="text" name="inputFirstNameReceiver" placeholder="First name" required value="<?php echo $firstname; ?>" readonly />        
                      </div>
                      <div class="input_box_ci lname">
                        <input type="text" name="inputLastNameReceiver" placeholder="Last name" required value="<?php echo $lastname; ?>" readonly /> 
                      </div>
                    </div>
                <div class="detail-section">
                    <div class="input_box_ci fname">
                      <input type="text" name="inputPhoneNum1" placeholder="Phone Number 1" required value="<?php echo $phonenumber; ?>" readonly /> 
                    </div>
                </div>
                <div class="input_box_ci">
                  <input type="text" name="inputEmail" placeholder="Email" required value="<?php echo $emailadd; ?>" readonly /> 
                </div>
                <a href="profile.php" class="buttons button3">Update Profile Info</a>
              </div>

         
              <div class="shipping-details">
                <span><b>Shipping Address</b></span>
               <!-- <form method ="post">
                  Shipping Details New Added Address Version
                 <div class="address-new-row1">
                      <div class="input_box_ci fname">   
                        <select id="inputAddress-region" name="inputAddress-region" onchange="populateCities()" required>
                        <option value="" disabled selected>Region</option>
                        <option value="NCR">NCR</option>
                        <option value="CAR">CAR</option>
                        <option value="ARMM">ARMM</option>
                        <option value="Region I">Region I</option>
                        <option value="Region II">Region II</option>
                        <option value="Region III">Region III</option>
                        <option value="Region IV-A">Region IV-A</option>
                        <option value="Region IV-B">Region IV-B</option>
                        <option value="Region V">Region V</option>
                        <option value="Region VI">Region VI</option>
                        <option value="Region VII">Region VII</option>
                        <option value="Region VIII">Region VIII</option>
                        <option value="Region IX">Region IX</option>
                        <option value="Region X">Region X</option>
                        <option value="Region XI">Region XI</option>
                        <option value="Region XII">Region XII</option>
                        <option value="Region XIII">Region XIII</option>
                      </select>
                      </div>
                      <div class="input_box_ci fname">
                      <select id="inputAddress-city" name="inputAddress-city" required>
                          <option value="" disabled selected>City</option>
                      </select>
                      </div>
                </div>
                <div class="address-new-row2">
                      <div class="input_box_ci fname">
                      <input type="text" name="inputAddress-street" placeholder="Street" required />
                      </div>
                      <div class="input_box_ci lname">
                      <input type="text" name="inputAddress-zipcode" placeholder="Zip Code" required />
                      </div>
                </div>
                <button class="buttons button3" name="btnSave">Save</button>
                </form>-->
                <!-- Shipping Details Autofill Version-->  
                <div class="address-autofill-row1">
                      <div class="input_box_ci fname">
                        <input type="text" name="inputRegion" placeholder="Region" required value="<?php echo $region; ?>" readonly /> 
                        <!--<input type="text" name="inputRegion" placeholder="Region" required />  -->      
                      </div>
                      <div class="input_box_ci fname">
                      <input type="text" name="inputCity" placeholder="City" required value="<?php echo $city; ?>" readonly />       
                      </div>
                </div>
                <div class="address-autofill-row2">
                      <div class="input_box_ci fname">
                      <input type="text" name="inputStreet" placeholder="Street" required value="<?php echo $street; ?>" readonly />     
                      </div>
                      <div class="input_box_ci lname">
                      <input type="text" name="inputPostalCode" placeholder="Postal Code" required value="<?php echo $zipcode; ?>" readonly />
                      </div>
                </div>
                <button class="buttons button3 newAddress" onclick="addAddress()">Add New Address</button>
              </div>
          </div>
        </div>
        <div class="total-payment-details">
          <div class="order-summary-heading">
            <span class="order-summary-heading-text">&nbsp;ORDER SUMMARY</span>
          </div>
          <div class="item-count">
            <img width="13" src="images/addtocart_icon.png" alt="cart-icon">
            <span class="order-summary-heading-text"> <span class="item-number">1</span> item(s) in Cart</span>
          </div>
          <div class="subtotal-with-shipping-fee">
            <div class="subtotal">
              <span class="order-summary-heading-text">Order Subtotal</span>
              <span class="order-subtotal-amount"><span class="subtotal-amount">25</span>.00</span>
            </div>
            <div class="shipping-fee">
              <span class="order-summary-heading-text">Shipping Fee</span>
              <span class="shipping-fee-amount">80.00</span>
            </div>
          </div>
          <div class="total-payment">
            <span class="total-payment-text">TOTAL</span>
            <span class="total-payment-text"><span class="order-summary-total"></span>.00</span>
            <input type="hidden" name="total_payment" id="total_payment_amount" value="">
          </div>
          <div class="cancel-with-checkout-buttons">
            <input type="submit" name="btnCancel" class="buttonCancel" value="Cancel" onclick="cancelOrder()">
            <input type="submit" name="btnCheckout" class="buttonCheckout" value="Place Order">
          </div>
        </div>
      </form>
    </div>
   
   
    <?php include 'footer.php'; ?>
    
    <script src="js/script1.js"></script>
    <script src="js/script.js"></script>
  </body>

</html>
