<?php
     session_start();
    include("connect.php");
    
    //for the message boxes
    $checkPassword = true;
    $userFound = true;

    if(isset($_POST['btnLogin'])){		
    //something was posted in the log-in form
      $username = $_POST['inputUname'];
      $password = $_POST['inputPassword'];

    //read from the database
      $sql2 ="Select * from tbluseraccount where username='".$username."'";
      $result = mysqli_query($connection,$sql2);

      if($result && mysqli_num_rows($result) > 0 ){
          $user_data = mysqli_fetch_assoc($result);
        if($user_data['password'] === $password){
          $_SESSION['acctID'] = $user_data['acctID'];
          header("Location: index.php");
          die;
        }else{
          $checkPassword = false;
        }
      }else{
        $userFound = false;
      } 
      
    }
?>
<html>
    <head>
        <title>Gaklat Books Store</title>
        <link href="css/Registration_Login.css" type="text/css" rel="stylesheet"/>
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
                        <?php if (!$userFound): ?>
                            <span class="error_message">Username not found. Try to register.</span>
                          <?php endif; ?>
                      </div>

                      <!-- Password Input -->
                      <div class="input_box">
                        <input type="password" name = "inputPassword" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i> 
                        <?php if (!$checkPassword): ?>
                            <span class="error_message">Wrong password. Try again.</span>
                          <?php endif; ?>           
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
    </body>
</html>
