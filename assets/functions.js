function back(){
	window.location.href = "user_home.php";
}

function clickedList() {     // hides the watch button

	document.cookie = "what=view";
	document.cookie = "listid=" + document.getElementById("formSelect").value;
	window.location.href = "user_games.php";
}

function clickedDeleteList(){
	
	document.cookie = "what=del_list";
	document.cookie = "listid=" + document.getElementById("formSelect").value;
	window.location.href = "delete_prompt.php";
}

function delete_user(){
	document.cookie = "what=del_user";
	window.location.href = "delete_prompt.php";
}

function autoGet(){
	document.cookie = "listid=" + document.getElementById("formSelect").value;
}
