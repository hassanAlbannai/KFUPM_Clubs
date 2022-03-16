<?php
session_start();

//Check if value is passed
if( isset($_POST['username'] ) && isset($_POST['password']) ) {
	require_once "config.php";
	
	checkEmpty();
	
	//username & password
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	//query
	$sql_query = "SELECT userName, Password FROM User WHERE UserName = '$username' AND Password = '$password'";
	
	//query the database for username & password
	$result = $mysqli -> query($sql_query)
		or die("Failed to query database " .$mysqli -> connect_error);
	
	if( mysqli_num_rows($result) > 0 ) {
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $username;
		
		mysqli_close($mysqli);
		function_alert("logging in");//does not work 
		
		header('Location: ../index.php');
	} else {
		$_SESSION['feedback'] = "Username or Password is Incorrect";
		
		saveUser();
		
		mysqli_close($mysqli);
		header('Location: ../pages/login.php');
	}
} else {
	echo "values has not been set";
}

function checkEmpty() {
	if( empty($_POST['username']) && empty($_POST['password']) ) {
		$_SESSION['feedback'] = "Please Enter Username and Password";
	} else if( empty($_POST['username']) ) {
		$_SESSION['feedback'] = "Please Enter Username";
	} else if( empty($_POST['password']) ) {
		$_SESSION['feedback'] = "Please Enter Password";
	} else {
		return;
	}
	
	saveUser();
	die(header('Location: ../pages/login.php'));
}

function saveUser() {
	//save username to put it in the username box in login page
	$_SESSION['username'] = $_POST['username'];
}

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 


?>