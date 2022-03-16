<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['cc']) ) {
	$club_count = $_POST['cc'];
	$p_selects = $_POST['ps'];
	$s_selects = $_POST['ss'];
	
		for($i = 0; $i < count($club_count); $i++) {
			$temp = explode(",", $club_count[$i]);
			$club_id = $temp[0];
			$count = intval($temp[1]);
					
			$president = $p_selects[$count];
			$secretary = $s_selects[$count];
			
			$president_query = "SELECT StudentID FROM ClubAdmin WHERE ClubID = '" .$club_id ."' AND Role = 'president' AND ToDate is NULL";
			$secretary_query = "SELECT StudentID FROM ClubAdmin WHERE ClubID = '" .$club_id ."' AND Role = 'secrtary' AND ToDate is NULL";
			
			$result = mysqli_query($mysqli, $president_query)
				or die("Failed to query president" .mysqli_error($mysqli));
				
			if(mysqli_num_rows($result) > 0) {
				$rRow = mysqli_fetch_assoc($result);
				if($president == null && $rRow['StudentID'] == null)
					;//die( "president 1");//do nothing
				else if($president == $rRow['StudentID'])
					;//do nothing
				else if($president == null)
					;//die( "president 2");//do nothing
				else if($president == $rRow['StudentID'])
					;//die( "president 3");//do nothing
				else if($president != null)
					change_president($club_id, $rRow['StudentID'], $president);
				else {
					;//die( "president 4");
				}
			} else {
				if($president == null)
					;//die( "president 2");//do nothing
				else if($president != null)
					change_president($club_id, NULL, $president);
				else {
					;//die( "president 4");
				}
			}

			$result = mysqli_query($mysqli, $secretary_query)
				or die("Failed to query secretary" .mysqli_error($mysqli));
				
			if(mysqli_num_rows($result) > 0) {
				$rRow = mysqli_fetch_assoc($result);
				if($secretary == null && $rRow['StudentID'] == null)
					;//die( "secretary 1");//do nothing
				else if($seceretary == $rRow['StudentID'])
					;//do nothing
				else if($secretary == null)
					;//die( "secretary 2");//do nothing
				else if($secretary == $rRow['StudentID'])
					;//die( "secretary 3");//do nothing
				else if($secretary != null)
					change_secretary($club_id, $rRow['StudentID'], $secretary);
				else {
					;//die( "secretary 4");//Do nothing
				}
			} else {
				if($secretary == null)
					;//die( "secretary 3");//do nothing
				else if($secretary != null)
					change_secretary($club_id, NULL, $secretary);
				else {
					;//die( "secretary 4");//Do nothing
				}
			}
		}
	} 	else {
			die ("At least one Club must be selected");
		}
		
		header('Location: ../index.php');
} else {
	die( "Failed");
}

function change_president($club_id, $current_president, $new_president) {
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	$date = getdate(date("U"));
	$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
	
	$appoint_new = "INSERT INTO ClubAdmin (ClubID, StudentID, FromDate, ToDate, Role) VALUES ('$club_id', '$new_president', '$date', NULL, 'president')";
	mysqli_query($mysqli, $appoint_new) or die("president: fail to appoint '$new_president', " .mysqli_error($mysqli));
	
	$remove_president = "UPDATE ClubAdmin SET ToDate = '$date' WHERE StudentID = '$current_president'";
	mysqli_query($mysqli, $remove_president) or die("president: fail to remove '$current_president', " .mysqli_error($mysqli));
}

function change_secretary($club_id, $current_secretary, $new_secretary) {
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	$date = getdate(date("U"));
	$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
	
	$appoint_new = "INSERT INTO ClubAdmin (ClubID, StudentID, FromDate, ToDate, Role) VALUES ('$club_id', '$new_secretary', '$date', NULL, 'secrtary')";
	mysqli_query($mysqli, $appoint_new) or die("seceretary: fail to appoint '$new_secretary' " .mysqli_error($mysqli));
	
	$remove_secretary = "UPDATE ClubAdmin SET ToDate = '$date' WHERE StudentID = '$current_secretary'";
	mysqli_query($mysqli, $remove_secretary) or die("seceretary: fail to remove '$current_seceretary' " .mysqli_error($mysqli));
}
?>