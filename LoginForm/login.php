<?php
  $path=dirname(__FILE__).'/'.'../config/config.php';
  //echo $path;
   include($path);
   session_start();
   $error="";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($link,$_POST['username']);
      $mypassword = mysqli_real_escape_string($link,$_POST['password']); 
      
      $sql = "SELECT id FROM userinfo WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($link,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active =  isset($row['active']);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
      if($count == 1) {
        // session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: ../index.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Login Form | CodingLab </title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style type="text/css">
      body {
       background-image: url("../img/back3.jpg");
     }
     </style>
  </head>

           <!-- Designed By CodingLab -->

  <body>
    <div class="container">
      <form   action="" method="POST">
        <div class="title">Logistic</div>
        <div class="input-box underline">
          <input type="text" name="username" placeholder="Enter Your Username" required>
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Enter Your Password" required>
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit"  value="Login">
        </div>
      </form>
      <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

    </div>
  </body>
</html>

