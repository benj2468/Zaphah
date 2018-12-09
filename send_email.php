<?php

	session_start();
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

		$post = $_POST;

		require_once "mysql_fill.php";

		class ContactUser extends UserDataStorage {

			function ContactUser($post) {
				$this->user_entry_map_ = $post;
				$this->is_valid_ = TRUE;
				parent::validateUserEntries();
				$this -> handleResponse();
			}

			function handleResponse() {
				$to = $this->validated_user_entry_map_['email'];
				$subject = $this->validated_user_entry_map_['subject'];
				$message = $this->validated_user_entry_map_['message'];

				$headers = "From:" . $_SESSION['email'] "" . "\r\n";

				if (!mail($to, $subject, $message,$headers)) {
					header('location:user_logged_in_home.php?sendmail=0');
				}
				header('location:user_logged_in_home.php?sendmail=1');
			}
		}

		new ContactUser($post);

	}
?>