<?php
   include("../config.php");
	// require "../config.php";
	session_start();
   
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
		$myusername = mysqli_real_escape_string($dsn, $_POST['username']);
		$mypassword = mysqli_real_escape_string($dsn, $_POST['password']); 
      
		$sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
		$result = mysqli_query($dsn, $sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$active = $row['active'];
      
		$count = mysqli_num_rows($result);

		echo "TEST";
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
  
  <!-- https://www.tutorialspoint.com/php/php_mysql_login.htm  -->
   <head>
      <title>Login Page</title>   
   </head>
   
   <body>
      <div>
         <div>
            <div><b>Login</b></div>
				
            <div>
               
               <form action="" method="post">
                  <label>UserName  :</label>
                  <input type="text" name="username" class="box"/>
                  <label>Password  :</label>
                  <input type="password" name = "password" class="box" />
                  <input type="submit"value="Submit"/>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>