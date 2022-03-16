function display_students(club_id) {
	if(club_id == "") {
		document.getElementById("student_container").innerHTML="";
		return;
	}
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			document.getElementById("student_container").innerHTML = this.responseText;
		}
	}
	
	xmlhttp.open("GET", "php/display_students.php?q=" + club_id, true);
	xmlhttp.send();
}