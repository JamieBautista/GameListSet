<?php
	include ("config.php");
	session_start();

	$error = "";
   
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      
		$myusername = mysqli_real_escape_string($db, $_POST['username']);
		$mypassword = mysqli_real_escape_string($db, $_POST['password']); 

		$sql = "SELECT user_id FROM user_account WHERE username = '$myusername' and password = '$mypassword'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

		$count = mysqli_num_rows($result);

		if($count == 1) {
			$_SESSION['login_user'] = $myusername;
				header("location: user_home.php");
		}else 
		{
			$error = "Your Login Name or Password is invalid";
		}
		
	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="assets/display.css">
		<script src="assets/functions.js"></script>

		<style>
			label {
				font-weight:bold;
				width:100px;
				font-size:14px;
			}
		</style>

	</head>

	
	<body>

		<div class = "container-fluid">
   			<div class = "divider"></div>
   			<div class = "divider"></div>
   			<div class = "divider"></div>
   		</div>

  		<div class="row">

  			<div class="container user_ask_add">
  				<form action = "" method = "post">
					<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name = "username" placeholder="Username">
					</div>
					<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name= "password" placeholder="Password">
					</div>

					<div style = "padding:10px;">

					<button type="submit" class="btn btn-primary btn-md btn-block" align= "center">Log In</button>

					<a href="user_add.php" style="font-size:11px; margin-top:10px">Add User Instead</a>

					<div style="font-size:11px; margin-top:10px">
						<?php
							echo $error; 

						?>
							
					</div>
					

				</form>
  			</div>

		

    </body>



</html>