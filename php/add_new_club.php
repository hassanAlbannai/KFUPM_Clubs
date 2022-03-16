<?php
session_start();

require_once "config.php";

$issetFlag = false;

	//check if all variables are set
	if(isset($_POST['club_name']) &&
		isset($_POST['department']) &&
		isset($_POST['address']) &&
		isset($_POST['phone']) &&
		isset($_POST['status'])) {
			$issetFlag = true;
	}
	
	if($issetFlag) {
		//if( !empty($_POST['club_name']) )
		$name = $_POST['club_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$descr = $_POST['description'];
		if( isset($_POST['department']) ) {
			if( empty($_POST['department']) )
				$departmentID = NULL;
			else
				$departmentID = $_POST['department'];
		}
		$statusID = $_POST['status'];
		
		//query
		if($departmentID == NULL) {
			$sql_query = "INSERT INTO Club (Name, Address, Phone, Descr, StatusID) VALUES (?, ?, ?, ?, ?)";
			$statment = $mysqli -> prepare($sql_query);
			$statment -> bind_param("sssss", $name, $address, $phone, $descr, $statusID);
			$statment -> execute() or die("Failed to insert, " .mysqli_error($mysqli));
		} else {
			$sql_query = "INSERT INTO Club (Name, Address, Phone, Descr, DepartmentID, StatusID) VALUES (?, ?, ?, ?, ?, ?)";
			$statment = $mysqli -> prepare($sql_query);
			$statment -> bind_param("ssssss", $name, $address, $phone, $descr, $departmentID, $statusID);
			$statment -> execute() or die("Failed to insert, " .mysqli_error($mysqli));
		}
		
		//query the database for username & password
		//$result = mysqli_query($mysqli, $sql_query)
		//	or die("Failed to insert, " .mysqli_error($mysqli));
		
		
		header('Location: ../index.php');
	} else {
		echo "Must select all fields";
	}
	
mysqli_close($mysqli);
?>