<?php
require_once "config.php";

if( isset($_POST['student_id']) && isset($_POST['club_id']) ) {
	$date = getdate(date("U"));
	$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
	
	$query = "SELECT ID From Status WHERE StatusTypeID = '3' AND Name = 'pending'";
	$result = mysqli_query($mysqli, $query) or die("Failed to retrieve status" .mysqli_error($mysqli));
	$row = mysqli_fetch_assoc($result);
	$status = $row['ID'];
	
	
	$club_id = $_POST['club_id'];
	$student_id = $_POST['student_id'];
	
	$sql_query = "INSERT INTO ClubMember (ClubID, StudentID, FromDate, ToDate, StatusID) VALUES ('$club_id', '$student_id', '$date', NULL, '$status')";
	mysqli_query($mysqli, $sql_query)
		or die("Failed to insert, " .mysqli_error($mysqli));
		
	if(mysqli_affected_rows($mysqli) > 0)
		header('Location: ../index.php');
	else
		echo "No Member is Added";
			
} else {
	echo "is not set";
}
?>