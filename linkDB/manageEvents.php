<?php
//require_once 'vendor/autoload.php';
require_once 'misc/location.php';
require_once 'vendor/cloudinary/Cloudinary.php';
require_once 'vendor/cloudinary/Uploader.php';
require_once 'vendor/cloudinary/Api.php';
require_once 'vendor/cloudinary/connect.php';

class EventManage {

	public function getEvents($link, $lat, $lng) {
		//raw miles converted to degrees (1 mi = 0.0146 degrees)
		$range = 5 / 68.2;
		$sql = "SELECT * FROM events, event_info WHERE (events.event_id = event_info.event_id AND (((event_info.latitude - $lat) * (event_info.latitude - $lat) + (event_info.longitude - $lng) * (event_info.longitude - $lng)) <= ($range * $range))) ORDER BY events.event_id DESC";

		// ((pow(abs(`event_info.lat` - $lat), 2) + pow(abs(`event_info.lng` - $lng), 2))) <= $range) AND info.timestamp > (NOW() - INTERVAL 20 DAY)AND geo.id = info.id ORDER BY (geo.id + `pay_amt` + `vote`) DESC

		$results = mysqli_query($link, $sql);
		if (mysqli_num_rows($results) > 0) {
			//while loop through events

			while ($row = mysqli_fetch_assoc($results)) { ?>
			<a class="fix-link" href="event.php?eventId=<?php echo $row['event_id'] ; ?>">
				<li class="collection-item avatar hoverable">
					<span>
						<img src="<?php echo $row['image_url'] ?> " class="circle" style="margin-bottom: 10px;"><!--display default picture or user given picture-->
						<p style="padding: 5px 55px 0 15px;" class="quipCellText"><?php echo ($row['title']) ?></p>
						<a class="secondary-content" >
							<!--may reove due to issues?-->
							<?php echo $row['quirk'] ?>
						</a>
					</span>
					<p style="padding: 0 55px 0 15px;" class="quipCellTextSmaller"><?php echo ($row['description']) ?></p>

				</li>
			</a>	

			<?php }

		} else  if (mysqli_num_rows($results) == 0){ ?>
		<li class="collection-item avatar hoverable"><a href="event.php">
			<span>
				<p style="padding: 5px 55px 0 15px;" class="truncate quipCellText">Oops! We couldn't find any quips near you, try extending your range or make one of your own!</p>
			</span>	      
		</li>
		<?php }
	}
	public function addEvent($link, $lat, $lng, $user){

		$title = mysqli_real_escape_string($link, htmlspecialchars($_POST['title']));
		$desc = mysqli_real_escape_string($link, htmlspecialchars($_POST['desc']));
		$date = mysqli_real_escape_string($link, htmlspecialchars($_POST['date']));
		$time = mysqli_real_escape_string($link, htmlspecialchars($_POST['timeHour'] . " " . $_POST['time12Hour']));
		
		if(isset($user)){
			$submittedBy = $_SESSION['user_id'];
		} else {
			$submittedBy = "anonymous";
		}

		if (isset($_POST['useCustomLocation'])){
			$address = $_POST['electingToUseCustomLocation'];
			$altLoc = Location::getCoordinates($address);
			$lat = $altLoc[0];
			$lng = $altLoc[1];
		}

		if ( isset( $_FILES['addImage'] ) && $_FILES['addImage']['name'] != null ) {
  		//if user provides an image
			  // save file 
			$image = \Cloudinary\Uploader::upload($_FILES["addImage"]["tmp_name"]);
			$image = $image['url'];
			  // add the file we saved above to img_url

		} else {
			$image = 'img/stock1.jpeg';
		}
		//fix these
		$sql = "INSERT INTO events (time_stamp, quirk, user_id) VALUES (NOW() , 0 , '$submittedBy')";		
		if (!mysqli_query($link, $sql)) {
			die('Error: ' . mysqli_error($link));
		} else {
			$id = mysqli_insert_id($link);
			$sql2 = "INSERT INTO event_info (title, description, latitude, longitude, e_date, e_time, image_url, event_id) VALUES ('$title', '$desc', '$lat', '$lng', '$date', '$time', '$image', '$id')";	

			if (!mysqli_query($link, $sql2)) {
				die('Error: ' . mysqli_error($link));
			} else {
				echo "<script> window.location.replace('index.php'); </script>";
			} 

		}
		//follows user's events on creation
		$follower = $_SESSION['user_id'];
		$following = mysqli_real_escape_string($link, $id);

		$sql = "INSERT INTO sub_user_events (user_id, event_id) VALUES ('$follower', '$following')";
		mysqli_query($link, $sql);
		//increment quirk
		$sql = "UPDATE events SET quirk = quirk + 1 WHERE event_id = '$following'";
		mysqli_query($link, $sql);

	}

	public function eventExists($link, $event){
		$sql = "SELECT EXISTS(SELECT 1 FROM events WHERE event_id = '$event')";
		$results = mysqli_query($link, $sql);
		if ($results == true) {
			return $results;
		} else if ($results == false || $results == 0){
			header('Location: index.php');
		}
		
	}

	public function showEventPage($link, $event){
		$sql = "SELECT * FROM events, event_info, users WHERE events.event_id = '$event' AND events.event_id = event_info.event_id AND events.user_id = users.user_id";
		$results = mysqli_query($link, $sql);
		return $results;
	}
	public function getEventsOnSearch($link){
		$s = mysqli_real_escape_string($link, $_POST['searchForEvent']);

		$sql = "SELECT * FROM events, event_info WHERE events.event_id = event_info.event_id AND (title LIKE '%$s%' OR description LIKE '%$s%') ORDER BY events.event_id DESC";

		$results = mysqli_query($link, $sql);
		if (mysqli_num_rows($results) > 0) {
			//while loop through events

			while ($row = mysqli_fetch_assoc($results)) { ?>
			<a class="fix-link" href="event.php?eventId=<?php echo $row['event_id'] ; ?>">
				<li class="collection-item avatar hoverable">
					<span>
						<img src="<?php echo $row['image_url'] ?> " class="circle" style="margin-bottom: 10px;"><!--display default picture or user given picture-->
						<p style="padding: 5px 55px 0 15px;" class="quipCellText"><?php echo $row['title'] ?></p>
						<a class="secondary-content" >
							<!--may reove due to issues?-->
							<?php echo $row['quirk'] ?>
						</a>
					</span>
					<p style="padding: 0 55px 0 15px;" class="quipCellTextSmaller"><?php echo $row['description'] ?></p>

				</li>
			</a>	

			<?php }

		} else  if (mysqli_num_rows($results) == 0){ ?>
		<li class="collection-item avatar hoverable"><a href="event.php">
			<span>
				<p style="padding: 5px 55px 0 15px;" class="truncate quipCellText">Sorry, we couldn't find anything matching " <?php echo $s ?> ". </p>
			</span>	      
		</li>
		<?php }
	}

	public function getEventSubs($link, $event){
		$event = mysqli_real_escape_string($link, $event);
		$sql = "SELECT username, users.user_id, profile_pic, event_id FROM users, sub_user_events WHERE event_id = '$event' AND users.user_id = sub_user_events.user_id";
		$results = mysqli_query($link, $sql);
		while($row = mysqli_fetch_assoc($results)){
			echo "<a href='user.php?userId=" . $row['user_id'] . "'><div class='chip thisEventsFollowers'>
				<img src='" . $row['profile_pic'] . "'>
				" . $row['username'] . "
			</div>
			</a>";
		}
	}

}

?>
