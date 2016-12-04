<?php
   include_once('connection.php');
   session_start();
   $error = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // email and password sent from form 
      
      $email = mysqli_real_escape_string($db,$_POST['email']);
      $password = mysqli_real_escape_string($db,$_POST['password']); 
	  $sql = "SELECT pass FROM users WHERE email = '$email'";
	  $result = mysqli_query($db,$sql);
	  $row = mysqli_fetch_assoc($result);
	  $pass = $row['pass'];
	  if (password_verify($password,$pass))
	  {
		  $sql = "SELECT userid FROM users WHERE email = '$email' and pass = '$pass'";
		  $result = mysqli_query($db,$sql);
		  $row = mysqli_fetch_assoc($result);
		  $userid = $row['userid'];
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  $active = $row['active'];
		  
		  $count = mysqli_num_rows($result);
		  
		  // If result matched $email and $pass, table row must be 1 row
			
		  if($count == 1) {
			 
			 $_SESSION['login_user'] = $userid;
			 
			 header("location: welcome.php");
		  }else {
			 $error = "Your Email or Password is invalid";
		  }
	  }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Email  :</label><input type = "text" name = "email" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>

<?php
	//Close connection
	mysqli_close($db);
?>