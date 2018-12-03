<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="assets/display.css">
		<script src="assets/functions.js"></script>

		<div class = "container-fluid">
   			<div class = "divider"></div>
   		</div>

   		<div class = "container" id = "headerContainer">
			<div class="row">
	  			<div class="col-md-6">
	  				<h2>Welcome, <?php echo $login_session; echo "!"; ?></h2>
	  				<h4>
	  					<a href = "#" onclick="delete_user()">Delete User Account</a> 
	  					||
	  					<a href = "logout.php">Sign Out</a>
	  				</h4>

	  			</div>
	  			<div class="col-md-6">
	  				<h3><?php echo $get_curr; echo " "; echo $get_sav; ?></h3>
	  				<h4>
	  					<form class="form-inline" action = "edited_prompt.php" method = "post">
	  					<div class="form-group">
						<input type="text" class="form-control" name = "edit_money" placeholder="0">
						<button type="submit" class="btn btn-primary btn-sm" align= "center">Edit Money</button>
  						</div>
  						</form>
	  				</h4>
	  			</div>
	  		</div>
	  	</div>
	</head>

	<body>
	</body>

</html>