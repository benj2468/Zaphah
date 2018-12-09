<?php
$options = array(
	'page_name' => 'confirm_email',
	'index_page' => 1
);
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

	if (isset($_GET['end_session'])) {
		$_SESSION['logged_in'] = false;
		if (ini_get("session.use_cookies")) {
		    $params = session_get_cookie_params();
		    setcookie(session_name(), '', time() - 42000,
		        $params["path"], $params["domain"],
		        $params["secure"], $params["httponly"]
	    	);
		}
		session_destroy();
	}
}


require_once('includes/header.php');

?>

<div class="container">

	<div class="row" style="margin-top:40px;">

		<div class="col s6">
			<img src="img/Language-World.png" class="circle responsive-img"></img>
		</div>

		<div class="col s6">
			<?php
			include 'sign_up.php';
			?>
		</div>
		
	</div>

	<!-- ********************************************************************************************************************** -->
	<div class="row" style="margin-top:40px;">

		<span>Sign Up for free and get quickly connected to  immersive experiences right where you live. Don't worry about needing to go abroad to find ways to develop your language skills. Get connected to ethnic families right in your home town that can help you learn about you languages culture and history while helping you increase your language level.</span>

	</div>

	<div class="divider"></div>

	<!-- ********************************************************************************************************************** -->
	<div class="row" style="margin-top:40px; margin-bottom:40px;">

		<div class="col s4"><img src="img/airplane.jpg" class="responsive-img"></div>

		<div class="col s8">
			<h3 class="center-align">No Flying</h3>
			<span>Why travel abroad to receive an immersive experience when you can receive one right in your home town? Spending the money to join a program, and fly abroad is no longer necessary. </span>
		</div>

	</div>

</div>

<!-- ********************************************************************************************************************** -->
<div class="parallax-container valign-wrapper">

	<div class="container white-text valign">
		<div class="row">
			<div class="col s12 center-align"><span style="font-size:35;">YOUR HOME AWAY FROM HOME<br><br>RIGHT AT HOME</span></div>
		</div>
	</div>

    <div class="parallax"><img src="img/venice.png"></div>

</div>

<!-- ********************************************************************************************************************** -->
<div class="container">

	<div class="row" style="margin-top:40px; margin-bottom:40px;">

		<div class="col s8">
			<h3 class="center-align">Improve Your Speaking</h3>
			<span>Improve your speaking ability by speaking with ethnic individuals with true accents! Don't settle for your american friends who have an American accent whenever they speak a foreign language, find a real family that can help teach you exactly how to pronounce certain words!</span>
		</div>

		<div class="col s4"><img src="img/mouth.jpg" class="responsive-img"></div>

	</div>

</div>


<!-- ********************************************************************************************************************** -->
<div class="parallax-container valign-wrapper">

	<div class="container white-text valign">
		<div class="row">
			<div class="col s12 center-align"><span style="font-size:35;" class="black-text">MASTER ETHNIC COOKING TECHNIQUES</span></div>
		</div>
	</div>

    <div class="parallax"><img src="img/dimsum-2.jpg"></div>

</div>


<!-- ********************************************************************************************************************** -->
<div class="container">

	<div class="row" style="margin-top:40px; margin-bottom:40px;">

		<div class="col s4"><img src="img/un.png" class="responsive-img"></div>

		<div class="col s8">
			<h3 class="center-align">LEARN ABOUT POLITICS</h3>
			<span>To learn in a classroom how to speak a language is one thing, to learn about that countries political idiology, and political landscape is completely different, and inhances one's understanding of a country to a whole new level. Political discussions with your family can help give you more insight into how politics works in the country of the language you are learning. Learn about how they think about Foreign Relations, and other pressing matters. </span>
		</div>

	</div>

</div>


<!-- ********************************************************************************************************************** -->
<!-- <div class="container">hgs
	<div class="row">
		<div class="col s8">

		</div>

		<div class="col s4">
			<div id="piechart"></div>
		</div>
	</div>
</div> -->

<!-- ********************************************************************************************************************** -->
<div class="blue darken-3 z-depth-2" style="padding:20px; margin-bottom:40px;">
<div class="container white-text">
	<div class="row">
		<div class="col s4" id="step1">
			<h4>Step 1:</h4>
			<p>Sign Up for Free with your name, email and password</p>
		</div>
		<div class="col s4" id="step2">
			<h4>Step 2:</h4>
			<p>Enter in your information and preferences. Such as: How old are you? What language are you learning, or do you speak?</p>
		</div>
		<div class="col s4" id="step3">
			<h4>Step 3:</h4>
			<p>Get matched with a Family to help you learn your language, or a student to teach your language!</p>
		</div>
	</div>
</div>
</div>

<!-- ********************************************************************************************************************** -->
<div class="container">
	<div class="row">
		<div class="col s6 offset-s3">
			<?php
				include 'sign_up.php';
			?>
		</div>
	</div>
</div>

<?php
require_once('includes/footer.php');
?>
