<?php

class Location {
	//get custom location quip if set
	public function getCoordinates($address) {
 
	$address = str_replace(" ", "+", $address); // replace all the white space with "+" sign to match with google search pattern
	 
	$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
	 
	$response = file_get_contents($url);
	 
	$json = json_decode($response,TRUE); //generate array object from the response from the web
	 
	$location = array($json['results'][0]['geometry']['location']['lat'] , $json['results'][0]['geometry']['location']['lng']); 
	return $location;
	 }
}


?>