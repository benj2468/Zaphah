<?php

require_once('mysql_connect.php');
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

	$post = $_POST;

	$new_values = array();

	$string_for_user_id = $_SESSION['user_type'] . "_id";
	$user_id = $_SESSION[$string_for_user_id];

	$boolean_vars_strings = array('ethnic_food','country_history','culture','family_history','politics','interview','dinner','coffee','babysit','english');

	$boolean_vars_stirng_comp = "";

	foreach ($boolean_vars_strings as $key) {
		if (isset($post[$key])) {
			switch($post[$key]) {
				case 'on':
					$boolean_vars_stirng_comp .= '1,';
					$new_values[$key] = '1';
					break;
				case '':
					$boolean_vars_stirng_comp .= '0,';
					$new_values[$key] = '0';
					break;
				default:
					$boolean_vars_stirng_comp .= '0,';
					$new_values[$key] = '0';
					break;
			}
		} else {
			$new_values[$key] = '0';
		}
		
	}

	if (isset($post['speak_percent'])) {
		$new_values['speak_percent'] = $post['speak_percent'];
	}
	if (isset($post['distance_travel'])) {
		$new_values['distance_travel'] = $post['distance_travel'];
	}
	if (isset($post['age'])) {
		$new_values['age'] = $post['age'];
	}
	if (isset($post['years_studied'])) {
		$new_values['years_studied'] = $post['years_studied'];
	}


	//***************************** TIMES *****************************//

	$times_array = array('sunday_morn','sunday_after','sunday_even','monday_after','monday_even','tuesday_after','tuesday_even','wednesday_after','wednesday_even','thursday_after','thursday_even','friday_after','friday_even','saturday_morn','saturday_after','saturday_even','monday_morn','tuesday_morn','wednesday_morn','thursday_morn','friday_morn');

	$time_string_comp = "('";
	foreach ($times_array as $key) {
		if ($post[$key] == 1) {
			$time_string_comp .= $key .",";
		}
	}

	$time_string_comp = substr($time_string_comp, 0, -1);
	$time_string_comp .= "')";
	if ($time_string_comp == "(')") {
		$time_string_comp = "('" . implode(',', $times_array) . "')";
	}
	$new_values['times'] = $time_string_comp;


	//***************************** FAMILY STRUCTURE *****************************//

	if ($_SESSION['user_type'] == 'student') {
		$family_structure_array = array('married_parents','only_father','only_mother','with_daughter','with_son','older_sibling','younger_sibling');

		$family_structure_string_comp = "('";
		foreach ($family_structure_array as $key) {
			if (isset($post[$key])) {
				$family_structure_string_comp .= $key .",";
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

	$preferences_string = "preferences_" . $_SESSION['user_type'];
	$results = mysqli_query($conn, "SELECT * FROM " . $preferences_string . " WHERE " . $string_for_user_id . "=" . $user_id . ";");
	$allsame = 1;
	if (mysqli_num_rows($results) > 0) {
		$old_values = mysqli_fetch_assoc($results);
		foreach ($old_values as $key => $value) {
			if ($key != $string_for_user_id) {
				if (isset($new_values[$key])) {
					if ($value != $new_values[$key]) {
						$allsame = 1;
						$sql = "UPDATE " . $preferences_string . " SET " . $key . "=" . $new_values[$key] . " WHERE " . $string_for_user_id . "=" . $user_id .";";
						if(execute_sql($sql)) {
							header('location:user_logged_in_home.php?update=successful');
						}
					}	
				}
				
			}
		}
		if ($allsame == 1) {
			header('location:user_logged_in_home.php');
		}
	} else {
		if ($_SESSION['user_type'] == 'student') {
			$sql = "INSERT INTO preferences_student (student_id,";
			foreach ($new_values as $key => $value) {
				$sql .= $key . ",";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ") VALUES (" . $user_id . ",";
			foreach ($new_values as $value) {
				$sql .= $value . ",";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ");";
		} else {
			$sql = "INSERT INTO preferences_family (family_id,";
			foreach ($new_values as $key => $value) {
				$sql .= $key . ",";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ") VALUES (" . $user_id . ",";
			foreach ($new_values as $value) {
				$sql .= $value . ",";
			}
			$sql = substr($sql, 0, -1);
			$sql .= ");";
		}
		if(execute_sql($sql)) {
			header('location:user_logged_in_home.php?update=successfulu');
		}
	}
}




?>