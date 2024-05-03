<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times " onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <div class="header-2">
      <div class="flex">
         <img src="images/logo.png" style="width: 70px;"/>
         <span class="logotext">Gaklat</span>
         <nav class="navbar">
            <a href="#homeid">Home</a>
            <a href="#productid">Product</a>
            <a href="contact.php">Contact Us</a>
            <a href="orders.php">Orders</a>   
         </nav>
            
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search.php"> <img src="images/search_icon.png"  class="icon" id="search-btn"/></a>
            <img src="images/user_icon.png"  class="icon" id="user-btn"/>
            <?php
               $select_cart_number = mysqli_query($connection, "SELECT * FROM `tblcart` WHERE userID = '$userID'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="#yourcart" onclick="YourCartFunction()"> <img src="images/addtocart_icon.png" class="icon" alt=""/><?php echo $cart_rows_number; ?></a>
            
         </div>

         <div class="user-box">
            <p>username : <span><?php echo $_SESSION['username']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['emailadd']; ?></p>
            <a href="profile.php" class="buttons button2">USER PROFILE</a>
            <a href="logout.php" class="buttons button2">LOGOUT</a>
            <a href="admin_index.php" class="buttons button2">ADMIN PANEL</a>
         </div>
      </div>
   </div>

</header>

