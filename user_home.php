<?php
	include('session.php');
	
	$message = "";

	$sql_script = mysqli_query($db,"SELECT list_id FROM list ORDER BY list_id DESC LIMIT 1");
	$result_ = mysqli_fetch_array($sql_script,MYSQLI_ASSOC);

	if($_SERVER["REQUEST_METHOD"] == "POST") {

		if (isset($_POST['get_listName'])){
			$mylistname = mysqli_real_escape_string($db, $_POST['get_listName']);
			$value_id = (string)((int)$result_['list_id'] + 1);

			$insert_list ="INSERT INTO list (user_id, list_id, list_name) VALUES ('$get_id', '$value_id', '$mylistname')";

			if ($db->query($insert_list) === TRUE){
				$message = "List Added";
				echo '<script>document.cookie = "listid=";</script>';
			}
			else{
				$message = "List Was Not Added";
			}
		}

		if (isset($_POST['get_edited'])){
			$value = $_POST['get_edited'];
			setcookie('get', $value, time()+3600);
			echo '<script>window.location.href = "edited_prompt.php";</script>';
			// header("location: edited_prompt.php");	
		}

		if (isset($_POST['edit_money'])){
			$value = $_POST['edit_money'];
			setcookie('money', $value, time()+3600);
			echo '<script>window.location.href = "edited_prompt.php";</script>';
			// header("location: edited_prompt.php");	
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
		
	</head>
   
   <body>
   		<div style="font-size:11px; margin-top:10px; color: red; align:center;">
			<?php
				echo $message; 
			?>
		</div>

   		<?php
   			include("header.php");
   		?>   		

	  	<div class = "container-fluid">
   			<div class = "divider"></div>
   		</div>

   		<div class = "container" id = "listContainer">
   			<div class="row" id = "rowPadding">
   				<div class="col-md-4">
   				</div>
   				<div class="col-md-4">
   					<label style = "color: white;">Lists</label>
   				</div>
   				<div class="col-md-4">
   				</div>
   			</div>

   			<div class="row" id = "rowPadding">
   				<div class="col-md-3"></div>
   				<div class="col-md-6">
   					<div class="form-group" method = "post">
   					<!-- <form action = "" method = "post"> -->
						<select class="form-control" id="formSelect">
							<option value="">
								-----
							</option>
							<?php
								$ses_list = mysqli_query($db,"SELECT list_id, list_name FROM list WHERE user_id = '$get_id'");
								while ($result_list =  mysqli_fetch_array($ses_list,MYSQLI_ASSOC)){
							?>
								<option value = "<?php echo $result_list['list_id']; ?>">
									<?php echo $result_list['list_name']; ?>
									
								</option>

							<?php
								}
							?>
						</select>
					<!-- </form> -->
					</div>
				</div>

				<div class="col-md-1">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addList">
						<span class="glyphicon glyphicon-plus"></span> Add List
					</button>

					<div class="modal fade" id="addList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
				   					<label for="exampleFormControlTextarea1">Enter List Name</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								<div class="modal-body">
									<h4><form action = "edited_prompt.php" method = "post">
				  					<div class="form-group">
										<input type="text" class="form-control" name = "get_listName" placeholder="Default">
										<div style = "padding:10px;">
											<button type="submit" class="btn btn-primary btn-sm" align= "center">Add</button>
											<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
										</div>
			  						</div>
			  						</form></h4>
								</div>

							</div>
						</div>
					</div>
				</div>

				<div class="col-md-2"></div>
			</div>

			<div class="row" id = "rowPadding">
				<div class="col-md-3"></div>
				<div class="col-md-6">
   					<a class="btn btn-primary btn-sm" href="#" role="button" onclick="clickedList()">
						View Games
					</a>
   					
					<a class="btn btn-primary btn-sm" href="#" role="button" onclick="clickedDeleteList()">
						Delete
					</a>
					
					<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editList">
						<!-- <span class="glyphicon glyphicon-edit"> -->
							Edit Name
						<!-- </span> -->
					</button>

					<div class="modal fade" id="editList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
			   						<label for="exampleFormControlTextarea1">Edit List Name</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								<div class="modal-body">
									<h4><form action = "" method = "post">
				  					<div class="form-group">
									<input type="text" class="form-control" name = "get_edited" placeholder="Edited List Name">
			  					
									<div style = "padding:10px;">
										<button type="submit" class="btn btn-primary btn-sm" align= "center" onclick="autoGet()">Edit</button>
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
									</div>
			  						</div>
			  						</form></h4>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3"></div>
			</div>

				


	  		<div class="row" id = "rowPadding"><!-- 
   				<div class="col-md-6"></div>
	  			<div class="col-md-6"></div> -->
	  			<div class="col-md-6">
	  				
	  			</div>
	  		</div>
   		</div>

   </body>
   
</html>