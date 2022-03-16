<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sign up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="../index.php">
  <link rel="stylesheet" href="css/box_style.css">
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
	$_SESSION["page_name"] = "sign_up.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
  <div class="row">
	<div class="col-4 d-flex justify-content-center text-center">
		<!--Beginning of login box-->
		<div class="box">
			<h1>Sign Up</h1>
			<br>
			<form action="php/sign_up.php" method="POST">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
					<input id="id" type="number" class="form-control" name="id" placeholder="Student ID">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
					<input id="fname" type="text" class="form-control" name="fname" placeholder="First Name">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
					<input id="lname" type="text" class="form-control" name="lname" placeholder="Last Name">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
					<input id="phone" type="text" class="form-control" name="phone" placeholder="Phone Number">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="username" type="text" class="form-control" name="username" placeholder="Username">
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<br>
				
				<!--feedback to the user-->
				<p class="text-danger">
				<?php if(isset($_SESSION["feedback"])) echo $_SESSION["feedback"];?>
				</p>
				
				<p>
					<input class="btn btn-primary" type="submit" id="submit_button" value="Create Account">
				</p>
			</form>
			<span><a href="pages/login.php">Have an Account?</a></span>
		</div>
		<!--End of login box-->
	</div>
  </div>
</div>

</body>
<?php
$_SESSION["feedback"] = "";
?>
</html>