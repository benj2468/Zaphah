<?php

require_once('mysql_connect.php');
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	
	function execute_sql($sql) {
		global $conn;
		
		if (mysqli_query($conn, $sql)) {
			return TRUE;
		} else {
			echo "** ERROR **: ". mysqli_error($conn);
			echo "<br>";
			return FALSE;
		}
	}

	$old_values = array();
	$need_this_value = 0;
	foreach ($_SESSION as $key => $value) {
		if ($key == 'hash' || $key == 'student_id' || $key == 'family_id' || $key == 'email' || $key == 'password' || $key == 'active' || $key == 'logged_in' || $key == 'user_type') {
			$need_this_value = 0; //don't want these values
		} else {
			$need_this_value = 1;
		}
		if ($need_this_value == 1 ) {
			$old_values[$key] = $value;
		}
	}
	$column_keys = implode(',', array_keys($old_values));

	$new_values = $_POST;
	$new_values['picture'] = $_SESSION['hash'] . "_" . $_FILES['picture']['name'];

	$query = "SELECT " . $column_keys . " FROM " . $_SESSION['user_type'] . ";";

	if ($results = mysqli_query($conn,$query)) {
		$i = 0;
		foreach ($old_values as $key => $value) {
			if ((mysqli_fetch_field_direct($results,$i)->type) == 253) { // STRING
				if (isset($new_values[$key])) {
					$new_values[$key] = str_replace('"', '', $new_values[$key]);
				} else {
					$new_values[$key] = '';
				}
				
			}
			if ((mysqli_fetch_field_direct($results,$i)->type) == 3) { // INT 
				if ($new_values[$key] == '') {
					$new_values[$key] = 0;
				}
			}
			if ((mysqli_fetch_field_direct($results,$i)->type) == 1) { // BOOLEAN
				if (isset($new_values[$key])) {
					if ($new_values[$key] == 'on') {
						$new_values[$key] = 1;
					}
				} else {
					$new_values[$key] = 0;
				}
				
			}
			if ($key == "state") {
				if (isset($new_values[$key])) {
					if ($new_values[$key] == 'State') {
						$new_values[$key] = "";
					}
				} else {
					$new_values[$key] = "";
				}
			}
			if ($key == "language") {
				if (isset($new_values[$key])) {
					if ($new_values[$key] == 'Langauge') {
						$new_values[$key] = "";
					}
				} else {
					$new_values[$key] = "";
				}
			}
			$i += 1;
		}
	}

	//print_r($new_values);
	// echo "<br><br><br>";
	// print_r($old_values);
	// echo "<br>";
	// print_r($_SESSION);


	//***************************** FAMILY STRUCTURE *****************************//

	if ($_SESSION['user_type'] == 'family') {
		$family_structure_array = array('married_parents','only_father','only_mother','with_daughter','with_son','older_sibling','younger_sibling');
	
		$family_structure_string_comp = "('";
		foreach ($family_structure_array as $key) {
			if (isset($new_values[$key])) {
				$family_structure_string_comp .= $key .",";
				unset($new_values[$key]);
			}
		}
		$family_structure_string_comp = substr($family_structure_string_comp, 0, -1);
		$family_structure_string_comp .= "')";
		if ($family_structure_string_comp == "(')") {
			$family_structure_string_comp = "('" . implode(',', $family_structure_array) . "')";
		}
		$new_values['family_structure'] = $family_structure_string_comp;
	}

	//***************************** SQL *****************************//

	// For uploading the file
	$target_dir = '/Users/benjamincape/Google Drive/htdocs/Summer Project/img/users_imgs/';
	$target_file = $target_dir . $_SESSION['hash'] . "_" . basename($_FILES['picture']['name']);
	$uploadOk = 1;
	$imgFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif") {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	if ($_FILES["picture"]["size"] > 500000) {
		echo "\n Sorry, your file is too large. Must be less than 500kb";
        $uploadOk = 0;
    }



	$string_for_user_id = $_SESSION['user_type'] . "_id";
	$all_same = 1;
	$i = 0;
	$no_error = 0;
	foreach ($new_values as $key => $value) {
		if (isset($value)) {
			if ($key == 'picture' && $uploadOk == 1) {
				unlink($target_dir . $old_values[$key]);
				if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
					header('location:user_logged_in_home.php?update=error');
				}
			}
			if ($value != $old_values[$key]) {
				$all_same = 0;
				if ((mysqli_fetch_field_direct($results,$i)->type) == 253) {
					$sql = "UPDATE " . $_SESSION['user_type'] . " SET " . $key . "=\"" . $value . "\" WHERE " . $string_for_user_id . "=" . $_SESSION[$string_for_user_id] . ";";
				} else {
					$sql = "UPDATE " . $_SESSION['user_type'] . " SET " . $key . "=" . $value . " WHERE " . $string_for_user_id . "=" . $_SESSION[$string_for_user_id] . ";";
					
				}
				if ($key == 'picture' && $uploadOk == 1) {
					$_SESSION[$key] = $value;
					header('location:user_logged_in_home.php?update=successful');
				}
				if(execute_sql($sql) && $key != 'picture') {
					$_SESSION[$key] = $value;
					header('location:user_logged_in_home.php?update=successful');
				}
			}
		}
		$i += 1;
	}
	if ($all_same) {
		header('location:user_logged_in_home.php');
	}

}