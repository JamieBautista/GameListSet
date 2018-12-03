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

	if ($_COOKIE['what'] === 'del_list'){
		$delete_list ="DELETE FROM list WHERE list_id = '$cookie'";
		if ($db->query($delete_list) === TRUE){
		}
		else{
			$error = mysqli_error($db);
			echo mysqli_error($db);
		}
	}

	if ($_COOKIE['what'] === 'del_user'){
		$delete_user ="DELETE FROM user_account WHERE user_id = '$get_id'";
		if ($db->query($delete_user) === TRUE){
			echo '<script>window.location.href = "index.php";</script>';
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