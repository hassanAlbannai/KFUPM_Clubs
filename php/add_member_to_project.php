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
        <th>Club Member</th>
        <th>Project</th>
      </tr>
    </thead>
    <tbody>";
	
		while($project_row = mysqli_fetch_assoc($user_projects)) {
			echo "<tr>";
			
			echo "<td>";
			echo "<input name='club_project[" .$count ."]' type='checkbox' value='" .$club_id ."," .$count ."'>";
			echo "</td>";
			
			echo "<td>"; studentSelect($club_id, $count); echo "</td>";
			
			echo "<td>"; projectSelect($club_id, $count); echo "</td>";
			
			echo "</tr>";
		}
		
echo "</tbody>
</table>";
echo "<hr>";
echo "</div>";
}
}

function studentSelect($club_id, $count) {
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
	
	echo '<div class="input-group">';
	echo "<select id='student_select[" .$count ."]' name='student_select[" .$count ."]' class='form-control'>";
	echo "<option value='' selected disabled>Select a Student</option>";
	
	$studentID_query = "SELECT StudentID FROM ClubMember WHERE ClubID = '$club_id' AND ToDate is NULL";
	
	$students = mysqli_query($mysqli, $studentID_query)
		or die("Failed to query members" .mysqli_error($mysqli));
		
	if(mysqli_num_rows($students) > 0) {
		while($student = mysqli_fetch_assoc($students)) {
			$studentID = $student['StudentID'];
			$studentName_query = "SELECT Fname, Lname FROM Student WHERE ID = '$studentID'";
			$names = mysqli_query($mysqli, $studentName_query)
				or die("Failed to query name" .mysqli_error($mysqli));
			
			if(mysqli_num_rows($names) > 0) {
				$names = mysqli_fetch_assoc($names);
				$Fname = $names['Fname'];
				$Lname = $names['Lname'];
				
				echo "<option value='" .$studentID ."'>" .$Fname ." " .$Lname ."</option>";
			}
		}
	}
	
	echo "</select>";
}

function projectSelect($club_id, $count) {
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
	
	echo '<div class="input-group">';
	echo "<select id='project_select[" .$count ."]' name='project_select[" .$count ."]' class='form-control'>";
	echo "<option value='' selected disabled>Select a Project</option>";
	
	$project_query = "SELECT ID, Name FROM Project WHERE ClubID = '$club_id' AND EndDate is NULL";
	
	$projects = mysqli_query($mysqli, $project_query)
		or die("Failed to query members" .mysqli_error($mysqli));
		
	if(mysqli_num_rows($projects) > 0) {
		while($project = mysqli_fetch_assoc($projects)) {
			$projectID = $project['ID'];
			$projectName = $project['Name'];
			
			echo "<option value='" .$projectID ."'>" .$projectName ."</option>";
		}
	}
	
	echo "</select>";
}
?>