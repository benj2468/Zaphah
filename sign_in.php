<?php
$options = array(
	'page_name' => 'confirm_email',
	'index_page' => 0
);
require_once('includes/header.php');
?>

<div class="container">
	<div class="row">
		<div class="col s6 offset-s3 center-align">
			<h3> Sign In </h3>
			<div class="row">
				<?php
					if (isset($_GET['error']) && $_GET['error'] == 'invalid_login') {
						echo "<span class='red-text'>Invalid Login, please try again.</span>";
					}

				?>
			</div>
			<form action="mysql_fill.php" method="post">
				<input type="hidden" value="sign_in" name="post_type"/>
				<div class="row">
					<div class="input-field">
						<select name="user_type">
							<option value="" disabled selected>Choose your User Type</option>
							<option value="student">Student</option> <!-- ** THESE VALUES MUST BE THE SAME AS THE NAMES OF THE TABLES ** -->
							<option value="family">Family</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input name="email" type="email" class="validate"/>
						<label for="email">Email</label>
					</div>
					<div class="input-field col s6">
						<input name="password" type="password" class="validate"/>
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row align right">
					<button class="btn waves-effect waves-light responsive" type="submit" >Sign Up
	    				<i class="mdi-content-send right"></i>
	  				</button>
    			</div>
			</form>
		</div>
	</div>

</div>

<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "http://localhost:8888/Summer%20Project/sign_in.php");
  	}
	</script>

<?php
require_once('includes/footer.php');
?>