<?php 
	$server = '';
	$port = 3306;
	$db_username = 'admin';
	$db_password = '';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	if( isset($_SESSION['username']) ) {
		
	} else {
		die("session not set");
	}
	$username = $_SESSION['username'];
	$query = "SELECT ClubID FROM ClubAdmin WHERE StudentID = (SELECT ID FROM User WHERE UserName = '$username')";
	$result = mysqli_query($mysqli, $query) or die("Failed to retieve anything " .mysqli_error($mysqli));
	$row = mysqli_fetch_assoc($result);
	
	echo '<input value="' .$row['ClubID'] .'" id="club_id" type="text" class="form-control" name="club_id" placeholder="Club address" disabled>';
?>
