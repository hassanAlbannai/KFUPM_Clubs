<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>

<!--Navigation bar-->
<div id="nav-placeholder">
<?php
	$_SESSION["page_name"] = "index.php";
	include 'php/navigation.php';
?>
</div>
<!--End of Navigation bar-->
  
<div class="container">
  <h3>Welcome to KFUPM clubs</h3>
  
  <?php 
  if(isset($_SESSION['username'])){
	  $user = $_SESSION['username'];
	  echo "welcome back $user ";
	  
	  
  } else{
	  
	  echo "welocme guest. you can only browse clubs as a gust, to be able to join clubs, please register.";
	  
	  
  }
  ?>
  
</div>

<div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h1>your clubs</h1>
	</div>

  <!--Beginning of Table-->
  
  <form action="public_html/leave_action.php" method="POST">
  <?php
  if(isset($_SESSION['username'])){
	 include '../public_html/clubs.php';
  } else{
	  echo "you have to login to show your clubs";
  }
	
  ?>
  
  
  <p style="text-align: center;">
				<input class="btn btn-primary" type="submit"  <?php if(!isset($_SESSION['username'])) {?> style="display: none;" <?php } ?> id="leave_button" name="leave_button" value="Leave Selected Clubs">
			</p>
  </form>
  
  <!--End of Table-->
</div>

</body>
</html>
