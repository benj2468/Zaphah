<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

$us_state_abbrevs_names = array( 'AL'=>'ALABAMA', 'AK'=>'ALASKA', 'AZ'=>'ARIZONA', 'AR'=>'ARKANSAS', 'CA'=>'CALIFORNIA', 'CO'=>'COLORADO', 'CT'=>'CONNECTICUT', 'DE'=>'DELAWARE', 'DC'=>'DISTRICT OF COLUMBIA', 'FL'=>'FLORIDA', 'GA'=>'GEORGIA', 'HI'=>'HAWAII', 'ID'=>'IDAHO', 'IL'=>'ILLINOIS', 'IN'=>'INDIANA', 'IA'=>'IOWA', 'KS'=>'KANSAS', 'KY'=>'KENTUCKY', 'LA'=>'LOUISIANA', 'ME'=>'MAINE', 'MD'=>'MARYLAND', 'MA'=>'MASSACHUSETTS', 'MI'=>'MICHIGAN', 'MN'=>'MINNESOTA', 'MS'=>'MISSISSIPPI', 'MO'=>'MISSOURI', 'MT'=>'MONTANA', 'NE'=>'NEBRASKA', 'NV'=>'NEVADA', 'NH'=>'NEW HAMPSHIRE', 'NJ'=>'NEW JERSEY', 'NM'=>'NEW MEXICO', 'NY'=>'NEW YORK', 'NC'=>'NORTH CAROLINA', 'ND'=>'NORTH DAKOTA', 'OH'=>'OHIO', 'OK'=>'OKLAHOMA', 'OR'=>'OREGON', 'PA'=>'PENNSYLVANIA', 'RI'=>'RHODE ISLAND', 'SC'=>'SOUTH CAROLINA', 'SD'=>'SOUTH DAKOTA', 'TN'=>'TENNESSEE', 'TX'=>'TEXAS', 'UT'=>'UTAH', 'VT'=>'VERMONT', 'VA'=>'VIRGINIA', 'WA'=>'WASHINGTON', 'WV'=>'WEST VIRGINIA', 'WI'=>'WISCONSIN', 'WY'=>'WYOMING' );

$language_codes = array(
        'en' => 'English' , 
        'aa' => 'Afar' , 
        'ab' => 'Abkhazian' , 
        'af' => 'Afrikaans' , 
        'am' => 'Amharic' , 
        'ar' => 'Arabic' , 
        'as' => 'Assamese' , 
        'ay' => 'Aymara' , 
        'az' => 'Azerbaijani' , 
        'ba' => 'Bashkir' , 
        'be' => 'Byelorussian' , 
        'bg' => 'Bulgarian' , 
        'bh' => 'Bihari' , 
        'bi' => 'Bislama' , 
        'bn' => 'Bengali/Bangla' , 
        'bo' => 'Tibetan' , 
        'br' => 'Breton' , 
        'ca' => 'Catalan' , 
        'co' => 'Corsican' , 
        'cmn' => 'Mandarin' ,
        'cs' => 'Czech' , 
        'cy' => 'Welsh' , 
        'da' => 'Danish' , 
        'de' => 'German' , 
        'dz' => 'Bhutani' , 
        'el' => 'Greek' , 
        'eo' => 'Esperanto' , 
        'es' => 'Spanish' , 
        'et' => 'Estonian' , 
        'eu' => 'Basque' , 
        'fa' => 'Persian' , 
        'fi' => 'Finnish' , 
        'fj' => 'Fiji' , 
        'fo' => 'Faeroese' , 
        'fr' => 'French' , 
        'fy' => 'Frisian' , 
        'ga' => 'Irish' , 
        'gd' => 'Scots/Gaelic' , 
        'gl' => 'Galician' , 
        'gn' => 'Guarani' , 
        'gu' => 'Gujarati' , 
        'guzh' => 'Cantonese' ,
        'ha' => 'Hausa' , 
        'hi' => 'Hindi' , 
        'hr' => 'Croatian' , 
        'hu' => 'Hungarian' , 
        'hy' => 'Armenian' , 
        'ia' => 'Interlingua' , 
        'ie' => 'Interlingue' , 
        'ik' => 'Inupiak' , 
        'in' => 'Indonesian' , 
        'is' => 'Icelandic' , 
        'it' => 'Italian' , 
        'iw' => 'Hebrew' , 
        'ja' => 'Japanese' , 
        'ji' => 'Yiddish' , 
        'jw' => 'Javanese' , 
        'ka' => 'Georgian' , 
        'kk' => 'Kazakh' , 
        'kl' => 'Greenlandic' , 
        'km' => 'Cambodian' , 
        'kn' => 'Kannada' , 
        'ko' => 'Korean' , 
        'ks' => 'Kashmiri' , 
        'ku' => 'Kurdish' , 
        'ky' => 'Kirghiz' , 
        'la' => 'Latin' , 
        'ln' => 'Lingala' , 
        'lo' => 'Laothian' , 
        'lt' => 'Lithuanian' , 
        'lv' => 'Latvian/Lettish' , 
        'mg' => 'Malagasy' , 
        'mi' => 'Maori' , 
        'mk' => 'Macedonian' , 
        'ml' => 'Malayalam' , 
        'mn' => 'Mongolian' , 
        'mo' => 'Moldavian' , 
        'mr' => 'Marathi' , 
        'ms' => 'Malay' , 
        'mt' => 'Maltese' , 
        'my' => 'Burmese' , 
        'na' => 'Nauru' , 
        'ne' => 'Nepali' , 
        'nl' => 'Dutch' , 
        'no' => 'Norwegian' , 
        'oc' => 'Occitan' , 
        'om' => '(Afan)/Oromoor/Oriya' , 
        'pa' => 'Punjabi' , 
        'pl' => 'Polish' , 
        'ps' => 'Pashto/Pushto' , 
        'pt' => 'Portuguese' , 
        'qu' => 'Quechua' , 
        'rm' => 'Rhaeto-Romance' , 
        'rn' => 'Kirundi' , 
        'ro' => 'Romanian' , 
        'ru' => 'Russian' , 
        'rw' => 'Kinyarwanda' , 
        'sa' => 'Sanskrit' , 
        'sd' => 'Sindhi' , 
        'sg' => 'Sangro' , 
        'sh' => 'Serbo-Croatian' , 
        'si' => 'Singhalese' , 
        'sk' => 'Slovak' , 
        'sl' => 'Slovenian' , 
        'sm' => 'Samoan' , 
        'sn' => 'Shona' , 
        'so' => 'Somali' , 
        'sq' => 'Albanian' , 
        'sr' => 'Serbian' , 
        'ss' => 'Siswati' , 
        'st' => 'Sesotho' , 
        'su' => 'Sundanese' , 
        'sv' => 'Swedish' , 
        'sw' => 'Swahili' , 
        'ta' => 'Tamil' , 
        'te' => 'Tegulu' , 
        'tg' => 'Tajik' , 
        'th' => 'Thai' , 
        'ti' => 'Tigrinya' , 
        'tk' => 'Turkmen' , 
        'tl' => 'Tagalog' , 
        'tn' => 'Setswana' , 
        'to' => 'Tonga' , 
        'tr' => 'Turkish' , 
        'ts' => 'Tsonga' , 
        'tt' => 'Tatar' , 
        'tw' => 'Twi' , 
        'uk' => 'Ukrainian' , 
        'ur' => 'Urdu' , 
        'uz' => 'Uzbek' , 
        'vi' => 'Vietnamese' , 
        'vo' => 'Volapuk' , 
        'wo' => 'Wolof' , 
        'xh' => 'Xhosa' , 
        'yo' => 'Yoruba' , 
        'zh' => 'Chinese' , 
        'zu' => 'Zulu' , 
        );

	$genders_array = array(
		'male' => 'Male',
		'female' => 'Female'
	);
?>
<form method="post" enctype="multipart/form-data"  action="mysql_fill_information.php" id="myForm">
	<h3 class="center-align">Information</h3><br>
	<div class="row">
		<div class="col s10 offset-s1">
			<div class="input-field col s4" style="margin-top:0px;">
				<input name="first_name" type="text" class="validate" value="<?= $_SESSION['first_name']; ?>"/>
				<label for="first_name">First Name</label>
			</div>
			<div class="input-field col s4" style="margin-top:0px;">
				<input name="last_name" type="text" class="validate" value="<?= $_SESSION['last_name']; ?>"/>
				<label for="last_name">Last Name</label>
			</div>
			<div class="input-field col s2" style="margin-top:0px;">
				<select name="language">
				<option value="" disabled selected>Language</option>
				<?php
					foreach ($language_codes as $key => $value) {
						if ($_SESSION['language'] == $key) {
							echo '<option value="' . $key . '" selected>' . $value . '</option>';
						} else {
							echo '<option value="' . $key . '" >' . $value . '</option>';
						}
					}
					?>
			        </select>
			</div>
			<div class="input-field col s2" style="margin-top:0;">
				<input name="years_studied" type="number" class="validate" min="0" value="<?= ($_SESSION['years_studied'] == 0) ? '' : $_SESSION['years_studied']; ?>"/>
				<label for="years_studied">Years Studied</label>	
			</div>
		</div>
	</div>

	<div class="row">
		<div class="input-field col s2">
			<input name="age" type="number" class="validate" min="0" value="<?= ($_SESSION['age'] == 0) ? '' : $_SESSION['age']; ?>"/>
			<label for="age">Age</label>
		</div>
		<div class="input-field col s4">
			<select name="gender">
				<option value="" disabled selected>Gender</option>
				<?php
					foreach ($genders_array as $key => $value) {
						if ($_SESSION['gender'] == $key) {
							echo '<option value="' . $key . '" selected>' . $value . '</option>';
						} else {
							echo '<option value="' . $key . '" >' . $value . '</option>';
						}
					}
					?>
			</select>
		</div>
		<div class="input-field col s4" >
			<input name="school" type="text" class="validate" value="<?= $_SESSION['school']; ?>"/>
			<label for="school">School</label>
		</div>
		<div class="input-field col s2">
			<input name="grade" type="number" class="validate" min="0" max="16" value="<?= ($_SESSION['grade'] == 0) ? '' : $_SESSION['grade']; ?>"/>
			<label for="grade">Grade</label>
		</div>
	</div>

	<div class="row">
		<div clas="col s6">
			<div class="input-field col s4">
				<input name="street_address" type="text" class="validate" value="<?= $_SESSION['street_address']; ?>"/>
				<label for="street_address">Street Address</label>
			</div>
			<div class="input-field col s3">
				<input name="city" type="text" class="validate" value="<?= $_SESSION['city']; ?>"/>
				<label for="city">City</label>
			</div>
			<div class="input-field col s3">
				<select name="state" style="z-index:1;">
					<option value="State" disabled selected>State</option>
					<?php
					foreach ($us_state_abbrevs_names as $key => $value) {
						$previously_selected = false;
						if ($_SESSION['state'] == $key) {
							echo '<option name="' . $key . '" value="' . $key . '" selected>' . $value . '</option>';
						} else {
							echo '<option name="' . $key . '" value="' . $key . '" >' . $value . '</option>';
						}
					}
					?>
				</select>
			</div>
			<div class="input-field col s2">
				<input name="zip_code" type="text" class="validate" value="<?= ($_SESSION['zip_code'] == 0) ? '' : $_SESSION['zip_code']; ?>">
				<label for="zip_code">Zip Code</label>
			</div>
		</div>
	</div>
	<div class="row valign-wrapper">
		<div class="col s3 valign">
			Have you studied abroad?
		</div>
		<div class="switch col s2 valign">
		    	<label>
		      		No
		      		<input name="studied_abroad" type="checkbox" <?= ($_SESSION['studied_abroad'] == 1) ? 'checked' : '' ?>>
		      		<span class="lever"></span>
		      		Yes
		    	</label>
                </div>
		<div class="col s6 row valign-wrapper">
                        <div class="col s6 valign">
                                <input type="file" title="sorry" name="picture" id="img_preview_input" />
                                <a class="waves-effect waves-light btn" id="img_preview_button">Picture</a>
                        </div>
                        <div class="col s6 valign">
                                <img id="img_preview" style="max-height:200px; max-width:200x;" src="img/users_imgs/<?= $_SESSION['picture'] ?>" alt="your image" />
                        </div>
                </div>
	</div>
	<div class="row">
		<div class="right-align" id="submit_buttons_div">
			<a class="btn waves-effect waves-light responsive green darken-3 hide" id="reset_info" style="z-index:0; margin-right:20px;">Reset Information
				<i class="material-icons right">replay</i>
			</a>
			<button class="btn waves-effect waves-light responsive green darken-3" type="submit" style="z-index:0;">Update Information
				<i class="material-icons right">send</i>
			</button>
		</div>
	</div>
</form>

<script type="text/javascript" src="js/js.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<?php
} else {
	header('location:sign_in.php');
}
?>