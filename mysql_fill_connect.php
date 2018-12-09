<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_type = $_POST['user_type'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	$fill_url = "localhost:8889/Summer%20Project/mysql_fill.php?user_type=".$user_type."?first_name=".$first_name."?last_name".$last_name."?email=".$email."?password=".$password."";

}

?>