<?php
session_start();

//does not work once again :|
//require_once "config.php";

//database variables
$server = '';
$port = 3306;
$db_username = 'admin';
$db_password = '';
$db_name = 'kstds';

//connect to database
$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);

if(! $mysqli) {
	die('Failed to connect to database' .mysqli_error());
}

	//query
	$sql_query = "SELECT ID, Name FROM Department";
	
	//query the database for username & password
	$result = $mysqli -> query($sql_query)
		or die("Failed to query database " .$mysqli -> connect_error);
	
	if( mysqli_num_rows($result) > 0 ) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<option class=\"other\" value=\"" .$row['ID'] ."\">";
			echo $row['Name'];
			echo "</option>";
		}
	} else {
		die("Failed to retrieve any departments");
	}
	
mysqli_close($mysqli);
?>
