<?php
$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
	$port = 3306;
	$db_username = 'admin';
	$db_password = 'KFUPM123';
	$db_name = 'kstds';
	$userid = null;
	if( isset($_SESSION['username'])){
		$username = $_SESSION['username'];
		
		$mysqli2 = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
	
	if(! $mysqli2) {
		die('Failed to connect to database' .mysqli_error());
	}
  
	$sql_query2 = "SELECT ID FROM User WHERE UserName='$username'";
		
	$result = mysqli_query($mysqli2, $sql_query2)
		or die("Failed to query database" .$mysqli2 -> connect_error);
		
		if( mysqli_num_rows($result) > 0 ) {
							while($row = mysqli_fetch_assoc($result)) {
								$userid=$row['ID'];
									
							}
						} else {
							die("Failed to retrieve any Clubs");
							
	}
	}
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
	
	//does not work after login for whatever reason :|
	//include_once "config.php";
	
	

	//connect to database
	$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);

	
	  
	  
	   $sql_query = "SELECT a.ID ,a.Name, a.Address, a.Phone, a.Descr FROM Club a join (select ClubID from ClubMember where StudentID='$userid') b on a.ID=b.ClubID;";
	   $sql_queryS = "SELECT StatusID FROM ClubMember WHERE StudentID = '$userid' " ;
	$resultss = mysqli_query($mysqli, $sql_queryS) ;
	$result = mysqli_query($mysqli, $sql_query)
		or die("Failed to query database" .mysqli_error($mysqli));
	  
	if(mysqli_num_rows($result) > 0 ) {
		$count = 1;
		while($row = mysqli_fetch_assoc($result) ) {
			 $row2 = mysqli_fetch_assoc($resultss);
			if( $row2['StatusID']!=9){
				echo "<tr>";
			echo "<td>" .$count ."</td>";
			$count = $count + 1;
			echo "<td>";
		    echo "<input name='club_id[]' type=\"checkbox\" value='" .$row['ID'] ."," .$userid ."'>";
			echo "</td>";
			echo "<td>" .$row['Name'] ."</td>";
			echo "<td>" .$row['Address'] ."</td>";
			echo "<td>" .$row['Phone'] ."</td>";
			echo "<td>" .$row['Descr'] ."</td>";
			echo "</tr>";
			}
			
		}
	} else {
		die("you have no clubs");
	}
	  
	  
  
	

echo "</tbody>
  </table>
  </div>";
  
  mysqli_close($mysqli);
?>