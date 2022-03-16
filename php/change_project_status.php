<?php
echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>";
	
	//does not work after login for whatever reason :|
	//include_once "config.php";
	
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);

	if(! $mysqli) {
		die('Failed to connect to database' .mysqli_error());
	}
  
	$sql_query = "SELECT ID, Name, StatusID FROM Project";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
		
	if(mysqli_num_rows($result) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result)) {;
			
			echo "<tr>";
			echo "<td>";
			echo "<input name='project_id[]' type=\"checkbox\" value='" .$row['ID'] .',' .$count ."'>";
			echo "</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>";
			printStatus($row['StatusID'], $count);
			echo "</td>";
			echo "</tr>";
			$count = $count + 1;
		}
	} else {
		die("Failed to retrieve any clubs");
	}
	
echo "</tbody>
	  </table>";  
echo "<hr>";
echo "</div>";
  
mysqli_close($mysqli);

function printStatus($current_status, $count) {
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);

	if(! $mysqli) {
		die('Failed to connect to database' .mysqli_error($mysqli));
	}
	
	$status = mysqli_query($mysqli, "SELECT Name FROM Status WHERE ID = '$current_status'");
	$status = mysqli_fetch_assoc($status);
	
	echo '<div class="input-group">';
	echo "<select id='status_id[" .$count ."]' name='status_id[" .$count ."]' class='form-control'>";
	echo "<option selected value='" .$current_status ."'>" .$status['Name'] ."</option>";
	
	$status = mysqli_query($mysqli, "SELECT ID, Name FROM Status WHERE StatusTypeID = 1 AND ID <> '$current_status'");
	
	if(mysqli_num_rows($status) > 0) {
		while($row = mysqli_fetch_assoc($status)) {
			echo "<option value='" .$row['ID'] ."'>" .$row['Name'] ."</option>";
		}
	} else {
		
	}
}
?>