<?php
	include('config.php');
	session_start();

	$user_check = $_SESSION['login_user'];

	$ses_sql = mysqli_query($db,"SELECT user_id, username FROM user_account WHERE username = '$user_check' ");
	// $ses_id = mysqli_query($db,"SELECT user_id FROM user_account WHERE username = '$user_check' ");

	$result_name = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	$login_session = $result_name['username'];
	$get_id = $result_name['user_id'];

	$ses_money = mysqli_query($db,"SELECT currency, current_savings FROM current_money WHERE user_id = '$get_id'");
	$result_money =  mysqli_fetch_array($ses_money,MYSQLI_ASSOC);
	$get_curr = $result_money['currency'];
	$get_sav = $result_money['current_savings'];


	// $ses_games = mysqli_query($db,"SELECT title, summary, genre, console, price FROM games WHERE user_id = '$get_id'");

	if(!isset($_SESSION['login_user'])){
		header("location:index.php");
	}
?>