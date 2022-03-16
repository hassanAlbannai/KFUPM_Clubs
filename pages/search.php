<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Browse Clubs</title>
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
	$_SESSION["page_name"] = "browse.php";
	include '../php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h1>Browse Clubs</h1>
	</div>






<form action="php/join_action.php" method="POST">

  <!--Beginning of Table-->
  <?php
	include '../php/clubs_table.php';
  ?>
  
  
  <p style="text-align: center;">
				<input class="btn btn-primary" type="submit"  <?php if(!isset($_SESSION['username'])) {?> style="display: none;" <?php } ?> id="join_button" name="join_button" value="join Selected Clubs">
			</p>
  </form>
  
  
  
  
  
  
  
  <!--End of Table-->
</div>

</body>
</html>