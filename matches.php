<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

	$string_for_user_id = $_SESSION['user_type'] . "_id";
	$user_id = $_SESSION[$string_for_user_id];

	$family_structure_decode_array = array(
		'married_parents' => 'Married Parents',
		'only_father' => 'Only Father',
		'only_mother' => 'Only Mother',
		'with_daughter' => 'With Daughter',
		'with_son' => 'With Son',
		'older_sibling' => 'Older Kid (18+)',
		'younger_sibling' => 'Younger Kid (18-)'
	);

	$available_times_decode_array = array(
		'sunday_morn' => 'Sunday Morning',	
		'monday_morn' => 'Monday Morning',	
		'tuesday_morn' => 'Tuesday Morning',	
		'wednesday_morn' => 'Wednesday Morning',	
		'thursday_morn' => 'Thursday Morning',	
		'friday_morn' => 'Friday Morning',	
		'saturday_morn' => 'Saturday Morning',	
		'sunday_after' => 'Sunday Afternoon',	
		'monday_after' => 'Monday Afternoon',
		'tuesday_after' => 'Tuesday Afternoon',
		'wednesday_after' => 'Wednesday Afternoon',
		'thursday_after' => 'Thursday Afternoon',	
		'friday_after' => 'Friday Afternoon',	
		'saturday_after' => 'Saturday Afternoon',	
		'sunday_even' => 'Sunday Evening',
		'monday_even' => 'Monday Evening',	
		'tuesday_even' => 'Tuesday Evening',	
		'wednesday_even' => 'Wednesday Evening',	
		'thursday_even' => 'Thursday Evening',	
		'friday_even' => 'Friday Evening',	
		'saturday_even' => 'Saturday Evening'
	);
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

	$preferences_array_family_match = array(
		'ethnic_food' => 'Teach you how to make ethnic dishes',
		'country_history' => 'Teach you their countries history',
		'culture' => 'Teach you their culture',
		'family_history' => 'Teach you their family\'s history',
		'politics' => 'Talk to you about politics',
		'interview' => 'Be interviewed',
		'dinner' => 'Meet you for dinner',
		'coffee' => 'Meet you for coffee',
		'babysit' => 'Invite you to babysit their kid(s)',
		'english' => 'Learn English from you'
	);
        $preferences_array_student_match = array(
                'ethnic_food' => 'Learn how to make ethnic dishes',
                'country_history' => 'Learn your countries history',
                'culture' => 'Learn your culture',
                'family_history' => 'Learn your family\'s history',
                'politics' => 'Talk to you about politics',
                'interview' => 'Interview you',
                'dinner' => 'Meet you for dinner',
                'coffee' => 'Meet you for coffee',
                'babysit' => 'Babysit your kid(s)',
                'english' => 'Teach you English'
        );

	$matches =  json_decode(file_get_contents('http://localhost:8888/Summer%20Project/match.php?user_type=' . $_SESSION['user_type'] . '&user_id=' . $user_id ), true);
	$count = 0;
	echo '<div class="row">';
        if ($matches) {
                foreach ($matches as $key => $individual) {
                        if ($individual['user_type'] == 'student') {
                                $preferences_array_to_use = $preferences_array_student_match;
                        } else {
                                $preferences_array_to_use = $preferences_array_family_match;
                        }

                                $family_structure = "";
                                $family_structure_array = explode(",", $individual['family_structure']);
                                foreach ($family_structure_array as $value) {
                                        $family_structure .= $family_structure_decode_array[$value] . ", ";
                                }
                        $family_structure = substr($family_structure, 0, -2);

                        $available_times = "";
                        $available_times_array = explode(",", $individual['times']);
                        foreach ($available_times_array as $value) {
                                $available_times .= $available_times_decode_array[$value] . ", ";
                        }
                        $available_times = substr($available_times, 0, -2);

                        $language = $language_codes[$individual['language']];
                        $preferences_array = array();

                        foreach ($individual as $key => $value) {
                                foreach ($preferences_array_to_use as $preferences_key => $decoded_key) {
                                        if ($key == $preferences_key) {
                                                if ($value == 1) {
                                                        $preferences_array[$key] = $decoded_key;
                                                }       
                                        }
                                }
                                if ($key == 'speak_percent') {
                                        $preferences_array[$key] = "Speak " . $individual['speak_percent'] . "% of the foreign language with you";
                                }
                        }


                        echo '<div class="col s12 m3">';
                        echo '<div class="card blue-grey darken-1">';
                        echo '<div class="card-content white-text">';
                        echo '<span class="card-title"> ' . $individual["first_name"] . ' ' . $individual["last_name"] . '</span>
                                <p>Score: ' . $individual['score'] . ' </p>
                                </div>
                                <div class="card-action">
                                <a class="modal-trigger" href="#' . $_SESSION['user_type'] . '_' . array_values($individual)[0] . '_modal">Learn More</a>';
                        
                        echo '
                                <div id="' . $_SESSION['user_type'] . '_' . array_values($individual)[0] . '_modal" class="modal modal-fixed-footer">
                                    <div class="modal-content">
                                    <div class="row">
                                        <div class="col s6">
                                                <h4>' . $individual['first_name'] . ' ' . $individual['last_name'] .  '</h4>
                                                <p>
                                                <b>Language:</b> ' . $language . ' <br>';

                                                switch ($individual['user_type']) {
                                                        case 'student':
                                                                echo '<b>Prefered Family Stucture:</b> ' . $family_structure . ' <br>';
                                                                break;
                                                        case 'family':
                                                                echo '
                                                                <b>Background:</b> ' . $individual['ethnic_background'] . ' <br>
                                                                <b>Family Structure:</b> ' . $family_structure . ' <br>';
                                                                break;
                                                        default:
                                                                # code...
                                                                break;
                                                }
                                                


                        echo '
                                                </p>
                                            </div>
                                            <div class="col s6">
                                                <img class="responsive-img" src="img/users_imgs/' . $individual['picture'] . '"/>
                                            </div>
                                        </div>
                                        <div class="divider"></div>
                                        <p>
                                                <b>City:</b> ' . $individual['city'] . ' <br>
                                                <b>Available Times:</b> ' . $available_times . '
                                        </p>
                                        <div class="divider"></div>
                                        <p>
                                                <b>Wants to...</b><br>
                                                <p>
                                                        <ul>';
                                                foreach ($preferences_array as $key => $value) {
                                                        echo '<li>' . $value . '</li>';
                                                };
                        echo '
                                                        </ul>
                                                </p>
                                        </p>
                                        </div>
                                        <div class="modal-footer">
                                                <a href="#!" class="modal-action modal-close waves-effect waves-green-dark btn-flat">Close</a>
                                                <a href="?email=' . $individual["email"] . '" class="modal-action modal-close  waves-effect waves-green-dark btn-flat">Contact</a> 
                                        </div>
                                </div>';
                        echo '</div>';
                        echo '</div>';
                        if (($key % 4) == 0) {
                                echo '</div>';
                                echo '<div class="row">';
                        }
                        $count += 1;
                }
        } else {
                echo '<div class="center-align">Sorry, no matches found.</div>';
        }
}
?>

<script type="text/javascript" src="js/js.js"></script>



