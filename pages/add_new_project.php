<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="../index.php">
  <link rel="stylesheet" href="css/select_style.css">
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
	$_SESSION["page_name"] = "add_new_club.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h1>Add New Club</h1>
	</div>

<form action="php/add_new_club.php" method="POST">
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
				<input id="project_name" type="text" class="form-control" name="project_name" placeholder="Project Name">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
				<select id="project_type" class="form-control" name="project_type">
					<option style="color: gray;" value="" selected disabled>Choose Project Type</option>
					<?php
						$server = 'kstds.ca8twtlpsix7.me-south-1.rds.amazonaws.com';
						$port = 3306;
						$db_username = 'admin';
						$db_password = 'KFUPM123';
						$db_name = 'kstds';

						//connect to database
						$mysqli = new mysqli($server .":" .$port, $db_username, $db_password, $db_name);
						
						$query = "SELECT ID, Name FROM ProjectType";
						
						$result = mysqli_query($mysqli, $query) or die("Failed to retieve anything" .mysqli_error($mysqli));
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value='" .$row['ID'] ."'>" .$row['Name'] ."</option>";
						}
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<?php include "../php/retrieve_project_club_id.php" ?>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
				<select id="status" class="form-control" name="status">
					<option style="color: gray;" value="" disabled selected hidden>Project Status</option>
					<?php
						include '../php/retrieve_project_status.php';
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
				<input class="btn btn-primary" type="submit" id="submit_button" value="Add New Club">
			</p>
		</form>
	</div>
  </div>
</div>

</body>
</html>