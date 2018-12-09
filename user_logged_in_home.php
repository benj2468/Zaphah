<?php
$options = array(
	'page_name' => 'confirm_email',
	'index_page' => 0
);
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	require_once('includes/header.php');
?>

<div class="blue darken-3 z-depth-2" style="padding:20px; margin-bottom:40px;">
<div class="container white-text">
	<div class="row center-align">
		<div class="col s4" id="step1">
			<h4>Step 1:</h4>
			<p>Set Your Information</p>
			<button class="waves-effect waves-light btn responsive" id="show_information" type="<?= $_SESSION['user_type'];?>"><i class="material-icons left">person</i>Information</button>
		</div>
		<div class="col s4" id="step2">
			<h4>Step 2:</h4>
			<p>Set Your Preferences</p>
			<button class="waves-effect waves-light btn responsive" id="show_preferences"  type="<?= $_SESSION['user_type'];?>"><i class="material-icons left">settings</i>Preferences</button>
		</div>
		<div class="col s4" id="step3">
			<h4>Step 3:</h4>
			<p>Get Matched</p>
			<button class="waves-effect waves-light btn responsive" id="show_matches" type="<?= $_SESSION['user_type'];?>"><i class="material-icons left">assessment</i>My Matches</button>
		</div>
	</div>
</div>
</div>

<div class="container" id="adjustable_container">
	
	<?php
	if (isset($_GET['update'])) {
		echo "<div class='center-align'>";
		switch ($_GET['update']) {
			case 'successful':
				echo "Your Update was succesful!";
				break;
			default:
				echo "Sorry, there was an error. Try selecting the 'Information' tab and trying again.";
				break;
		}
		echo "</div>";
	}
	if (isset($_GET['sendmail'])) {
		echo "<div class='center-align'>";
		switch ($_GET['sendmail']) {
			case '1':
				echo "Your email was sent succesfuly!";
				break;
			default:
				echo "Sorry, there was an error. Try selecting your match, and sending the email again.";
				break;
		}
		echo "</div>";
	}
	if (isset($_GET['email'])) {
		?>
		<div class="row">
			<div class="col s8 offset-s2">
				<form method="post" action="send_email.php">
					<input type="hidden" name="email" value="<?= $_GET['email'] ?>"/>
					<div class="row">
						<div class="input-field col s6">
							<input id="subject" name="subject" type="text" class="validate">
							<label for="subject">Subject</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="message" name="message" class="materialize-textarea"></textarea>
							<label for="message">Message</label>
						</div>
					</div>
					<div class="row">
						<div class="right-align">
							<button class="btn waves-effect waves-light responsive green darken-3" type="submit" style="z-index:0;">Send
							<i class="material-icons right">send</i>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php		
	}	
	?>
</div>


<?php
} else {
	echo "you are not logged in";
}
require_once('includes/footer.php');
?>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost:8888/Summer%20Project/user_logged_in_home.php");
  	}
</script>