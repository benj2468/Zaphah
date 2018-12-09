<?php
$options = array(
	'page_name' => 'confirm_email',
	'index_page' => 0
);
require_once('mysql_connect.php');

if (isset($_GET['email']) && isset($_GET['user']) && isset($_GET['hash'])) {
	$email = $_GET['email'];
	$user_type = $_GET['user'];
	$hash = $_GET['hash'];

	$search = mysqli_query($conn,"SELECT email,hash,active FROM " . $user_type . " WHERE email = '" . $email . "' AND hash = '" . $hash . "' AND active = 0;");
	if(mysqli_num_rows($search) > 0 ) {
		mysqli_query($conn, "UPDATE " . $user_type . " SET active = 1 WHERE email = '" . $email . "' AND hash = '" . $hash . "' AND active = 0;");
		$message = '
		<div class="col s5 offset-s3 center-align">
			Your account has been activiated. You can now login. Click below to be taken to the Login page!
		</div>
		<div class="col s4">
			<a class="waves-effect waves-light btn right-align" href="sign_in.php">Sign In</a>
		</div>';

	} else {
		$message =  '
		<div class="col s6 offset-s3 center-align">
			Either your url is invalid, or your account has already been activated. 
		</div>';
		$options['index_page'] = 1;
	}
} else {
	$message = '
	<div class="col s6 offset-s3 center-align">
		Please enter a valid URL
	</div>';
	$options['index_page'] = 1;
}



require_once('includes/header.php');
?>

<div class="container">
	<div class="row">
		<?php echo $message ?>
	</div>
</div>


<?php
require_once('includes/footer.php');
?>
