<?php
session_start();
include_once "config.php";

if( isset( $_POST['join_button'] )) {
	
	if( isset($_POST['jclub_id']) ) {
		foreach($_POST['jclub_id'] as $club_id) {
		$club_id = explode(",", $club_id);
		$clubid = $club_id[0];
		$student_id = $club_id[1];
		$isadmin = $club_id[2];
		$sql_query=null;
		if($isadmin){
			$sql_query = "INSERT INTO ClubMember(ClubID,StudentID,FromDate,ToDate,StatusID) VALUES ('$clubid','$student_id','2019/1/1',null,'8')";
		}else{
			$sql_query = "INSERT INTO ClubMember(ClubID,StudentID,FromDate,ToDate,StatusID) VALUES ('$clubid','$student_id','2019/1/1',null,'9')";
		}
		mysqli_query($mysqli, $sql_query)
			or die("Failed to query database, " .mysqli_error($mysqli));
		}
		if(mysqli_affected_rows($mysqli) > 0)
			header('Location: ../pages/browse.php');
		else
			echo "did not join any club ";
	} else {
		echo "Button is not set";
	} 

			
			
			
			

		
}
?>