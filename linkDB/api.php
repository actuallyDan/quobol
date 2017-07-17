<?php
require_once 'connect.php';
// require_once 'manageUsers.php';
// require_once 'manageEvents.php';
// require_once 'connectBlog.php';
// require_once 'msgHandle.php';


	//  $lat = mysqli_real_escape_string($link, $_POST['lat']);
	//  $lng = mysqli_real_escape_string($link, $_POST['lng']);
	// $range = 5 / 68.2;
	// $sql = "SELECT title, description, latitude, longitude FROM events, event_info WHERE events.event_id = event_info.event_id AND ((latitude - $lat) * (latitude - $lat) + (longitude - $lng) * (longitude - $lng)) <= ($range * $range) LIMIT 20";
	 
	// // Check if there are results
	// if ($result = mysqli_query($link, $sql))
	// {
	// 	// If so, then create a results array and a temporary one
	// 	// to hold the data
	// 	$resultArray = array("events");
	// 	$tempArray = array();
	 
	// 	// Loop through each row in the result set
	// 	while($row = $result->fetch_object())
	// 	{
	// 		// Add each row into our results array
	// 		$tempArray = $row;
	// 	    array_push($resultArray, $tempArray);
	// 	}
	 
	// 	// Finally, encode the array to JSON and output the results
	// 	echo json_encode($resultArray);
	// }


if (isset($_POST['apiCall'])) {

	if ($_POST['apiCall'] == 'getEventsOnMainPage') {
		$banans = 5;
		echo '<h3>This is a new header</p>' . $banans;

	} else if ($_POST['apiCall'] == 'loadThisDiv') {
		$oranges = 'banananananananananana';
		echo '<h3>Secondary Header Action ' . $oranges . "</h3>";

	} else if ($_POST['apiCall'] == 'loadThisDiv2') {
		$banans = 5;
		echo '<button id="summonNewButton" class="btn">Schmitt is a lying cheater</button>';

	} else if ($_POST['apiCall'] == 'loadNewButton') {
		echo '<button id="thisIsTheNew" class="btn">Kyle is a nice guy</button>';
	}
}
?>