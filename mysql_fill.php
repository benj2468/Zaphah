<?php

require_once("mysql_connect.php");

class UserDataStorage {
	function UserDataStorage($post) {
		$this->user_entry_map_ = $post;
		$this->is_valid_ = TRUE;
		$this -> validateUserEntries();
		$this -> handleResponse();
	}

	function cosmetics($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

	function validateUserEntry($key, $value) {
		if (empty($value)) {
			$this->error_message_ = $key . " is required";
			$this->is_valid_ = FALSE;
		} else {
			$this->validated_user_entry_map_[$key] = $this->cosmetics($value);
		}
	}

	//pull names by cicling through $user_entry_map which will be passed in though the construcutre with $_POST
	function validateUserEntries() {
		foreach ($this->user_entry_map_ as $key => $value) {
			$this->validateUserEntry($key,$value);
		}
	}
	
	//another method called: saveToMySQL(), this will save all the variables
	function saveToMySQL() {
		global $conn;
		$hash  = md5(rand(0,1000));
		$this->validated_user_entry_map_['hash'] = $hash;
		$my_sql = "INSERT INTO " . $this->user_entry_map_['user_type'] . " (";
		foreach ($this->validated_user_entry_map_ as $key => $value) {
			if ($key != 'user_type' && $key != 'post_type') {
				$my_sql .= $key . ",";
			}
		}
		$my_sql = substr($my_sql, 0, -1);
		$my_sql .= ") VALUES (";
		foreach ($this->validated_user_entry_map_ as $key => $value) {
			if ($key != 'user_type' && $key != 'post_type') {
				if ($key == 'password') {
					$value = md5($value);
				}
				$my_sql .= "'" . $value . "',";
			}
		}
		$my_sql = substr($my_sql, 0, -1);
		$my_sql .= ");";

		if (mysqli_query($conn,$my_sql)) {
			$this->send_email_verification($hash);
			//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=confirm_email.php">';
		} else {
			echo "ERROR: " . mysqli_error($conn);
		}
	}
	

	function saveToFile() {
		$signup_textfile_contents = "";
		foreach ($this->validated_user_entry_map_ as $key => $value) {
			$signup_textfile_contents .= $key . ":     " . $value . "\n";
		}
		$signup_textfile_contents .= "\n\n\n";

		$signup_textfile = fopen("signups.txt", "a");
		if (fwrite($signup_textfile, $signup_textfile_contents)) {
			fclose($signup_textfile);
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=confirm_email.php">';
		}
		
		
	}

	function handleResponse() {
		if ($this->is_valid_) {
			$this->saveToMySQL();
		} else {
			echo "error!";
		}
	}

	function send_email_verification($hash) {
		// $to = $this->validated_user_entry_map_['email'];
		// $subject = "Home Town Immersion Sign Up Verification";
		$message  = "BLAH BLAH BLAH THIS IS A TEST Thanks for signing up!
Please click the following link to verify your email, and activate your account!

localhost/Summer%20Project/verify_email.php?email=" . $this->validated_user_entry_map_['email'] . "&user=" . $this->validated_user_entry_map_['user_type'] . "&hash=" . $hash;

		$headers = 'From:help@htownimmersion.com' . '\r\n';

		// $email_substitute_file = fopen("email_substitute.txt", "a");
		if (mail($this->validated_user_entry_map_['email'],'Confirmation',$message)) {
			header("location:confirm_email.php");
		} else {
			echo "error";
		}
	}

	public $is_valid_;
	public $error_message_;
	public $user_entry_map_ = [];
	public $validated_user_entry_map_ = [];
}

class UserDataRetrieval extends UserDataStorage{

	function UserDataRetrieval($post) {
		$this->user_entry_map_ = $post;
		$this->is_valid_ = TRUE;
		parent::validateUserEntries();
		$this->handleResponse();
	}

	//pull names by cicling through $user_entry_map which will be passed in though the construcutre with $_POST
	function validateUserEntries() {
		foreach ($this->user_entry_map_ as $key => $value) {
			$this->validateUserEntry($key,$value);
		}
		if (!isset($this->validated_user_entry_map_['user_type'])) {
			$this->validateUserEntry('user_type','');
		}
	}

	function handleResponse() {
		if ($this->is_valid_) {
			$this->check_mysql();
		} else {
			header("location:sign_in.php?error=invalid_login");
		}
	}

	function check_mysql() {
		global $conn;
		$email = $this->validated_user_entry_map_['email'];
		$password = md5($this->validated_user_entry_map_['password']);

		$search = mysqli_query($conn,"SELECT email,password,active FROM " . $this->validated_user_entry_map_['user_type'] . " WHERE email = '" . $email . "' AND password = '" . $password . "' AND active=1;");

		if (mysqli_num_rows($search) > 0) {
			session_start();
			$results = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM " . $this->validated_user_entry_map_['user_type'] . " WHERE email = '" . $email . "' AND password = '" . $password . "' AND active=1;"));
			$_SESSION = $results;
			$_SESSION['logged_in'] = true;
			$_SESSION['user_type'] = $this->validated_user_entry_map_['user_type'];
			header("location:user_logged_in_home.php");
		} else {
			header("location:sign_in.php?error=invalid_login");
		}
	}
}

switch ($_POST['post_type']) {
 	case 'sign_up':
 		new UserDataStorage($_POST);
 		break;
 	case 'sign_in':
 		new UserDataRetrieval($_POST);
 		break;
}




// echo $_POST;

// echo "<br><br>";

// foreach ($_POST as $key => $value) {
// 	echo $key . ":		" . $value . "<br>";
// }

// $user_type = $_POST['user_type'];
// $first_name = $_POST['first_name'];
// $last_name = $_POST['last_name'];
// $email = $_POST['email'];
// $password = $_POST['password'];

// $first_name_err = $last_name_err = $email_err = $password_err = $user_type_err = "";

// if (empty($user_type)) {
// 	$user_type_err = "You must state whether you are a student or a family";
// } else if ($user_type != ('family' OR 'student')) {
// 	$user_type_err = "You must choose between being a student, or a family";
// } else {
// 	$user_type = test_input($user_type);
// }

// if (empty($first_name)) {
// 	$first_name_err = "First Name is required";
// } else {
// 	$first_name = test_input($first_name);
// }

// if (empty($last_name)) {
// 	$last_name_err = "Last Name is required";
// } else {
// 	$last_name = test_input($last_name);
// }

// if (empty($email)) {
// 	$email_err = "Email is required";
// } else {
// 	$email = test_input($email);
// }

// if (empty($password)) {
// 	$password_err = "Password is required";
// } else {
// 	$password = test_input($password);
// }


// Benjamin Diament was curious 
// $signup_text_file_contents = "first_name: ". $first_name ."\n";
// $signup_text_file_contents .= "last_name: ". $last_name ."\n";

// $signup_text_file = fopen("signups.txt", "w");
// fwrite($signup_text_file, $signup_text_file_contents);
// fclose($signup_text_file);


// $sql = "INSERT INTO ".$user_type." (first_name,last_name,email,password) VALUES ('$first_name','$last_name','$email','$password')";

// if (mysqli_query($conn,$sql)) {
// 	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=confirm_email.php">';
// } else {
// 	echo "** ERROR **: ". mysqli_error($conn);
// }


?>
