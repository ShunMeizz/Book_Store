
<?php
    session_start();
    include("connect.php");
?>
<html>
    <head>
        <title>Gaklat Books Store</title>
        <link href="css/login-register.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Pacifico&family=Poppins&family=Rammetto+One&family=Zilla+Slab:wght@600&display=swap" rel="stylesheet">
      </head>
    <body>
        <div class="main_container">
            <div class="left-side-child-container">
                <div class="left-side-child-container-entry">
                    <div class="logo-with-text">
                        <div class="logo">
                          <img width="110" src = "images/logo_white.png">
                        </div>
                        <div class="logo-text">
                          <h1>Gaklat<br>Books Store</h1>
                        </div>
                    </div>
                    <span class="site-description-in-forms">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit quisquam vitae quo, nisi, nostrum quibusdam reiciendis necessitatibus nulla ut corrupti praesentium suscipit. Praesentium enim labore nulla vero, ut necessitatibus doloremque!
                    </span>
                </div>
            </div>
            <div class="right-side-child-container">
                <div class="login_form">
                    <form method ="post">
                      <h2>Login</h2>
                      <!-- Login Form Start -->

                      <!-- Email Input  
                      <div class="input_box">
                        <input type="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                      </div>-->
                      <!-- Username Input -->  
                      <div class="input_box">
                        <input type="text" name = "inputUname" placeholder="Enter your username" required />
                        <i class="uil uil-envelope-alt email"></i>
                      </div>

                      <!-- Password Input -->
                      <div class="input_box">
                        <input type="password" name = "inputPassword" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>     
                      </div>
          
                      <!-- Remember Me Checkbox and Forgot Password Link -->
                      <div class="option_field">
                        <span class="checkbox">
                          <input type="checkbox" id="check" name="cbRememberMe"/>
                          <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot password?</a>
                      </div>
          
                      <!-- Login Button -->
                      <button class="button" name = "btnLogin" >Login Now</button>
          
                      <!-- Register Link -->
                      <div class="login_signup">Don't have an account? <a href="register.php" id="register">Register</a></div>
                      
                      <!-- Login Form End -->
                    </form>
                </div>
            </div>
        </div> 
        <div id="error-message-box">
          <div class="error-message-flexbox">
            <div class="upper-part-error-message">
              <img width= "50" src="images/wronged.png" alt="error-symbol" class="error-symbol">
              <span class="error-bold-message">Error!</span>
              <p class="unrecorded-message">Error Message</p>
            </div>
            <div class="lower-part-registration-success-message">
              <div class="triangle-down"></div>
              <div class="try-again-button">
                <button id="try-againbtn" onclick=showError()>Try Again</button>
              </div>
            </div>
          </div>
        </div>  
        <script src="js/script.js"></script>
    </body>
</html>
<?php
   
   if(isset($_POST['btnLogin'])){
    
      //something was posted in the log-in form
      $username= mysqli_real_escape_string($connection, $_POST['inputUname']);
      $pass= mysqli_real_escape_string($connection, $_POST['inputPassword']);

      $select_users = mysqli_query($connection, "SELECT * FROM `tbluseraccount` WHERE username = '$username' AND password = '$pass'") or die('query failed');

      if(mysqli_num_rows($select_users) > 0){
        $row = mysqli_fetch_assoc($select_users);
        $id = $row['acctID'];
        $_SESSION['acctID'] = $row['acctID'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['emailadd'] = $row['emailadd'];

         if($row['acct_type'] == 'admin'){
            echo "<script>window.location.href = 'admin_index.php';</script>";
         }elseif($row['acct_type'] == 'user'){
            echo "<script>window.location.href = 'index.php';</script>";
         }

         $status = "active";
         $sql2 = "UPDATE `tbluseraccount` SET `status`= '$status' WHERE acctID = $id";
        $result1 = mysqli_query($connection, $sql2);
      }else{
        echo '<script>showError("Incorrect Email or Password!");</script>'; //for Incorrect Email and Password //needed ang mga statements like this na after sa html ig
      } 
   }
?>