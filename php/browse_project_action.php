<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {

	if( isset($_POST['club_project']) ) {
	$club_project = $_POST['club_project'];
	
	$date = getdate(date("U"));
	$date = $date['year'] ."-" .$date['mon'] ."-" .$date['mday'];
	
		for($i = 0; $i < count($club_project); $i++) {
			$temp = explode(",", $club_project[$i + 1]);
			
			$club_id = $temp[0];
			$project_id = $temp[1];
			$count = intval($temp[2]);

			$username = $_SESSION['username'];

			$ID = mysqli_query($mysqli, "SELECT ID FROM User WHERE UserName = '$username'")
				or die("Incorrect ID " .mysqli_error($mysqli));
				
			if(mysqli_num_rows($ID) > 0) {
				$ID = mysqli_fetch_assoc($ID);
				$ID = $ID['ID'];
				
				$work_query = "INSERT INTO WorksOn (StudentID, ProjectID, FromDate, Role) VALUES ('$ID', '$project_id', '$date', 'member')";
				
				$result = mysqli_query($mysqli, $work_query)
					or die("Failed To Insert any value " .mysqli_error($mysqli));
					
				if(mysqli_affected_rows($mysqli) == 0) {
					echo "Nothing Changed";
				}
			} else {
				echo "No ID is found";
			}
		}
	} else {
		die ("At least one Club must be selected");
	}
		
		//header('Location: ../index.php');
	} else {
		die("Failed");
	}

?>