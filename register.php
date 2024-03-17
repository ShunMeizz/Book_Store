<?php
    include 'connect.php';

  $userNameUnique = true; //for the message box

  if(isset($_POST['btnRegister'])){		
    $username=$_POST['inputUname'];
    $email=$_POST['inputEmail'];
    $password=$_POST['inputPassword'];

    $fname=$_POST['inputFname'];		
    $lname=$_POST['inputLname'];
    $region = $_POST['inputAddress-region'];
    $city = $_POST['inputAddress-city'];
    $zipcode = $_POST['inputAddress-zipcode']; 
    $phonenum=$_POST['inputPhoneNum'];
    $gender=$_POST['inputGender'];
    $bday=$_POST['inputBday'];
    
    
    //Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
    $sql2 ="Select * from tbluseraccount where username='".$username."'";
    $result = mysqli_query($connection,$sql2);
    $row = mysqli_num_rows($result);
  
    if($row == 0){
        $sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$username."','".$password."')";
        mysqli_query($connection,$sql);
        //also save data to tbluserprofile			
        $sql1 ="Insert into tbluserprofile(firstname,lastname,birthdate,gender,phonenumber,region,city,zipcode) values('".$fname."','".$lname."','".$bday."','".$gender."','".$phonenum."','".$region."','".$city."','".$zipcode."')";
        mysqli_query($connection,$sql1);

        echo "<script>alert('New Record Saved')</script>";
        header("Location: login.php");
    }else{
      $userNameUnique = false;
    }  
  }

?>
 
<html>
    <head>
        <title>Gaklat Books Store</title>
        <link rel="stylesheet" href="css/login-register.css" />
        <link rel = "stylesheet" href = "https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link href = "https://fonts.googleapis.com/css2?family=Bree+Serif&family=Pacifico&family=Poppins&family=Rammetto+One&family=Zilla+Slab:wght@600&display=swap" rel="stylesheet">
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
                <div class="register_form">
                <form method ="post">
                 
                  <h2>Register</h2>
                  <!-- Register Form Start -->

                  <!-- FirstName, LastName and Gender Input -->  
                  <div class="name-gender">
                    <div class="input_box1 fname">
                      <input type="text" name="inputFname" placeholder="First name" required />        
                    </div>
                    <div class="input_box1 lname">
                      <input type="text" name="inputLname" placeholder="Last name" required />
                    </div>
                    <div class="input_box1 gender">
                      <select name="inputGender" required>
                          <option value="" disabled selected>Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>

                  <!-- Address Input -->  
                  <div class="location-container">
                    <div class="input_box1 region">
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
                    <div class="input_box1 city">
                      <select id="inputAddress-city" name="inputAddress-city" required>
                          <option value="" disabled selected>City</option>
                      </select>
                    </div>
                    <div class="input_box1 zipcode">
                      <input type="text" name="inputAddress-zipcode" placeholder="Zip Code" required />
                    </div>
                  </div>

                  <!-- Username Input -->  
                  <div class="input_box">
                    <input type="text" name="inputUname" placeholder="Username" required />
                    <?php if (!$userNameUnique): ?>
                            <span class="error_message">Username already exists. Try a different username or log in.</span>
                          <?php endif; ?>
                    <i class="uil uil-user user"></i>
                  </div>

                  <!-- Email Input -->  
                  <div class="input_box">
                    <input type="email" name="inputEmail" placeholder="Email address" required />
                    <i class="uil uil-envelope-alt email"></i>
                  </div>

                  <!-- Birthdate Input -->  
                  <div class="input_box">
                    <input type="text" name="inputBday" id="inputBday" placeholder="Birthdate (YYYY-MM-DD)" required />               
                    <div class="error-message" id="birthdate-error"></div>
                    <i class="uil uil-calendar-alt calendar"></i>     
                  </div>

                  <!-- PhoneNumber Input -->  
                  <div class="input_box">
                      <input type="tel" input name="inputPhoneNum" placeholder="Phone number"  pattern="\d{11}" title="Please enter exactly 11 digits" required/>
                        <i class="uil uil-phone phone"></i>
                  </div>

                  <!-- Password Input -->
                  <div class="input_box">
                    <input type="password" name="inputPassword" placeholder="Password" required />
                    <i class="uil uil-lock password"></i>
                  </div>
    
                  <!-- Register Button -->
                  <input type="submit" name="btnRegister" class="button" value="Register">

                  <!-- Signup Link -->
                  <div class="login_signup">Already have an account? <a href="login.php" id="signin">Login</a></div>
                 
                </form>
              </div>
            </div>
        </div>
        <script src="js/script.js"></script>
    </body>

</html>
