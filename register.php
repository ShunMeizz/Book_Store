<?php
    include 'connect.php';
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
                    <select name="acct_type" class="input_box1">
                      <option value="user">user</option>
                      <option value="admin">admin</option>
                    </select>
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
                    <div class="input_box1 street">
                      <input type="text" name="inputAddress-street" placeholder="Street" required />
                    </div>
                    <div class="input_box1 zipcode">
                      <input type="text" name="inputAddress-zipcode" placeholder="Zip Code" required />
                    </div>
                  </div>

                  <!-- Username Input -->  
                  <div class="input_box">
                    <input type="text" name="inputUname" placeholder="Username" required />
                         <!-- <div id="username-error" class="error_message" style="display: none;">
                              Username already exists. Try a different username or log in.
                          </div>-->
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
        <div id="registration-success-message-box">
          <div class="registration-success-message-flexbox">
            <div class="upper-part-registration-success-message">
              <img width= "50" src="images/checked.png" alt="check-symbol" class="check-symbol">
              <span class="success-message">Success!</span>
              <p class="new-record-saved">New record saved.</p>
            </div>
            <div class="lower-part-registration-success-message">
              <div class="triangle-down"></div>
              <div class="login-button">
                <a href="login.php" target="_parent"><div class="close-to-login"><span class="login-text">Login</span></div></a>
              </div>
            </div>
          </div>
        </div>  
        <div id="error-message-box">
          <div class="error-message-flexbox">
            <div class="upper-part-error-message">
              <img width= "50" src="images/wronged.png" alt="error-symbol" class="error-symbol">
              <span class="error-bold-message">Error!</span>
              <p class="unrecorded-message">Error Message</p> <!-- This will be dynamically updated -->
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
   
   if(isset($_POST['btnRegister'])){
    $username= mysqli_real_escape_string($connection, $_POST['inputUname']);
    $email= mysqli_real_escape_string($connection, $_POST['inputEmail']);
    $password = mysqli_real_escape_string($connection, $_POST['inputPassword']);
    $fname= mysqli_real_escape_string($connection, $_POST['inputFname']);
    $lname= mysqli_real_escape_string($connection, $_POST['inputLname']);
    $region= mysqli_real_escape_string($connection, $_POST['inputAddress-region']);
    $city= mysqli_real_escape_string($connection, $_POST['inputAddress-city']);
    $street= mysqli_real_escape_string($connection, $_POST['inputAddress-street']);
    $zipcode= mysqli_real_escape_string($connection, $_POST['inputAddress-zipcode']);
    $phonenum= mysqli_real_escape_string($connection, $_POST['inputPhoneNum']);
    $bday= mysqli_real_escape_string($connection, $_POST['inputBday']);
    $acct_type = $_POST['acct_type'];

    //Getting age from the birthday
    $birthdate = new DateTime($bday);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate)->y;
    
    if($age<15){
      echo '<script>showError("You must be atleast 15 years old");</script>'; //Age verification
    }else{ //insert data Sequence: tblAddress(to get the addressID) -> tbluserprofile(to get the userID) -> tbluseraccount (to store the userID)
      $select_users = mysqli_query($connection, "SELECT * FROM `tbluseraccount` WHERE emailadd = '$email' AND password = '$password'") or die('query failed');
  
      if(mysqli_num_rows($select_users) == 0){
        mysqli_query($connection, "INSERT INTO `tbladdress` (region, city, zipcode, street) VALUES ('$region', '$city', '$zipcode', '$street')") or die('query failed');
        // Retrieve the newly generated `addressID`
        $addressID = mysqli_insert_id($connection);
        // Insert profile information into the `tbluserprofile` table
        mysqli_query($connection, "INSERT INTO `tbluserprofile` (firstname, lastname, addressID, phonenumber, birthdate, age) VALUES ('$fname', '$lname', '$addressID', '$phonenum', '$bday', '$age')")or die('query failed');
        $userID = mysqli_insert_id($connection);
  
        mysqli_query($connection, "INSERT INTO `tbluseraccount` (userID, emailadd, username, password, acct_type) VALUES ('$userID','$email', '$username', '$password', '$acct_type')") or die('query failed');
        echo "<script>registerSuccess();</script>";  
      }else{
        echo '<script>showError("Username already exists!");</script>'; //for Username already exists
      }
    }
  }
?>
