<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['club_id']) && isset($_POST['student_id']) ) {
		$club_id = $_POST['club_id'];
		$student_id = $_POST['student_id'];
	
		$sql_query = "DELETE FROM ClubMember WHERE StudentID = '$student_id' AND ClubID = '$club_id'";
		
		mysqli_query($mysqli, $sql_query)
			or die("Failed to query database, " .mysqli_error($mysqli));
		}
		if(mysqli_affected_rows($mysqli) > 0)
			header('Location: ../pages/remove_member.php');
		else
			echo "Nothing was deleted";
	} else {
		echo "Button not is not set";
	}
?>