<?php
require_once 'linkDB/connect.php';
require_once 'linkDB/manageEvents.php';
require_once 'linkDB/manageUsers.php';
require_once 'misc/location.php';
require_once 'linkDB/msgHandle.php';

if (isset($_SESSION['lat']) == false){
	$_SESSION['lat'] = 0;
	$_SESSION['lng'] = 0;

	//echo "<div class=></div>"
	require_once 'includes/geolocation.php';
} 
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
} else if(isset($_COOKIE['user'])){
	//resets cookie and adds 2 days
	// setcookie('user_id', $_COOKIE['user_id'], time() + (86400 * 2), "/"); // sets user Id 86400 = 1 day
	// setcookie('user', $_COOKIE['user'], time() + (86400 * 2), "/"); // sets username 86400 = 1 day
	// setcookie('profile_pic', $_COOKIE['profile_pic'], time() + (86400 * 2), "/"); // sets user profile_pic 86400 = 1 day

	$_SESSION['user_id'] = $_COOKIE['user_id'];
	$_SESSION['user'] = $_COOKIE['user'];
	$_SESSION['profile_pic'] = $_COOKIE['profile_pic'];
} else {
	$user = "Anonymous";
}

if(isset($_POST['ajaxAction'])){
	if ($_POST['ajaxAction'] == 'getLocation') {
		$_SESSION['lat'] = $_POST['lat'];
		$_SESSION['lng'] = $_POST['lng'];
	}
}

$lat = $_SESSION['lat'];
$lng = $_SESSION['lng'];


?>

<html>
<head>
	<?php  require_once 'includes/head.php'; ?>
	<title>Quobol</title>

</head>
<body onload="getLocation()">
	<div id="sections">
		<?php require_once 'includes/topNav.php'; ?>
		<?php require_once 'includes/sideNav.php'; ?>

		<section class="main fullscreenMain">
			<!--all things not sidebar go below here-->
			<nav id="searchBar" class="bknd-blue-light" style="display:none">
				<div class="nav-wrapper bknd-blue-light">
					<form method="POST" action="index.php">
						<div class="input-field">
							<input id="search" type="search" name="searchForEvent" required>
							<label id="searchBarInputField" for="search" class="active"><i class="material-icons">search</i></label>
							<i id="closeSearchBar" class="material-icons">close</i>
						</div>
					</form>
				</div>
			</nav>

			<div id="content">

				<?php
				require_once 'includes/quipBody.php'; 
				?>
			</div>

		</section>
		<?php require_once 'includes/newQuip.php'; ?>

	</div>
	<script type="text/javascript">
	function getLocation(){
		$('#sections').hide();

		var currLat = <?php echo json_encode($_SESSION['lat']);?>;
		var currLng = <?php echo json_encode($_SESSION['lng']);?>;
		console.log(currLat + ", " + currLng);
		if (currLat == 0 &&  currLng == 0) {
					//needs to set location
					if ("geolocation" in navigator) {
						/* geolocation is available */
						console.log("location services enabled");
					  //do stuff once location is enabled
					  //get location store it in lng and lat
					  navigator.geolocation.getCurrentPosition(function(position) {
					  	var lat = position.coords.latitude;
					  	var lng = position.coords.longitude;
					  	console.log(lat + ", " + lng);


					  //ajax request to send to index.php
					  var ajaxurl = 'index.php',
					  data =  {'ajaxAction': 'getLocation', 'lat': lat , 'lng': lng};
					  $.post(ajaxurl, data, function (response) {
				            // Response div goes here.
				            $('body').load('index.php');
				           	//$('body').fadeIn(300);
				          // 	window.location.replace('index.php');
				      });

					  //re-load index.php


					});

					} else {
						/* geolocation IS NOT available */
						alert("Please enable Location Services");
					}
				}
				$('#sections').show();

			}
			</script>
		</body>
		</html>