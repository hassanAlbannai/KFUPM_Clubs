<?php
echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Club Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Description</th>
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
  
	$sql_query = "SELECT ID, Name, Address, Phone, Descr FROM Club";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
		
	
	
	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>";
			echo "<input name='club_id[]' type=\"checkbox\" value=\"" .$row['ID'] ."\">";
			echo "</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>" .$row['Address'] ."</td>";
			echo "<td>" .$row['Phone'] ."</td>";
			echo "<td>" .$row['Descr'] ."</td>";
			echo "</tr>";
		}
	} else {
		die("Failed to retrieve any clubs");
	}
	
	

echo "</tbody>
	  </table>";
	  
echo "<hr>";

echo "</div>";
  
  mysqli_close($mysqli);
?>