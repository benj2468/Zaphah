<?php

require_once('mysql_connect.php');

class GetMatches {

	function GetMatches($user_type,$user_id) {
		$this->user_type_ = $user_type;
		$this->user_id_ = $user_id;
		$this->user_data_ = $this->setUserData();
		$this->match();

	}

	function setUserData () {
		global $conn;
		$sql = "SELECT * FROM " . $this->user_type_ . " INNER JOIN preferences_" . $this->user_type_ . " ON " . $this->user_type_ . "." . $this->user_type_ . "_id=preferences_" . $this->user_type_ . "." . $this->user_type_ . "_id WHERE " . $this->user_type_ . "." . $this->user_type_ . "_id=" . $this->user_id_ . ";";
		$results = mysqli_query($conn, $sql);
		if (mysqli_num_rows($results) > 0) {
			$results = mysqli_fetch_assoc($results);
		}
		return $results;
	}

	function matchLanguage ($match_with_user_type) {
		global $conn;
		$results_array = array();

		$language_results = mysqli_query($conn,"SELECT * FROM " . $match_with_user_type . " INNER JOIN preferences_" . $match_with_user_type . " ON " . $match_with_user_type . "." . $match_with_user_type . "_id=preferences_" . $match_with_user_type . "." . $match_with_user_type . "_id WHERE language='" . $this->user_data_['language'] . "'");
		while ($row = mysqli_fetch_assoc($language_results)) {
			$row['score'] = 0;
			$row['user_type'] = $match_with_user_type;
			array_push($results_array, $row);
		}
		return $results_array;
	}

	function matchForDistance ($matches) {
		$origin_string = $this->user_data_['street_address'] . " " . $this->user_data_['city'] . " " . $this->user_data_['state'] . " " . $this->user_data_['zip_code'];
		$origin_string = str_replace(" ", "+", $origin_string);

		$prefered_distance = round((($this->user_data_['distance_travel'])/0.00062137),0);

		foreach ($matches as $key => $individual) {
			$destination_string = $individual['street_address'] . " " . $individual['city'] . " " . $individual['state'] . " " . $individual['zip_code'];
			$destination_string = str_replace(" ", "+", $destination_string);

			$responce_json = file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins=' . $origin_string . '&destinations=' . $destination_string . '&units=imperial');
			$responce_array = json_decode($responce_json,true);

			$distance_meters = $responce_array['rows'][0]['elements'][0]['distance']['value'];

			if ($distance_meters <= $prefered_distance) {
				$matches[$key]['score'] += 5;
			} else if (abs($distance_meters - $prefered_distance) <= 10000) {
				$matches[$key]['score'] += 3;
			}
		}
		return $matches;
	}

	function matchForAvailableTimes ($matches) {
		$user_available_times_array = explode(",", $this->user_data_['times']);

		foreach ($matches as $key => $individual) {
			$match_available_times_array = explode(",", $individual['times']);
			$score = 0;
			foreach (array_intersect($user_available_times_array, $match_available_times_array) as $value) {
				$score += 1;
			}
			//$score = round(($score/4),0);
			$matches[$key]['score'] += $score;
		}
		return $matches;
	}

	function matchForAge ($matches) {
		$user_age = $this->user_data_['age'];

		foreach ($matches as $key => $individual) {
			$match_prefered_age = $individual['age'];
			$score = 0;
			if ($user_age == $match_prefered_age) {
				$score = 2;
			} else if (abs($user_age - $match_prefered_age) <= 2) {
				$score = 1;
			}
			$score = round(($score*2.5),0);
			$matches[$key]['score'] += $score;
		}
		return $matches;
	}

	function matchForYearsStudied ($matches) {
		$user_years_studied = $this->user_data_['years_studied'];
		if ($this->user_type_ == 'student') {
			if ($this->user_data_['studied_abroad']) {
				$user_years_studied += 2;
			}
		}

		foreach ($matches as $key => $individual) {
			$match_prefered_years_studied = $individual['years_studied'];
			$score = 0;
			if ($user_years_studied == $match_prefered_years_studied) {
				$score = 2;
			} if (abs($user_years_studied - $match_prefered_years_studied) <= 2) {
				$score = 1;
			}
			$score = round(($score*2.5),0);
			$matches[$key]['score'] += $score;
		}

		return $matches;
	}

	function matchForPreferences ($matches) {
		$preferences_keys = array('ethnic_food','country_history','culture','family_history','politics','interview','dinner','coffee','babysit','english');

		foreach ($preferences_keys as $preference_string) {
			$user_preference = $this->user_data_[$preference_string];
			foreach ($matches as $key => $individual) {
				$score = 0;
				$match_preference = $individual[$preference_string];

				if ($user_preference == $match_preference) {
					$score += 1;
				}
				$matches[$key]['score'] += $score;
			}
		}
		
		 // SPEAK_PERCENT
		$user_preference = $this->user_data_['speak_percent'];
		foreach ($matches as $key => $individual) {
			$score = 0;
			$match_preference = $individual['speak_percent'];

			if ($user_preference == $match_preference) {
				$score = 2;
			} else if (abs($user_preference - $match_preference) < 15) {
				$score = 1;
			}
			$matches[$key]['score'] += $score;
		}
		return $matches;
	}

	function orderMatches($matches) {
		$matches_placeholder = $matches;
		$new_array_of_score_and_key = array();
		foreach ($matches as $key => $individual) {
			$new_array_of_score_and_key[$key] = $individual['score'];
		}
		arsort($new_array_of_score_and_key);
		$i = 0; //This will be the index of the array entries
		foreach ($new_array_of_score_and_key as $key => $value) {
			$matches[$i] = $matches_placeholder[$key];
			$i += 1;
		}

		return $matches;
	}

	function match() {

		if ($this->user_type_ == 'student') {
			$match_with_user_type = 'family';
		} else {
			$match_with_user_type = 'student';
		}

		$matches = $this->matchLanguage($match_with_user_type);

		if ($this->user_type_ == 'student') {
			$matches = $this->matchForDistance($matches);
		}

		$matches = $this->matchForAvailableTimes($matches);

		$matches = $this->matchForAge($matches);

		$matches = $this->matchForYearsStudied($matches);

		$matches = $this->matchForPreferences($matches);

		$matches = $this->orderMatches($matches);

		print_r(json_encode($matches));
		//print_r($matches);
	}
	
	private $user_data_;
	private $user_type_;
	private $user_id_;
}

$user_type = $_GET['user_type'];
$user_id = $_GET['user_id'];

new GetMatches($user_type,$user_id);

?>