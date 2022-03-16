<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
	$_SESSION["page_name"] = "login.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->

<div class="container">
  <div class="row">
	<div class="col-4 d-flex justify-content-center text-center">
		<!--Beginning of login box-->
		<div class="box">
			<h1>Sign In</h1>
			<br>
			<form action="php/login.php" method="POST">
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input id="username" type="text" class="form-control" name="username" placeholder="Username"> <!--?php if(isset($_SESSION["username"])) echo "value=\"" .$_SESSION["username"] ."\"";?>>-->
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input id="password" type="password" class="form-control" name="password" placeholder="Password">
				</div>
				<br>
				
				<p class="text-danger">
				<?php
				if(isset($_SESSION["feedback"])) {
					echo $_SESSION["feedback"];
				}
				?>
				</p>
				
				<p>
					<input class="btn btn-primary" type="submit" id="submit_button" value="Login">
				</p>
			</form>
			<span><a href="pages/sign_up.php">Create Account</a> | <a href="pages/forget_password.php">Forget Password?</a></span>
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