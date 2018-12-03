<?php
	include('session.php');
	// session_start();
	if (!isset($_COOKIE['listid'])){
		echo '<script>document.cookie = "listid=";</script>';
		// setcookie('listid', '', time()-3600);
	}
	else{
		$cookie = $_COOKIE['listid'];
	}

	$message = "";

	$ses_listp1 = mysqli_query($db,"SELECT list_name FROM list WHERE list_id = '$cookie'");
	$result_listp1 =  mysqli_fetch_array($ses_listp1,MYSQLI_ASSOC);
	$list_label = $result_listp1['list_name'];

	$sql_script = mysqli_query($db,"SELECT game_num FROM games WHERE list_id = '$cookie' ORDER BY game_num DESC LIMIT 1");
	$result_ = mysqli_fetch_array($sql_script,MYSQLI_ASSOC);
			
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		if (isset($_POST['get_title'])){
			$title = mysqli_real_escape_string($db, $_POST['get_title']);
			$summary = mysqli_real_escape_string($db, $_POST['get_summary']);
			$genre = mysqli_real_escape_string($db, $_POST['get_genre']);
			$console = mysqli_real_escape_string($db, $_POST['get_console']);
			$price = mysqli_real_escape_string($db, $_POST['get_price']);
			$status = mysqli_real_escape_string($db, $_POST['get_stat']);
			$plan = mysqli_real_escape_string($db, $_POST['get_plan']);

			$value_id = (string)((int)$result_['game_num'] + 1);

			$insert_game ="INSERT INTO games VALUES ('$cookie', '$value_id', '$title', '$summary', '$genre', '$console', '$price')";
			if ($db->query($insert_game) === TRUE){
				$message = "Game Added";
			}
			else{
				$message = "Game Was Not Added";
			}

			$ses_num =  mysqli_query($db,"SELECT game_num FROM games WHERE list_id = '$cookie' AND title = '$title'");
			$result_num = mysqli_fetch_array($ses_num,MYSQLI_ASSOC);
			$gameno = $result_num['game_num'];

			$insert_stat = "INSERT INTO status VALUES ('$cookie', '$gameno', '$status', '$plan', NOW())";

			if ($db->query($insert_stat) === TRUE){
				$message = "Status Set";
			}
			else{
				$message = "Status Not Set";
			}
		}

		if (isset($_POST['get_title2'])){
			$title2 = mysqli_real_escape_string($db, $_POST['get_title2']);

			$delete_game ="DELETE FROM games WHERE title = '$title2'";
			if ($db->query($delete_game) === TRUE){
				$message = "Game Deleted";
			}
			else{
				$message = "Game Was Not Deleted";
			}
		}

		if (isset($_POST['get_title3'])){
			$title3 = mysqli_real_escape_string($db, $_POST['get_title3']);
			$stat = mysqli_real_escape_string($db, $_POST['get_stat']);

			$ses_num =  mysqli_query($db,"SELECT game_num FROM games WHERE list_id = '$cookie' AND title = '$title3'");
			$result_num = mysqli_fetch_array($ses_num,MYSQLI_ASSOC);
			$gameno = $result_num['game_num'];
			// echo $gameno;

			$edited_status ="UPDATE status SET status_type = '$stat', date_set = NOW() WHERE list_id = '$cookie' AND game_num = '$gameno'";

			if ($db->query($edited_status) === TRUE){
				$message = "Status Updated";
			}
			else{
				$message = "Status Not Updated";
			}
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

	  	<div class = "container" id="listContainer">
	  		<div class="row" id="rowPadding">
	  			<div class="col-md-2">
   					<a href="#" onclick="back()">Back</a>
   				</div>

   				<div class="col-md-6"></div>
   				
   			<!-- </div>
   			<div class="row"> -->
   				<div class="col-md-4">
   					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGames">
						Add Games
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteGames">
						Delete
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setStatus">
						Set Status
					</button>

					<div class="modal fade" id="addGames" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<label for="exampleFormControlTextarea1">Add Game</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								<div class="modal-body">
									<h4><form action = "" method = "post">
				  					<div class="form-group">

			   						<label style = "padding: 5px;">Enter Game Title</label>
									<input type="text" class="form-control" name = "get_title" placeholder="Default">

									<label style = "padding: 5px;">Enter Summary</label>
									<input type="text" class="form-control" name = "get_summary" placeholder="Default">

									<label style = "padding: 5px;">Enter Genre</label>
									<input type="text" class="form-control" name = "get_genre" placeholder="Default">

									<label style = "padding: 5px;">Enter Console</label>
									<input type="text" class="form-control" name = "get_console" placeholder="Default">

									<label style = "padding: 5px;">Enter Price</label>
									<input type="text" class="form-control" name = "get_price" placeholder="Default">

									<label style = "padding: 5px;">Enter Status</label>
									<select class="form-control" name="get_stat">
										<option value="Not Yet Bought">Not Yet Bought</option>
										<option value="Bought">Bought</option>
									</select>

									<label style = "padding: 5px;">Enter Plan</label>
									<textarea class="form-control" name = "get_plan" rows="5"></textarea>
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
	  			<!-- <div class="col-md-2" style="align:center;"> -->
					

					<div class="modal fade" id="deleteGames" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<label for="exampleFormControlTextarea1">Delete Game</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								<div class="modal-body">
									<h4><form action = "" method = "post">
				  					<div class="form-group">

			   						<label style = "padding:5px;">Enter Game Title</label>
									<input type="text" class="form-control" name = "get_title2" placeholder="Default">

									<div style = "padding:10px;">
										<button type="submit" class="btn btn-primary btn-sm" align= "center">Delete</button>
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
									</div>
			  						</div>
			  						</form></h4>
								</div>

							</div>
						</div>
					</div>
	  			<!-- </div> -->
	  			<!-- <div class="col-md-2"> -->
	  				

					<div class="modal fade" id="setStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<label for="exampleFormControlTextarea1">Set Status</label>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
									
								<div class="modal-body">
									<h4><form action = "" method = "post">
				  					<div class="form-group">

				  					<label style = "padding: 5px;">Enter Game Title</label>
									<input type="text" class="form-control" name = "get_title3" placeholder="Default">

									<label style = "padding: 5px;">Enter Status</label>
									<select class="form-control" name="get_stat">
										<option value="Not Yet Bought">Not Yet Bought</option>
										<option value="Bought">Bought</option>
									</select>

									<div style = "padding:10px;">
										<button type="submit" class="btn btn-primary btn-sm" align= "center">Set</button>
										<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
									</div>

			  						</div>
			  						</form></h4>
								</div>

							</div>
						</div>
					</div>
	  			<!-- </div> -->
	  		</div>
   		</div>

   		<div class = "container-fluid">
   			<div class = "divider"></div>
   		</div>

   		<div class = "container" id="listContainer">

   			<div class = "row" id ="rowPadding">
   				<div class="col-md-4"></div>
   				<div class="col-md-4">
   					<label style = "color: white;">Games from "<?php echo $list_label; ?>"</label>
   				</div>
   				<div class="col-md-4">
   				</div>
   			</div>

   			<!-- <div class = "row"id = "rowPadding"> -->
   				<table class="table table-bordered" id="tableS">
					<thead class="dark">
						<tr>
							<th scope="col" class = "text-center">Title</th>
							<th scope="col" class = "text-center">Summary</th>
							<th scope="col" class = "text-center">Genre</th>
							<th scope="col" class = "text-center">Console</th>
							<th scope="col" class = "text-center">Price</th>
							<th scope="col" class = "text-center">Status</th>
							<th scope="col" class = "text-center">Plans</th>
						</tr>
					</thead>
   				<?php
					$ses_games = mysqli_query($db,"SELECT title, summary, genre, console, price, status_type, plans, date_set FROM games, status WHERE games.list_id = '$cookie' AND status.list_id = '$cookie' AND games.game_num = status.game_num ORDER BY status_type");

					echo '<tbody class="gray">';
					// foreach ($sesgames as $result_games){}	
					while ($result_games =  mysqli_fetch_array($ses_games)){
					echo'<tr>
						<td>' . $result_games['title'] . '</td>
						<td>' . $result_games['summary'] .'</td>
						<td>' . $result_games['genre'] . '</td>
						<td>' . $result_games['console'] . '</td>
						<td>' . $result_games['price'] . '</td>
						<td>' . $result_games['status_type'] . '</td>
						<td>' . $result_games['plans'] . '</td>
						</tr>';
					}

					echo '</tbody>';
				?>
				</table>
   			<!-- </div> -->

   		</div>

   </body>
   
</html>