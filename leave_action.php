<?php
session_start();
include_once "config.php";

if( isset( $_POST['leave_button'] )) {
	
	if( isset($_POST['club_id']) ) {
		foreach($_POST['club_id'] as $club_id) {
		$club_id = explode(",", $club_id);
		$clubid = $club_id[0];
		$student_id = $club_id[1];
	
		$sql_query = "DELETE FROM ClubMember WHERE StudentID = '$student_id' AND ClubID = '$clubid'";
		
		mysqli_query($mysqli, $sql_query)
			or die("Failed to query database, " .mysqli_error($mysqli));
		}
		if(mysqli_affected_rows($mysqli) > 0)
			header('Location: ../public_html/index.php');
		else
			echo "Nothing was deleted '$student_id' '$clubid' ";
	} else {
		echo "Button not is not set";
	}
}
?>