<?php

@include 'conf.php';

session_start();
if(isset($_SESSION["username"]))
{
   if((time() - $_SESSION['last_login_timestamp']) > 10) //1 minute = 60 seconds
   {
      header('location: log_out.php');
   }
   else
   {
      $_SESSION['last_login_timestamp'] = time();
   }
}
else
{
   header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css.css" type="text/css">
</head>
<body>
    
<div class="container">
   <form action="" method="post">
      <h3>Welcome!</h3>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem maxime necessitatibus itaque sit adipisci odit debitis temporibus aliquid nisi totam.</p>
      <p>your email : <span><?php echo $_SESSION['username']; ?></span></p>
      <a href="log_out.php" class="log_out">logout</a>
</div>

</body>
</html>