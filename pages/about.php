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
	$_SESSION["page_name"] = "about.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
  <div class="row text-center">
	<div class="col-4 d-flex justify-content-center text-center">
		<!--Beginning of login box-->
		<h1 class="display-4"> 324 Projcet</h1>
		<p class="lead"> This work is done by: </p>
		<br>
		<p class="lead"> Nazeer Alfilfil </p>
		<br>
		<p class="lead"> Hassan Albanay </p>
		<br>
		<p class="lead"> Abdullah Alqahtani </p>
		<br>
		<!--End of login box-->
	</div>
  </div>
</div>

</body>
<?php
$_SESSION["feedback"] = "";
?>
</html>