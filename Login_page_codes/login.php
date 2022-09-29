<?php

@include 'conf.php';

session_start();

if(isset($_POST['submit'])){
    
   $email = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password_field']);

   $select = " SELECT * FROM login_form WHERE email = '$email' && password_field = '$pass'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $_SESSION['username'] = $email;
      header('location:welcome.php');
      $_SESSION["name"] = $_POST["name"];
      $_SESSION['last_login_timestamp'] = time();
      header('location: welcome.php');
   }else{
      $error[] ='incorrect password or email';
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
    <h3 class="title">login now</h3>
    <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
	<div class="form">
		<div class="form-element">
			<input type="email" name="username" placeholder="enter your email">
			<p></p>
		</div>
		<div class="form-element">
			<input type="password" placeholder="enter your password" name="password_field" id="password_field">
			<div class="toggle-password">
				<i class="fa fa-eye"></i>
				<i class="fa fa-eye-slash"></i>
			</div>
		</div>
		<div>
			<input type="submit" value="login" class="form-btn" name="submit">
			<p>&ensp;&ensp;&ensp;don't have an account? <a href="register.php">register now!</a></p>
		</div>
	</div>
</div>

<script src="jss.js"></script>

</body>
</html>