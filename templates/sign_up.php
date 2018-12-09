<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="row">
		<div class="col s12">
			<h4 class="center-align">Sign Up for Free</h4>

			<div class="input-field">
				<select id="student_or_family">
					<option value="" disabled selected>Choose your option</option>
					<option value="1">Student</option>
					<option value="2">Family</option>
				</select>

			</div>

		</div>
	</div>
	<div class="row">
		<div class="col s12">

			<div class="row">
				<div class="input-field col s6" style="margin-top:0px;">
					<input name="first_name" type="text" class="validate"/>
					<label for="first_name">First Name</label>
				</div>
				<div class="input-field col s6" style="margin-top:0px;">
					<input name="last_name" type="text" class="validate"/>
					<label for="last_name">Last Name</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12" style="margin-top:0px;">
					<input name="email" type="email" class="validate"/>
					<label for="email">Email</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12" style="margin-top:0px;">
					<input name="password" type="password" class="validate"/>
					<label for="password">Password</label>
				</div>
			</div>
			<div class="row align right">
				<button class="btn waves-effect waves-light responsive" type="submit" name="action">Sign Up
    				<i class="mdi-content-send right"></i>
  				</button>
    		</div>
		</div>
	</div>
</form>

<?php require_once("welcome_get.php"); ?>