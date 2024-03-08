<?php
    include 'connect.php';
?>
<html>
    <head>
        <title>Gaklat Books Store</title>
        <link href="Registration_Login.css" type="text/css" rel="stylesheet"/>
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
                    <form action="#">
                      <h2>Login</h2>
                      <!-- Login Form Start -->

                      <!-- Email Input -->  
                      <div class="input_box">
                        <input type="email" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                      </div>

                      <!-- Password Input -->
                      <div class="input_box">
                        <input type="password" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                      </div>
          
                      <!-- Remember Me Checkbox and Forgot Password Link -->
                      <div class="option_field">
                        <span class="checkbox">
                          <input type="checkbox" id="check" />
                          <label for="check">Remember me</label>
                        </span>
                        <a href="#" class="forgot_pw">Forgot password?</a>
                      </div>
          
                      <!-- Login Button -->
                      <button class="button">Login Now</button>
          
                      <!-- Signup Link -->
                      <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
                      
                      <!-- Login Form End -->
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>