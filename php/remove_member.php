<?php
echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Student ID</th>
		<th>Student Name</th>
        <th>Club ID</th>
        <th>Club Name</th>
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
		die('Failed to connect to database' .mysqli_error($mysqli));
	}
  
	$students_query = "SELECT ClubID, StudentID,Fname,Lname FROM ClubMember join Student on StudentID=ID";
	
	$students = mysqli_query($mysqli, $students_query)
		or die("Failed to query database" .mysqli_error($mysqli));
		
	if(mysqli_num_rows($students) > 0) {
		while($row = mysqli_fetch_assoc($students)) {
			$clubs_query = "SELECT Name FROM Club WHERE ID = '" .$row['ClubID'] ."'";
			$clubs = mysqli_query($mysqli, $clubs_query)
				or die("Failed to query database" .mysqli_error($mysqli));
			$club_name = mysqli_fetch_assoc($clubs);
			
			echo "<tr>";
			echo "<td>";
			echo "<input name='sc_id[]' type=\"checkbox\" value='" .$row['StudentID'] ."," .$row['ClubID'] ."'>";
			echo "</td>";
			echo "<td>" .$row['StudentID'] ."</td>";
			echo "<td>" .$row['Fname'] ." " .$row['Lname'] ."</td>";
			echo "<td>" .$row['ClubID'] ."</td>";
			echo "<td>" .$club_name['Name'] ."</td>";
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