<?php
	
	if(isset($_POST['getLocation'])) {
		$_SESSION['lat'] = round($_POST['lat'], 8);
		$_SESSION['lng'] = round($_POST['lng'], 8);
		header('Location: index.php');
	}
?>

<html>
<head>
	<?php require_once 'includes/head.php'; ?>
	<title>Getting Your Location...</title>
</head>
<script type="text/javascript">
function getLocation() {
	x = navigator.geolocation;
    x.getCurrentPosition(success, failure);

    function success(position) {
    	var mylat = position.coords.latitude;
    	var mylng = position.coords.longitude;

    	$('#latit_input').val(mylat);
    	$('#longit_input').val(mylng);
        
    	$('#locationData').submit();

	}

	function failure() {
	alert("Error getting location. Make sure Javascript is supported and Location Services are permitted.");

	}
    }

</script>
<body onload="getLocation()">

	<form id="locationData" name="locationData" method="POST" >
				<input type="hidden" name="lat" id="latit_input" />
				<input type="hidden" name="lng" id="longit_input" />
				<input type="submit" name="getLocation" style="visibility: hidden;"> 
	</form>
</body>

</html>