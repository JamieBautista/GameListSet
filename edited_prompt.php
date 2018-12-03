<?php
	include('user_home.php');
	// session_start();
	if (!isset($_COOKIE['listid'])){
		echo '<script>document.cookie = "listid=";</script>';
		// setcookie('listid', '', time()-3600);
	}
	else{
		$cookie = $_COOKIE['listid'];
	}

	$error = "";

	if (isset($_COOKIE['get'])){
		$value = $_COOKIE['get'];
		$edited_list ="UPDATE list SET list_name = '$value' WHERE user_id = '$get_id' AND list_id = '$cookie'";

			if ($db->query($edited_list) === TRUE){
				echo '<script>document.cookie = "listid=";</script>';
			}
			else{
				$error = mysqli_error($db);
				echo mysqli_error($db);
			}
	}

	if (isset($_COOKIE['money'])){
		$value = $_COOKIE['money'];
		$edited_money ="UPDATE current_money SET current_savings = '$value' WHERE user_id = '$get_id'";

			if ($db->query($edited_money) === TRUE){
			}
			else{
				$error = mysqli_error($db);
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

		<script>
			back();

		</script>
	</head>
   
   <body>

   </body>
   
</html>