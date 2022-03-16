<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Member</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="../index.php">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

<!--Navigation bar-->
<div id="nav-placeholder">
<?php
	//Change to current page name
	$_SESSION["page_name"] = "add_new_member.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h1>Add New Member</h1>
	</div>

<form action="php/add_new_member.php" method="POST">
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
				<select id="student_id" class="form-control" name="student_id">
				<option style="color: gray;" value="" selected disabled>select student</option>
				<?php
						$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
						$port = 3306;
						$db_username = 'admin';
						$db_password = 'KFUPM123';
						$db_name = 'kstds';

						//connect to database
						$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
						
						$sql_query = "SELECT ID, Fname, Lname FROM Student;";
	
						$result = mysqli_query($mysqli, $sql_query)
							or die("Failed to query database" .$mysqli -> connect_error);
						if( mysqli_num_rows($result) > 0 ) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option class=\"other\" value=\"" .$row['ID'] ."\">";
								echo $row['Fname'];
								echo ' ';
								echo $row['Lname'];
								echo "</option>";
							}
						} else {
							die("Failed to retrieve any Clubs");
						}
					?>
				
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<select id="club_id" class="form-control" name="club_id">
					<option style="color: gray;" value="" selected disabled>Select Club</option>
					<?php
						$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
						$port = 3306;
						$db_username = 'admin';
						$db_password = 'KFUPM123';
						$db_name = 'kstds';

						//connect to database
						$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
						
						$sql_query = "SELECT ID, Name FROM Club";
	
						$result = mysqli_query($mysqli, $sql_query)
							or die("Failed to query database" .$mysqli -> connect_error);
						
						if( mysqli_num_rows($result) > 0 ) {
							while($row = mysqli_fetch_assoc($result)) {
								echo "<option class=\"other\" value=\"" .$row['ID'] ."\">";
								echo $row['Name'];
								echo "</option>";
							}
						} else {
							die("Failed to retrieve any Clubs");
						}
					?>
				</select>
			</div>
		</div>
	</div>
			
			<p class="text-danger">
			<?php
			if(isset($_SESSION["feedback"])) {
				echo $_SESSION["feedback"];
			}
			?>
			</p>
			
			<p style="text-align: center;">
				<input class="btn btn-primary" type="submit" id="submit_button" value="Add New Member">
			</p>
		</form>
	</div>
  </div>
</div>

</body>
</html>