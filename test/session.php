<?php
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select userid,email,fname from users where userid = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $_SESSION['userid'] = $row['userid'];
   $_SESSION['email'] = $row['email'];
   $_SESSION['fname'] = $row['fname'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
?>