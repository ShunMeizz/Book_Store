<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <div class="header-2">
      <div class="flex">
         <img src="images/logo.png" style="width: 70px;"/>
         <span class="logotext"> Gaklat &emsp; ADMIN PANEL</span>
         <nav class="navbar">
            <a href="admin_index.php#admin_dashboard">Dashboard</a>
            <a href="admin_index.php#admin_product">Product</a>
            <a href="reports.php">Reports</a>   
         </nav>
            
         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <img src="images/user_icon.png"  class="icon" id="user-btn"/>       
         </div>

         <div class="user-box">
            <p>username : <span>username text</span></p>
            <p>email : <span>useremail text</span></p>
            <a href="profile.php" class="buttons button2">ADMIN PROFILE</a>
            <a href="logout.php" class="buttons button2">LOGOUT</a>
            <a href="index.php" class="buttons button2">USER PANEL</a>
         </div>
      </div>
   </div>

</header>
