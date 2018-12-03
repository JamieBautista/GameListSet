<?php
	include ("config.php");
	session_start();

	$sql_script = mysqli_query($db,"SELECT user_id FROM user_account ORDER BY creation_date DESC LIMIT 1");
	$result_ = mysqli_fetch_array($sql_script,MYSQLI_ASSOC);
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
		$user = mysqli_real_escape_string($db,$_POST['username']);
		$password = mysqli_real_escape_string($db,$_POST['password']); 
		$currency = mysqli_real_escape_string($db,$_POST['currency']); 

		$value_id = (string)((int)$result_['user_id'] + 1);

		$sql = "INSERT INTO user_account VALUES ('$value_id', '$user', '$password', NOW()); 
		INSERT INTO current_money (user_id, currency) VALUES ('$value_id', '$currency')";
      
		if ($db->multi_query($sql) === TRUE){
			$_SESSION['login_user'] = $user;
			header("location: user_home.php");
		}
		else{
			echo mysqli_error($db);
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
  			<div class="col-md-4"></div>

  			<div class="container user_ask_add">
  				<form action = "" method = "post">
					<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name = "username" placeholder="Enter Your Username">
					<label>Currency</label>
					<input type="text" class="form-control" name= "currency" placeholder="Enter Your Currency">
					<label>Password</label>
					<input type="password" class="form-control" name= "password" placeholder="Enter Your Password">
					
					</div>

					<div style = "padding:10px;">

					<button type="submit" class="btn btn-primary btn-md btn-block" align= "center">Add User</button>

					<a href="user_home.php" style="font-size:11px; margin-top:10px">Go Back to Log-in Page</a>
				</form>
  			</div>

  			<div class="col-md-4"></div>
  		</div>
	
      

   </body>
	


</html>