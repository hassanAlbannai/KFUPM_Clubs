<?php
//check if page name is passed
if(isset($_SESSION['page_name'])) {
	//All page names & Displayed Texts
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
	
	
	//Home page
	noDropdown($index, $index_text, "");
	
	//Universal
	echo "<!--Nested Items with drop down functionality-->";
	
	//page1
	//put children in array
	withDropdown(array($page1_1, $page1_2, $page1_3), $page1_text);
	
	//page1_1
	noDropdown($page1_1, $page1_1_text, "pages/");
	
	//page1_2
	noDropdown($page1_2, $page1_2_text, "pages/");
	
	//page1_3
	noDropdown($page1_3, $page1_3_text, "pages/");
	
	//Universal
	echo "</ul>
        </li>";
		
	//Page2
	noDropdown($page2, $page2_text, "pages/");
	
	//Page3
	noDropdown($page3, $page3_text, "pages/");
	
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
	withGlyph($sign_up, $sign_up_text, "pages/", "glyphicon-user");
	
	//login
	withGlyph($login, $login_text, "pages/", "glyphicon-log-in");
	
	//Universal
	echo "</ul>
		</div>
	  </div>
	</nav>";
	
} else {
	echo "Failed to load Naviagion bar";
}

/*Make a Menu Item with no dropdown options
*$link is the link to that page
*$text is the desired displayed text
*$extension is the where the link is relative to the index (usually 'pages/')
*/
function noDropdown($link, $text, $extension) {
	$active_text = checkActive($link);
	echo "<li" .$active_text ."><a href=\"" .$extension .$link ."\">" .$text ."</a></li>";
}

/*Make a Menu Item with a dropdown option
*$array contains the links to all children pages in the form of ( array($child1, $child2, $child3, ...) )
*$text is the desired displayed text
*/
function withDropdown($array, $text) {
	$active_text = "";
	
	//if one children is selected, set active
	foreach($array as $link) {
		if(checkActive($link) != "") {
			$active_text = activeDropdown();
			break 1;//break one loop statment
		}
	}
	
	echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">" .$text ." <span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\">";
	echo "<li class=\"dropdown" .$active_text ."\">";
}

/*Make a Menu Item with a glyph attached to it
*$link is the link to that page
*$text is the desired displayed text
*$extension is the where the link is relative to the index (usually 'pages/')
*$glyph is the desired icon. Icons can be found in the following link="https://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp"
*/
function withGlyph($link, $text, $extension, $glyph) {
	$active_text = checkActive($link);
	echo "<li" .$active_text ."><a href=\"" .$extension .$link ."\"><span class=\"glyphicon " .$glyph ."\"></span> " .$text ."</a></li>";
}

/*check if the link is the one active*/
function checkActive($link) {
	//save page name in a variable
	$page_name = $_SESSION['page_name'];
	
	if($page_name == $link)
		return active();
	else
		return "";
}

/*return text with active class for none dropdown components*/
function active() {
	return " class=\"active\"";
}

/*return active text for dropdown components*/
function activeDropdown() {
	return " active";
}

/*function printUniversal($num) {
	if()
}*/
?>