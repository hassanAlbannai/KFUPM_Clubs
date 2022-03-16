<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['club_project']) ) {
	$club_project = $_POST['club_project'];
	$student_selects = $_POST["student_select"];
	$project_selects = $_POST["project_select"];
	
		for($i = 0; $i < count($club_project); $i++) {
			$temp = explode(",", $club_project[$i + 1]);
			
			$club_id = $temp[0];
			$count = intval($temp[1]);
			
			$student_id = $student_selects[$i + 1];
			$project_id = $project_selects[$i + 1];
			
			$date = getdate(date("U"));
			$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
				
			$work_query = "INSERT INTO WorksOn (StudentID, ProjectID, FromDate, Role) VALUES ('$student_id', '$project_id', '$date', 'member')";
			
			$result = mysqli_query($mysqli, $work_query)
				or die("Failed To Insert any value " .mysqli_error($mysqli));
				
			if(mysqli_affected_rows($mysqli) == 0) {
				echo "Nothing Changed";
			}
		}
	} else {
		die ("At least one Club must be selected");
	}
		
		header('Location: ../index.php');
	} else {
		die("Failed");
	}

?>