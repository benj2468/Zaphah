<form action="mysql_fill.php" method="post">
	<div class="row">
		<div class="col s12">
			<h4 class="center-align">Sign Up for Free</h4>

			<div class="input-field">
				<select name="user_type">
					<option value="" disabled selected>Choose your option</option>
					<option value="student">Student</option> <!-- ** THESE VALUES MUST BE THE SAME AS THE NAMES OF THE TABLES ** -->
					<option value="family">Family</option>
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
			<input type="hidden" value="sign_up" name="post_type"/>
			<div class="row align right">
				<button class="btn waves-effect waves-light responsive" type="submit" >Sign Up
    				<i class="mdi-content-send right"></i>
  				</button>
    		</div>
		</div>
	</div>
</form>