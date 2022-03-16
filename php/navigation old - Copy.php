<?php
//check if page name is passed
if(isset($_SESSION['page_name'])) {
	//All page names & Texts
	$index = 'index.php';
	$index_text = 'Home';
	
	$page1 = '#';
	$page1_text = 'Page 1';
	
	$page1_1 = 'page1-p1.php';
	$page1_1_text = 'Page 1-1';
	
	$page1_2 = 'page1-p2.php';
	$page1_2_text = 'Page 1-2';
	
	$page1_3 = 'page1-p3.php';
	$page1_3_text = 'Page 1-3';
	
	$page2 = 'page2.php';
	$page2_text = 'Page 2';
	
	$page3 = 'page3.php';
	$page3_text = 'Page 3';
	
	$sign_up = 'sign_up.php';
	$sign_up_text = 'Sign Up';
	
	$login = 'login.php';
	$login_text = 'Login';
	
	$logout = '#';
	$logout_text = 'Logout';
	
	
	//save page name in a variable
	$page_name = $_SESSION['page_name'];
	
	//temporary active holder
	$active_text = '';
	
	//Print universal code (does not change through out all pages)
	echo "<!--Black Navigation bar-->
	<nav class=\"navbar navbar-inverse\">
	  <div class=\"container-fluid\">
		<!--Navigation Header-->
		<div class=\"navbar-header\">
		  <!--Burger Menu-->
		  <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
			<span class=\"icon-bar\"></span>
			<span class=\"icon-bar\"></span>
			<span class=\"icon-bar\"></span>
		  </button>
		  <a class=\"navbar-brand\" href=\"#\">KFUPM CLUBS</a>
		</div>
		
		<!--Menu Items Connected to Burger Menu via ID-->
		<div class=\"collapse navbar-collapse\" id=\"myNavbar\">
		  <!--Navigation links-->
		  <ul class=\"nav navbar-nav\">";
	
	//check if page name is index or not, to make it active
	//Home page
	echo "<li";
	if($page_name == $index) {
		active();
	}
	echo "><a href=\"index.php\">Home</a></li>";
	
	//Universal
	echo "<!--Nested Items with drop down functionality-->";
	
	//page1
	echo "<li class=\"dropdown";
	if($page_name == $page1_1 || $page_name == $page1_2 || $page_name == $page1_3) {
		echo " active";
	}
	echo "\">";
	
	//Universal
	echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">Page 1 <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">";
	
	//page1_1
	echo "<li";
	if($page_name == $page1_1) {
		active();
	}
	echo "><a href=\"pages/page1-p1.php\">Page 1-1</a></li>";
	
	//page1_2
	echo "<li";
	if($page_name == $page1_2) {
		active();
	}
	echo "><a href=\"pages/page1-p2.php\">Page 1-2</a></li>";
	
	//page1_3
	echo "<li";
	if($page_name == $page1_3) {
		active();
	}
	echo "><a href=\"pages/page1-p3.php\">Page 1-3</a></li>";
	
	//Universal
	echo "</ul>
        </li>";
		
	//Page2
	echo "<li";
	if($page_name == $page2) {
		active();
	}
	echo "><a href=\"pages/page2.php\">Page 2</a></li>";
	
	//Page3
	echo "<li";
	if($page_name == $page3) {
		active();
	}
	echo "><a href=\"pages/page3.php\">Page 3</a></li>";
	
	//Universal
	echo "</ul>
		  
		  <!--Utilties at the right side of Navigation Bar-->
		  <ul class=\"nav navbar-nav navbar-right\">
			<!--Search Bar-->
			<form class=\"navbar-form navbar-left\" action=\"/action_page.php\">
			  <div class=\"input-group\">
				<input type=\"text\" class=\"form-control\" placeholder=\"Search\">
				<div class=\"input-group-btn\">
				  <button class=\"btn btn-default\" type=\"submit\">
					<i class=\"glyphicon glyphicon-search\"></i>
				  </button>
				</div>
			  </div>
			</form>
			
			<!--Sign up & Login-->";
			
	//sign up
	echo "<li";
	if($page_name == $sign_up) {
		active();
	}
	echo "><a href=\"pages/sign_up.php\"><span class=\"glyphicon glyphicon-user\"></span> Sign Up</a></li>";
	
	//login
	echo "<li";
	if($page_name == $login) {
		active();
	}
	echo "><a href=\"pages/login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
	
	//Universal
	echo "</ul>
		</div>
	  </div>
	</nav>";
	
} else {
	echo "Failed to load Naviagion bar";
}

/*function makeNavLink($link, $text) {
	$active_text = checkActive();
	echo "<li" .$active_text ."><a href=\"" .$link ."\">" .$text ."</a></li>";
}

function checkActive($link) {
	//save page name in a variable
	$page_name = $_SESSION['page_name'];
	
	if($page_name == $link)
			return active();
}*/

function active() {
	echo " class=\"active\"";
}

/*function active() {
	return " class=\"active\"";
}*/
?>