<?php
    include 'connect.php';

    $userNameUnique = true; //for the message box

    if(isset($_POST['btnRegister'])){		
	
      $fname=$_POST['inputFname'];		
      $lname=$_POST['inputLname'];
      $username=$_POST['inputUname'];
      $email=$_POST['inputEmail'];
      $address=$_POST['inputAddress'];
      $phonenum=$_POST['inputPhoneNum'];
      $gender=$_POST['inputGender'];
      $bday=$_POST['inputBday'];
      $password=$_POST['inputPassword'];
      
      //Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
      $sql2 ="Select * from tbluseraccount where username='".$username."'";
      $result = mysqli_query($connection,$sql2);
      $row = mysqli_num_rows($result);
    
      if($row == 0){
          $sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$username."','".$password."')";
          mysqli_query($connection,$sql);
          //also save data to tbluserprofile			
          $sql1 ="Insert into tbluserprofile(firstname,lastname,address,birthdate,gender,phonenumber) values('".$fname."','".$lname."','".$address."','".$bday."','".$gender."','".$phonenum."')";
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
        <link rel="stylesheet" href="css/Registration_Login.css" />
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
                    <span class="site-description-in-forms" >
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit quisquam vitae quo, nisi, nostrum quibusdam reiciendis necessitatibus nulla ut corrupti praesentium suscipit. Praesentium enim labore nulla vero, ut necessitatibus doloremque!
                    </span>
                </div>
            </div>
           <div class="right-side-child-container">
                <div class="login_form">
                    <form method ="post">
                      <h2>Register</h2>
                      <!-- Register Form Start -->
                        <!-- First Name, Last Name and Gender Input -->  
                        <div class="input_box1">
                            <input type="text" input name="inputFname" placeholder="Firstname" required />
                            <input type="text" input name="inputLname" placeholder="Lastname" required />
                            <select name="inputGender" required>
                            <option value="" disabled selected>Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                          </select>
                        </div>
                        <!-- UserName Input -->  
                       <div class="input_box">
                          <input type="text" input name="inputUname" placeholder="Username" required />
                          <?php if (!$userNameUnique): ?>
                            <span class="error_message">Username already exists. Try a different username or log in.</span>
                          <?php endif; ?>
                          <i class="uil uil-user user"></i>
                      </div>
                       <!-- Email Input -->  
                       <div class="input_box">
                        <input type="email" input name="inputEmail" placeholder="Email" required />
                        <i class="uil uil-envelope-alt email"></i>
                      </div>
                       <!-- Address Input -->  
                       <div class="input_box">
                        <input type="text" input name="inputAddress" placeholder="Address" required />
                        <i class="uil uil-location-point address"></i>
                      </div>
                        <!-- Birthdate Input -->  
                       <div class="input_box">
                        <input type="date" input name="inputBday" id="inputBday" placeholder="Birthdate" required />       
                        <i class="uil uil-calendar-alt calendar"></i>              
                      </div>
                      <!-- PhoneNumber Input -->  
                      <div class="input_box">
                            <input type="tel" input name="inputPhoneNum" placeholder="Phone number"  pattern="\d{11}" title="Please enter exactly 11 digits" required/>
                            <i class="uil uil-phone phone"></i>
                      </div>
                     
                       
                      <!-- Password Input -->
                      <div class="input_box">
                        <input type="password" input name="inputPassword" placeholder="Password" required />
                        <i class="uil uil-lock password"></i>
                      </div>
          
                      <!-- Register Button -->
                      <input type="submit" name="btnRegister" class="button" value="Register">
                      <!-- Login Link -->
                      <div class="login_signup">Already have an account? <a href="login.php" id="login">Login</a></div>

                    </form>
                </div>
            </div>
        </div>
       
    </body>
</html>

