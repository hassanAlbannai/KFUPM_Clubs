<?php
echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
        <th>Club ID</th>
        <th>Club Name</th>
		<th>President</th>
		<th>Secretary</th>
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
  
	$clubs_query = "SELECT ID, Name FROM Club";
	
	$clubs = mysqli_query($mysqli, $clubs_query)
		or die("Failed to query clubs" .mysqli_error($mysqli));
		
	if(mysqli_num_rows($clubs) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($clubs)) {
			$president_query = "SELECT StudentID FROM ClubAdmin WHERE ClubID = '" .$row['ID'] ."' AND Role = 'president' AND ToDate is NULL";
			$secretary_query = "SELECT StudentID FROM ClubAdmin WHERE ClubID = '" .$row['ID'] ."' AND Role = 'secrtary' AND ToDate is NULL";
			
			$result = mysqli_query($mysqli, $president_query)
				or die("Failed to query president" .mysqli_error($mysqli));
				
			if(mysqli_num_rows($result) > 0) {
				$rRow = mysqli_fetch_assoc($result);
				$president = $rRow['StudentID'];
			} else {
				$president = NULL;
			}
			
			$result = mysqli_query($mysqli, $secretary_query)
				or die("Failed to query secretary" .mysqli_error($mysqli));
				
			if(mysqli_num_rows($result) > 0) {
				$rRow = mysqli_fetch_assoc($result);
				$secretary = $rRow['StudentID'];
			} else {
				$secretary = NULL;
			}
			
			echo "<tr>";
			echo "<td>";
			echo "<input name='cc[]' type='checkbox' value='" .$row['ID'] ."," .$count ."'>";
			echo "</td>";
			echo "<td>" .$row['ID'] ."</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>";
			president($president, $row['ID'], $count);
			echo "</td>";
			echo "<td>";
			secretary($secretary, $row['ID'], $count);
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

function president($president_id, $club_id, $count) {
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
	echo "<select id='ps[" .$count ."]' name='ps[" .$count ."]' class='form-control'>";
	echo "<option selected>" .$president_id ."</option>";

	$members_query = "SELECT StudentID FROM ClubMember WHERE ClubID = '$club_id' AND ToDate is NULL AND StudentID <> '$president_id'";
	
	$members = mysqli_query($mysqli, $members_query)
		or die("Failed to query president members" .mysqli_error($mysqli));
	
	if(mysqli_num_rows($members) > 0) {
		while($row = mysqli_fetch_assoc($members)) {
			echo "<option>" .$row['StudentID'] ."</option>";
		}
	} else {
		
	}
}

function secretary($secretary_id, $club_id, $count) {
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
	echo "<select id='ss[" .$count ."]' name='ss[" .$count ."]' class='form-control'>";
	echo "<option selected>" .$secretary_id ."</option>";
	
	$members_query = "SELECT StudentID FROM ClubMember WHERE ClubID = '$club_id' AND ToDate is NULL AND StudentID <> '$secretary_id'";
	
	$members = mysqli_query($mysqli, $members_query)
		or die("Failed to query secretary members" .mysqli_error($mysqli));
		
	if(mysqli_num_rows($members) > 0) {
		while($row = mysqli_fetch_assoc($members)) {
			echo "<option>" .$row['StudentID'] ."</option>";
		}
	} else {
		
	}
}
?>