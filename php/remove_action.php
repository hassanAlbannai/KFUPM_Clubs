<?php
session_start();
include_once "config.php";

if( isset( $_POST['submit_button'] )) {
	
	if( isset($_POST['club_id']) ) {
		foreach($_POST['club_id'] as $id) {
			$sql_query = "DELETE FROM Club WHERE ID = $id";
			
			$result = mysqli_query($mysqli, $sql_query)
				or die("Failed to query database, " .mysqli_error($mysqli));
		}
		if(mysqli_affected_rows($mysqli) > 0)
			header('Location: ../pages/browse.php');
		else
			echo "Nothing was deleted";
	} else {
		echo "is not set";
	}
		
} else {
	echo "Failed";
}
?>