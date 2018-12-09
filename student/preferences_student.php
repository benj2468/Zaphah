<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
	require_once('../mysql_connect.php');

	function setPreferences() {
		global $conn;
		$results = mysqli_query($conn, "SELECT * FROM preferences_student WHERE student_id = " . $_SESSION['student_id'] . ";");
		if (mysqli_num_rows($results) > 0) {
			$preferences = mysqli_fetch_assoc($results);
			return ($preferences);
		} else {
			mysqli_query($conn,"INSERT INTO preferences_student (student_id) VALUES (" . $_SESSION['student_id'] . ");");
			return (setPreferences());
		}
	}

	$preferences = setPreferences();

	$times_array = array('sunday_morn',	'monday_morn',	'tuesday_morn',	'wednesday_morn',	'thursday_morn',	'friday_morn',	'saturday_morn',	'sunday_after',	'monday_after',	'tuesday_after',	'wednesday_after',	'thursday_after',	'friday_after',	'saturday_after',	'sunday_even',	'monday_even',	'tuesday_even',	'wednesday_even',	'thursday_even',	'friday_even',	'saturday_even');
$family_structure_array = array(
	'married_parents' => 'Married Parents',
	'only_father' => 'Only Father',
	'only_mother' => 'Only Mother',
	'with_daughter' => 'With Daughter',
	'with_son' => 'With Son',
	'older_sibling' => 'Older Kid (18+)',
	'younger_sibling' => 'Younger Kid (18-)'
);
?>
<form method="post" action="mysql_fill_preferences.php" id="myForm">
	<div class="row">
		<h3 class="center-align">Preferences</h3>
		<div class="col s4">
			<h4>What would you like to learn from the family?</h4>
			<p><input type="checkbox" name="ethnic_food" id="ethnic_food" <?= ($preferences['ethnic_food'] == '1') ? 'checked' : 'unchecked' ?>/><label for="ethnic_food">How to cook ethnic food</input></p>
			<p><input type="checkbox" name="country_history" id="country_history" <?= ($preferences['country_history'] == '1') ? 'checked' : '' ?>/><label for="country_history">Their country's history</label></p>
			<p><input type="checkbox" name="culture" id="culture" <?= ($preferences['culture'] == '1') ? 'checked' : '' ?>/><label for="culture">Their culture</label></p>
			<p><input type="checkbox" name="family_history" id="family_history" <?= ($preferences['family_history'] == '1') ? 'checked' : '' ?>/><label for="family_history">Their family's history</label></p>
		</div>
		<div class="col s4">
			<h4>What would you like to discuss with the family?</h4>
			<p><input type="checkbox" name="politics" id="politics" <?= ($preferences['politics'] == '1') ? 'checked' : '' ?>/><label for="politics">Politics</input></p>
			<p><input type="checkbox" name="interview" id="interview" <?= ($preferences['interview'] == '1') ? 'checked' : '' ?>/><label for="interview">I want to interview them</label></p>
			<label style="font-size:1rem;">I want to speak: (percent)<label><p class="range-field"><input type="range" name="speak_percent" id="speak_percent" min="0" max="100" value="<?= $preferences['speak_percent']; ?>" /></p><label style="font-size:1rem;">of the foreign langauge with the family<label>
		</div>
		<div class="col s4">
			<h4>How would you like to interact with the family?</h4>
			<p><input type="checkbox" name="dinner" id="dinner" <?= ($preferences['dinner'] == '1') ? 'checked' : '' ?>/><label for="dinner">Over dinner</input></p>
			<p><input type="checkbox" name="coffee" id="coffee" <?= ($preferences['coffee'] == '1') ? 'checked' : '' ?>/><label for="coffee">Over coffee</label></p>
			<p><input type="checkbox" name="babysit" id="babysit" <?= ($preferences['babysit'] == '1') ? 'checked' : '' ?>/><label for="babysit">Through babysitting</label></p>
			<p><input type="checkbox" name="english" id="english" <?= ($preferences['english'] == '1') ? 'checked' : '' ?>/><label for="english">Through teaching English</label></p>
		</div>
	</div>

	<div class="row">
		<h3 class="center-align">General Information</h3>
		<div class="divider"></div>
		<!-- Available times -->
		<h4>Time availability</h4>
		<p><span>Please give each of the folloing time periods a rating [ 0 = Doesn't Work, 3 = Works ]</span></p>
		<div class="col s12">
			<table id="available_times_table">
				<thead>
					<tr>
						<th></th>
						<th>Sunday</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Morning</th>
						<?php
							// print_r($preferences['times']);
							// echo "<br>";
							// print_r($times_array);
							foreach ($times_array as $key) {
								if ($key == "sunday_after") {
									echo "</tr><tr><th>Afternoon</th>";
								}
								if ($key == "sunday_even") {
									echo "</tr><tr><th>Evening</th>";
								}
								if (strpos($preferences['times'], $key) !== false) {
									echo '<td><input type="text" name="' . $key . '" class="times times_css" value="1"/></td>';
								} else {
									echo '<td><input type="text" name="' . $key . '" class="times times_css" /></td>';
								}
							}
						?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col s6">
			<h4>Travel Distance</h4>
			How far are you willing to travel to get to your family? (miles)
			<p class="range-field"><input type="range" name="distance_travel" id="distance_travel" min="0" max="100" value="<?= $preferences['distance_travel']; ?>"/></p>
		</div>
		<div class="col s6">
			<h4>Family Structure</h4>
			What structure family would you prefer?
			<div class="row">
				<div class="col s6">
				<?php
					foreach ($family_structure_array as $key => $value) {
						if ($key == "with_daughter") {
							echo "</div><div class='col s6'>";
						}
						if (strpos($preferences['family_structure'], $key) !== false) {
							echo '<p><input type="checkbox" name="' . $key . '" checked id="' . $key . '"><label for="' . $key . '">' . $value . '</label></p>';
						} else {
							echo '<p><input type="checkbox" name="' . $key . '" id="' . $key . '"><label for="' . $key . '">' . $value . '</label></p>';
						}
					}
				?>
				</div>
		</div>
	</div>
	<div class="row">
		<div class="right-align" id="submit_buttons_div">
			<a class="btn waves-effect waves-light responsive green darken-3 hide" id="reset_info" style="z-index:0; margin-right:20px;">Reset Preferences
				<i class="material-icons right">replay</i>
			</a>
			<button class="btn waves-effect waves-light responsive green darken-3" type="submit" style="z-index:0;">Update Preferences
				<i class="material-icons right">replay</i>
			</button>
		</div>
	</div>
</form>

<script type="text/javascript" src="js/js.js"></script>

<?php
} else {
	header('location:sign_in.php');
}
?>