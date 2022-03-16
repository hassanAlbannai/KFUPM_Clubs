<?php
$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';
	$isadmin = false;
	$userid = null;
	if( isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		
		$mysqli2 = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	
	if(! $mysqli2) {
		die('Failed to connect to database' .mysqli_error());
	}
  
	$sql_query2 = "SELECT ID,UserTypeID FROM User WHERE UserName='$username'";
		
	$result = mysqli_query($mysqli2, $sql_query2)
		or die("Failed to query database" .$mysqli2 -> connect_error);
		
		if( mysqli_num_rows($result) > 0 ) {
							while($row = mysqli_fetch_assoc($result)) {
								$userid=$row['ID'];
								if($row['UserTypeID'] == 1 || $row['UserTypeID'] == 2){
				$isadmin = true;
			echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
		<th>Select</th>
        <th>Club Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Description</th>
        <th>Number of Members</th>
        <th>Number of Projects</th>
      </tr>
    </thead>
    <tbody>";
			
			
		} else{
			
			echo "<div class=\"table-responsive\">          
  <table class=\"table\">
    <thead>
      <tr>
        <th>#</th>
		<th>Select</th>
        <th>Club Name</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>";
			
		}
								
								
							}
						} else {
							die("Failed to retrieve any Clubs");
							
		
	}
	
	} else{
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
		
	}
	
	//does not work after login for whatever reason :|
	//include_once "config.php";
	
	

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);

	if(! $mysqli) {
		die('Failed to connect to database' .mysqli_error());
	}
	if( isset($_SESSION['username'])){
		
		if($isadmin){
	  $sql_query = "SELECT a.ID, a.Name, a.Address, a.Phone, a.Descr, b.sno, b.pno FROM Club a JOIN (Select c.ClubID , c.sno as sno, d.pno as pno from (SELECT ClubID, COUNT(*) AS sno FROM ClubMember GROUP BY ClubID) c join (SELECT ClubID, COUNT(*) AS pno FROM Project GROUP BY ClubID) d on c.ClubID=d.ClubID) b ON a.ID=b.ClubID;";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
	
	if(mysqli_num_rows($result) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" .$count ."</td>";
			$count = $count + 1;
			echo "<td>";
			echo "<input name='jclub_id[]' type=\"checkbox\" value='" .$row['ID'] ."," .$userid ."," .$isadmin ."'>";
			echo "</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>" .$row['Address'] ."</td>";
			echo "<td>" .$row['Phone'] ."</td>";
			echo "<td>" .$row['Descr'] ."</td>";
			echo "<td>" .$row['sno'] ."</td>";
			echo "<td>" .$row['pno'] ."</td>";
			echo "</tr>";
		}
	} else {
		die("Failed to retrieve any clubs");
	}
  } else{
	  
	  
	   $sql_query = "SELECT ID, Name, Address, Phone, Descr FROM Club;";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
	
	if(mysqli_num_rows($result) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" .$count ."</td>";
			$count = $count + 1;
			echo "<td>";
			echo "<input name='jclub_id[]' type=\"checkbox\" value='" .$row['ID'] ."," .$userid ."," .$isadmin ."'>";
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
	  
	  
  }
		
	} else{
		
		$sql_query = "SELECT ID, Name, Address, Phone, Descr FROM Club;";
	
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .$mysqli -> connect_error);
	
	if(mysqli_num_rows($result) > 0) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			echo "<td>" .$count ."</td>";
			$count = $count + 1;
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>" .$row['Address'] ."</td>";
			echo "<td>" .$row['Phone'] ."</td>";
			echo "<td>" .$row['Descr'] ."</td>";
			echo "</tr>";
		}
	} else {
		die("Failed to retrieve any clubs");
	}
		
		
	}
  
	

echo "</tbody>
  </table>
  </div>";
  
  mysqli_close($mysqli);
?>