<!DOCTYPE html>
<html>
<body>

<?php
	if( isset($_GET['q']) ) {
	//require_once "config.php";

	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	$club_id = $_GET['q'];
	$sql_query = "SELECT StudentID FROM ClubMember WHERE ClubID = '$club_id'";

	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .mysqli_error($mysqli));
	
	if( mysqli_num_rows($result) > 0 ) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<option class=\"other\" value=\"" .$row['StudentID'] ."\">";
			echo $row['StudentID'];
			echo "</option>";
		}
	} else {
		die("Failed to retrieve any students");
	}
} else {
	echo "Nothing was found";
}
?>
</body>
</html>