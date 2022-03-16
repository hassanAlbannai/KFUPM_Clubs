<?php
session_start();
require_once "config.php";
//Check if value is passed
if( isset($_POST['username'] ) && isset($_POST['password']) && isset($_POST['id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['phone']) ) {
	
	
	checkEmpty();
	
	$ID = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	
	//UserTypeID = '3' -> Club Member
	//StatusID = '3' -> active
	$sql_query = "INSERT INTO User (ID, UserName, Password, UserTypeID, StatusID) VALUES ('$ID', '$username', '$password', '3', '3')";
	$sql_query2 = "INSERT INTO Student (ID, Fname, Lname, Phone, StatusID) VALUES ('$ID', '$fname', '$lname', '$phone', '6')";
	//if registered successfuly, login the user
	//else display error
	if( mysqli_query($mysqli, $sql_query) && mysqli_query($mysqli, $sql_query2)) {
		$_SESSION['logged_in'] = true;
		$_SESSION['username'] = $username;
		
		header('Location: ../index.php');
	} else {
		$_SESSION['feedback'] = "Create account failed, please try again later";
		header('Location: ../pages/sign_up.php');
	}
	
	
	mysqli_close($mysqli);
} else {
	echo "values has not been set";
}

function checkEmpty() {
	if( empty($_POST['username']) || empty($_POST['password']) || empty($_POST['id'])) {
		$_SESSION['feedback'] = "Please enter all required informations";
	} else {
		return;
	}
	
	die(header('Location: ../pages/sign_up.php'));
}
?>