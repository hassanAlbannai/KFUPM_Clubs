<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['project_id']) ) {
	$projects_id = $_POST['project_id'];
	$status_selects = $_POST['status_id'];
	
		for($i = 0; $i < count($projects_id); $i++) {
			$temp = explode(",", $projects_id[$i]);
			$project_id = $temp[0];
			$count = intval($temp[1]);
					
			$status = $status_selects[$count];
			
			$status_query = "SELECT StatusID FROM Project WHERE ID = '" .$project_id ."'";
			
			$result = mysqli_query($mysqli, $status_query)
				or die("Failed to query status" .mysqli_error($mysqli));
				
			if(mysqli_num_rows($result) > 0) {
				$rRow = mysqli_fetch_assoc($result);
				if($status == null && $rRow['StatusID'] == null)
					;
				else if($status == null)
					;
				else if($status == $rRow['StatusID'])
					;
				if($status != null)
					change_status($project_id, $rRow['StatusID'], $status);
				else {
					;
				}
			} else {
				if($status == null)
					;
				else if($status != null)
					change_status($project_id, NULL, $status);
				else {
					;
				}
			}
		}
		
		header('Location: ../pages/change_project_status.php');
	} 	else {
			die ("At least one project must be selected");
		}
} else {
	die( "Failed");
}

function change_status($project_id, $current_statusID, $new_statusID) {
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	$query = "UPDATE Project SET StatusID='$new_statusID' WHERE ID='$project_id'";
	
	mysqli_query($mysqli, $query) or die("Fail to update '$current_statusID', " .mysqli_error($mysqli));
}
?>