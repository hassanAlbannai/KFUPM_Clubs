<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New Club</title>
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
				<input id="club_name" type="text" class="form-control" name="club_name" placeholder="Club Name">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
				<select id="department" class="form-control" name="department">
					<option style="color: gray;" value="" selected>No Department</option>
					<?php
						include '../php/retrieve_department.php';
					?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
				<input id="address" type="text" class="form-control" name="address" placeholder="Club address">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
				<input id="phone" type="number" class="form-control" name="phone" placeholder="Phone Number">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-comment"></i></span>
				<input id="description" type="text" class="form-control" name="description" placeholder="Club Desctiption">
			</div>
		</div>
		<div class="col-sm-6">
			<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
				<select id="status" class="form-control" name="status">
					<option style="color: gray;" value="" disabled selected hidden>Club Status</option>
					<?php
						include '../php/retrieve_status.php';
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