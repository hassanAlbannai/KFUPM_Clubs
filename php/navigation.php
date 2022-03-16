<?php
//check if page name is passed
if(isset($_SESSION['page_name'])) {
	//first common code
	printUniversal(0);
	
	//Home page
	$index = 'index.php';
	$index_text = 'Home';
	noDropdown($index, $index_text, "");
	
	//Browse
	$browse = 'browse.php';
	$browse_text = 'Browse Clubs';
	noDropdown($browse, $browse_text, 'pages/');
	
	//admin privilege
	$privilege = checkPrivilege();
	if($privilege == 1) {
		printAdmin();
	} else if($privilege == 2) {
		printClubAdmin();
	} else if($privilege == 3) {
		printMember();
	}
	
	//About
	$about = "about.php";
	$about_text = "About";
	noDropdown($about, $about_text, "pages/");
	
	//right side of nav bar code & search bar
	printUniversal(1);
	
	/*If a user is logged in, load logout, else load login & sign up*/
	if(checkUser()) {
		//logout
		$logout = 'logout.php';//go to home page
		$logout_text = 'Logout';
		withGlyph($logout, $logout_text, "php/", "glyphicon glyphicon-log-out");
	} else {
		//sign up
		$sign_up = 'sign_up.php';
		$sign_up_text = 'Sign Up';
		withGlyph($sign_up, $sign_up_text, "pages/", "glyphicon-user");
		
		//login
		$login = 'login.php';
		$login_text = 'Login';
		withGlyph($login, $login_text, "pages/", "glyphicon-log-in");
	}

	//close tags
	printUniversal(2);
	
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
	
	echo "<!--Beginning of " .$text ."-->";
	echo "<li" .$active_text ."><a href=\"" .$extension .$link ."\">" .$text ."</a></li>";
	echo "<!--End of " .$text ."-->";
}

/*Make a Menu Item with a dropdown option
*$pages_array contains the links to all children pages in the form of ( array($child1, $child2, $child3, ...) )
*$pages_text_array contains the displayed text of all children pages in the form of ( array($child1_text, $child2_text, $child3_text, ...) )
*$text is the desired displayed text
*/
function withDropdown($pages_array, $pages_text_array, $text) {
	$active_text = "";
	
	//if one children is selected, set active
	foreach($pages_array as $link) {
		if(checkActive($link) != "") {
			$active_text = activeDropdown();
			break 1;//break one loop statment
		}
	}
	
	echo "<!--Beginning of " .$text ."-->";
	echo "<li class=\"dropdown" .$active_text ."\">";
	echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">" .$text ." <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">";
	
	//make menu items for each children
	//combine the two arrays and use them
	foreach(array_combine($pages_array, $pages_text_array) as $links => $texts) {
		noDropdown($links, $texts, "pages/");
	}
	
	echo "</ul></li>";
	echo "<!--End of " .$text ."-->";
}

/*Make a Menu Item with a glyph attached to it
*$link is the link to that page
*$text is the desired displayed text
*$extension is the where the link is relative to the index (usually 'pages/')
*$glyph is the desired icon. Icons can be found in the following link="https://www.w3schools.com/bootstrap/bootstrap_ref_comp_glyphs.asp"
*/
function withGlyph($link, $text, $extension, $glyph) {
	$active_text = checkActive($link);
	
	echo "<!--Beginning of " .$text ."-->";
	echo "<li" .$active_text ."><a href=\"" .$extension .$link ."\"><span class=\"glyphicon " .$glyph ."\"></span> " .$text ."</a></li>";
	echo "<!--End of " .$text ."-->";
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

/*Check if the user is logged in*/
function checkUser() {
	if( isset( $_SESSION['logged_in']) ) {
	//save the status if the user is logged or not (it should be a boolean value)
	$logged = $_SESSION['logged_in'];
	
	if($logged == true)
		return true;
	else
		return false;
	} else {
		return false;
	}
	
}

/*Check the user's privileges and returns it*/
function checkPrivilege() {
	if( isset( $_SESSION['logged_in'] ) && isset( $_SESSION['username'] ) ) {
		require_once "config.php";
		
		$username = $_SESSION['username'];
		$sql_query = "SELECT UserTypeID FROM User WHERE UserName = '$username'";
		
		$result = mysqli_query($mysqli, $sql_query)
			or die("Failed to query database" .$mysqli -> connect_error);
			
		$row = mysqli_fetch_assoc($result);
		$privilege = $row['UserTypeID'];
		
		if( intval($privilege) == 1 || intval($privilege) == 2 || intval($privilege) == 3) {
			return $privilege;
		} else {
			$_SESSION['logged_in'] = false;
			unset($_SESSION['username']);
			echo "Error, uncorrect privilege number";
			header("refresh:5; url=../php/logout.php");
		}
		
		//mysqli_close($mysqli);
	} else {
		//Guest
		return 4;
	}
}

function printUniversal($num) {
	if($num == 0) {
		//The website name displayed in a big font
		$website_name = "KFUPM CLUBS";
		
		echo "<nav class=\"navbar navbar-inverse\">
		  <div class=\"container-fluid\">";
			
		echo "<!--Beginning of Burger Menu-->
			<div class=\"navbar-header\">
			  <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">
				<span class=\"icon-bar\"></span>
				<span class=\"icon-bar\"></span>
				<span class=\"icon-bar\"></span>
			  </button>
			  <a class=\"navbar-brand\" href=\"#\">" .$website_name ."</a>
			</div>
			<!--End of Burger Menu-->";
			
		echo "<div class=\"collapse navbar-collapse\" id=\"myNavbar\">
			  <!--Navigation links-->
			  <ul class=\"nav navbar-nav\">";
	} else if($num == 1) {
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
			</form>";
	} else if($num == 2) {
		echo "</ul>
		</div>
	  </div>
	</nav>";
	}
}

/*Print admin menu items*/
function printAdmin() {
	//Admin
	$admin = "#";
	$admin_text = "Admin";

	//Add new club
	$add_new_club = "add_new_club.php";
	$add_new_club_text = "Add New Club";
	
	//Remove club
	$remove_club = "remove_club.php";
	$remove_club_text = "Remove Club";
	
	//Add new Member
	$add_new_member = "add_new_member.php";
	$add_new_member_text = "Add New Member";
	
	//Remove club Member
	$remove_member = "remove_member.php";
	$remove_member_text = "Remove Club Member";
	
	//Change club admin (president or secretary)
	$change_club_admin = "change_club_admin.php";
	$change_club_admin_text = "Change Club Admin";
	
	$admin_links = array($add_new_club, $remove_club, $add_new_member, $remove_member, $change_club_admin);
	$admin_texts = array($add_new_club_text, $remove_club_text, $add_new_member_text, $remove_member_text, $change_club_admin_text);
	
	//make dropdown menu
	withDropdown($admin_links, $admin_texts, $admin_text);
}

function printClubAdmin() {
	//Club Admin
	$club_admin = "#";
	$club_admin_text = "Club Admin";

	//Add new project
	$add_new_project = "add_new_project.php";
	$add_new_project_text = "Add New Project";
	
	//change project status
	$change_project_status = "change_project_status.php";
	$change_project_status_text = "Change Project Status";
	
	//change project leader
	$change_project_leader = 'change_project_leader.php';
	$change_project_leader_text = 'Change Project Leader';
	
	//Add new Member to Project
	$add_member_to_project = "add_member_to_project.php";
	$add_member_to_project_text = "Add Member to Project";
	
	
	//change project leader
	$change_project_leader = 'change_project_leader.php';
	$change_project_leader_text = 'Change Project Leader';
	
	//Approve Member
	$approve_member = 'approve_member.php';
	$approve_member_text = 'Approve Member to Join';
	
	$club_admin_links = array($add_new_project, $change_project_status, $change_project_leader, $add_member_to_project, $approve_member);
	$club_admin_texts = array($add_new_project_text, $change_project_status_text, $change_project_leader_text, $add_member_to_project_text, $approve_member_text);
	
	//make dropdown menu
	withDropdown($club_admin_links, $club_admin_texts, $club_admin_text);
}

function printMember() {
	//Club Member
	$club_member = "#";
	$club_member_text = "Club Member";
	
	//Browse projects information
	$browse_project = 'browse_project.php';
	$browse_project_text = 'Browse Projects';
	
	$club_member_links = array($browse_project);
	$club_member_texts = array($browse_project_text);
	
	//make dropdown menu
	withDropdown($club_member_links, $club_member_texts, $club_member_text);
}
?>