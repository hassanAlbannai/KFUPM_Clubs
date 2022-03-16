<?php
echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Leader</th>
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
  
	$sql_query = "SELECT ID, Name FROM Project";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
		
	if(mysqli_num_rows($result) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result)) {
			$project = $row['ID'];
			$leader_query = "SELECT StudentID, Fname, Lname FROM WorksOn join Student on StudentID=ID WHERE ProjectID = '$project' AND Role='leader'";
			$row1 = mysqli_query($mysqli, $leader_query);
			
			if(mysqli_num_rows($row1) > 0) {
				$row1 = mysqli_fetch_assoc($row1);
				$leader = $row1['StudentID'];
				$Fname = $row1['Fname'];
				$Lname = $row1['Lname'];
			}
			else
				$leader = null;
				$Fname = '';
				$Lname = '';
			
			echo "<tr>";
			echo "<td>";
			echo "<input name='key[]' type=\"checkbox\" value='" .$row['ID'] .',' .$leader .',' .$count ."'>";
			echo "</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>";
			printMembers($project, $leader, $Fname, $Lname, $count);
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

function printMembers($project_id, $leader, $Fname, $Lname, $count) {
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
	
	$status = mysqli_query($mysqli, "SELECT StudentID,Fname,Lname FROM WorksOn join Student on StudentID=ID WHERE ProjectID = '$project_id' AND StudentID <> '$leader'");
	
	echo '<div class="input-group">';
	echo "<select id='leader_id[" .$count ."]' name='leader_id[" .$count ."]' class='form-control'>";
	echo "<option selected value='" .$leader ."'>" .$Fname .' ' .$Lname ."</option>";
	
	if(mysqli_num_rows($status) > 0) {
		while($row = mysqli_fetch_assoc($status)) {
			echo "<option value='" .$row['StudentID'] ."'>" .$row['Fname'] .' ' .$row['Lname'] ."</option>";
		}
	} else {
		
	}
}
?>