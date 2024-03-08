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
                    <form method ="post">
                  
                      <h2>Register</h2>
                      <!-- Register Form Start -->
                        <!-- First Name Input -->  
                        <div class="input_box">
                        <input type="text" input name="inputFname" placeholder="Enter your firstname" required />
          
                      </div>
                        <!-- Last Name Input -->  
                        <div class="input_box">
                        <input type="text" input name="inputLname" placeholder="Enter your lastname" required />
                       
                      </div>
                       <!-- UserName Input -->  
                       <div class="input_box">
                        <input type="text" input name="inputUname" placeholder="Enter your username" required />
                      
                      </div>
                      <!-- Email Input -->  
                      <div class="input_box">
                        <input type="email" input name="inputEmail" placeholder="Enter your email" required />
                        <i class="uil uil-envelope-alt email"></i>
                      </div>
                       <!-- Address Input -->  
                       <div class="input_box">
                        <input type="text" input name="inputAddress" placeholder="Enter your address" required />
                      
                      </div>
                       <!-- Birthdate Input -->  
                       <div class="input_box">
                        <input type="date" input name="inputBday" placeholder="Enter your birthdate" required />                     
                      </div>
                      <!-- Password Input -->
                      <div class="input_box">
                        <input type="password" input name="inputPassword" placeholder="Enter your password" required />
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                      </div>
          
                      <!-- Register Button -->
                      <input type="submit" name="btnRegister" class="button" value="Register">

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php

if(isset($_POST['btnRegister'])){		
	
    $fname=$_POST['inputFname'];		
	  $lname=$_POST['inputLname'];
    $username=$_POST['inputUname'];
	  $email=$_POST['inputEmail'];
    $address=$_POST['inputAddress'];
	  $bday=$_POST['inputBday'];
    $password=$_POST['inputPassword'];
    
      //save data to tbluserprofile			
    $sql1 ="Insert into tbuserprofile(firstname,lastname,address,birthdate) values('".$fname."','".$lname."','".$address."','".$bday."')";
    mysqli_query($connection,$sql1);
    
    //Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
    $sql2 ="Select * from tbluseraccount where username='".$username."'";
    $result = mysqli_query($connection,$sql2);
    $row = mysqli_num_rows($result);
  
    if($row == 0){
        $sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$username."','".$password."')";
        mysqli_query($connection,$sql);

        echo "<script language='javascript'>
                    alert('New record saved.');
              </script>";
    }else{
        echo "<script language='javascript'>
                    alert('Username already existing');
              </script>";
    }       
    
}

		

?>