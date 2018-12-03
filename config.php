<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$db = new mysqli($servername, $username, $password);
	// Check connection
	if ($db->connect_error) {
	    die("Connection failed: " . $db->connect_error);
	} 

	// Create database
	$sql = "CREATE DATABASE TUV_Bautista";
	if ($db->query($sql) === TRUE) {
	//     echo "Database created successfully";

	    mysqli_select_db($db, 'TUV_Bautista');

		$dump = file_get_contents('assets/info.sql');

		if ($db->multi_query($dump)=== TRUE){
		}


	}else 
	{

		mysqli_select_db($db, 'TUV_Bautista');



	}

?>