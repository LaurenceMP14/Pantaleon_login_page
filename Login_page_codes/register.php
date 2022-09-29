<?php

@include 'conf.php';

session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['username']);
   $pass2 = mysqli_real_escape_string($conn, $_POST['password_field']);
   $pass = md5($_POST['password_field']);
   $cpass = md5($_POST['cpassword']);

   $select = " SELECT * FROM login_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   $uppercase = preg_match('@[A-Z]@', $pass2);
   $number    = preg_match('@[0-9]@', $pass2);
   $specialChars = preg_match('@[^\w]@', $pass2);

   if(!$uppercase || !$number || !$specialChars || strlen($pass2) < 8) {
      $error[] = 'Password should be at least 8 characters long and should have at least one upper case letter, one number, and one special character.';
      session_destroy();
   }
   else {
   if(mysqli_num_rows($result) > 0){
      $error[] = 'username already exist';
   }else{
      if($pass != $cpass){
         $error[] = 'password dont matched!';
         session_destroy();
      }else{
         $insert = "INSERT INTO login_form(email, password_field) VALUES('$email','$pass')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>

<div class="center">
   <form action="" method="post">
    <h4 class="title">register now</h4>
   <div class="form">
      <div class="form-element">
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
         <input type="email" name="username" placeholder="enter your email">
         <p></p>
      </div>
      <div class="form-element">
         <input type="password" placeholder="enter your password" name="password_field" id="password_field">
         <div class="toggle-password">
            <i class="fa fa-eye"></i>
            <i class="fa fa-eye-slash"></i>
         </div>
         <div class="password-policies">
            <div class="policy-length">
               8 Characters
            </div>
            <div class="policy-number">
               Contains Number
            </div>
            <div class="policy-uppercase">
               Contains Uppercase
            </div>
            <div class="policy-special">
               Contains Special Characters
            </div>
         </div>
      </div>
      <div class="form-element">
        <input type="password" name="cpassword" placeholder="confirm your password">
      </div>
      <div>
         <input type="submit" value="register" class="form-btn" name="submit">
      </div>
      <p>&ensp;&ensp;&ensp;already have an account? <a href="login.php">login now!</a></p>
   </div>
</div>

<script src="jss.js"></script>

</body>
</html>