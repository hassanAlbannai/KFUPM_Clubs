<?php
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
	
	$username = $_SESSION['username'];
	$user_club_query = "SELECT ClubID FROM ClubMember WHERE StudentID = (SELECT ID FROM User WHERE UserName = '$username') AND ToDate is NULL AND StatusID = (SELECT ID FROM Status WHERE StatusTypeID = '3' AND Name = 'Active')";
	
	$user_clubs = mysqli_query($mysqli, $user_club_query)
		or die("Failed to query clubs " .mysqli_error($mysqli));
	
	if(mysqli_num_rows($user_clubs) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($user_clubs)) {
			$club_id = $row['ClubID'];
			createTable($club_id, $count);
			$count = $count + 1;
		}
	} else {
		echo "No clubs was found";
	}

function createTable($club_id, $count) {
	$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	$projects_query = "SELECT ID, Name, ProjectTypeID, Descr, StartDate FROM Project WHERE ClubID = '$club_id'";
	
	$user_projects = mysqli_query($mysqli, $projects_query)
		or die("Failed to query projects " .mysqli_error($mysqli));
		
	if(mysqli_num_rows($user_projects) > 0) {
	
	echo "<h1 style='text-align: center;'>Club $club_id</h1>";
	echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Project Name</th>
        <th>Project Type</th>
		<th>Start Date</th>
		<th>Description</th>
      </tr>
    </thead>
    <tbody>";
	
		while($project_row = mysqli_fetch_assoc($user_projects)) {
			echo "<tr>";
			
			echo "<td>";
			echo "<input name='club_project[" .$count ."]' type='checkbox' value='" .$club_id ."," .$project_row['ID'] ."," .$count ."'>";
			echo "</td>";
			
			echo "<td>" .$project_row['Name'] ."</td>";
			
			projectType($project_row['ProjectTypeID']);
			
			echo "<td>" .$project_row['StartDate'] ."</td>";
			
			echo "<td>" .$project_row['Descr'] ."</td>";
			
			echo "</tr>";
		}
		
echo "</tbody>
</table>";
echo "<hr>";
echo "</div>";
}
	

}

function projectType($projectTypeID) {
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
	
	$query = "SELECT Name FROM ProjectType WHERE ID = '$projectTypeID'";
	
	$project_types = mysqli_query($mysqli, $query)
		or die("Failed to query project types " .mysqli_error($mysqli));
		
	if(mysqli_num_rows($project_types) > 0) {
		$type_row = mysqli_fetch_assoc($project_types);
		echo "<td>" .$type_row['Name'] ."</td>";
	}
}
?>