<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['key']) ) {
	$key_id = $_POST['key'];
	$leader_id = $_POST['leader_id'];
	
		for($i = 0; $i < count($key_id); $i++) {
			$temp = explode(",", $key_id[$i]);
			$project_id = $temp[0];
			$current_leader = intval($temp[1]);
			$count = intval($temp[2]);
					
			$new_leader = $leader_id[$count];
			
			change_leader($project_id, $current_leader, $new_leader);
		}
		
		header('Location: ../pages/change_project_leader.php');
	} 	else {
			die ("At least one project must be selected");
		}
} else {
	die( "Failed");
}

function change_leader($project_id, $current_leader, $new_leader) {
	
	if($current_leader!=$new_leader){
	$date = getdate(date("U"));
	$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
	
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	mysqli_query($mysqli, "UPDATE WorksOn SET ToDate='$date', Role='member' WHERE StudentID='$current_leader'") or die(mysqli_error($mysqli));
	mysqli_query($mysqli, "UPDATE WorksOn SET Role='leader' WHERE Role='member' AND StudentID='$new_leader'") or die(mysqli_error($mysqli));
	//mysqli_query($mysqli, "INSERT INTO WorksOn (StudentID, ProjectID, FromDate, Role) VALUES ('$new_leader', '$project_id', '$date', 'leader')") or die(mysqli_error($mysqli));
		
		
	}
}
?>