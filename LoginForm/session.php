<?php
    $configpath=dirname(__FILE__).'/'.'../config/config.php';
   include($configpath);
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($link,"select u.username,u.branchid,b.city,b.pincode from userinfo u,addnewbranchestb b where username = '$user_check' and b.id=u.branchid");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $branch_session = $row['branchid'];
   $branch_pincode_session = $row['pincode'];
   $branch_city_session = $row['city'];
   // $loginpath=dirname(__FILE__).'/'.'/LoginForm/login.php';
    //echo $loginpath;
   if(!isset($_SESSION['login_user'])){
     header("location:LoginForm/login.php");
     // header("location:".$loginpath);
      die();
   }
?>