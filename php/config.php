<?php
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
?>
