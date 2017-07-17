<?php

class HandleMessage {

	public function saveMessage($link){
		
		$event_channel = mysqli_real_escape_string($link, $_POST['event_id']); //saves the chat from this channel (tied to event id)
		$user = mysqli_real_escape_string($link, $_SESSION['user_id']);
		$msg = mysqli_real_escape_string($link, $_POST['msg']);
		//$sql = "INSERT INTO `event_messages` (message, event_id, time_stamp) VALUES ('$msg', '$event_channel', NOW())";
		$sql = "INSERT INTO event_messages (message, event_id, user_id, time_stamp) VALUES ('$msg', '$event_channel', '$user', NOW())";
		if (mysqli_query($link, $sql)) {
			 //nothing went wrong! yay!
		} else {
			//die("Something fucked up");
		}
	}
	public function getMessages($link, $event){

		//$sql = "SELECT * FROM (SELECT * FROM event_messages, events, users WHERE events.event = '$event' ORDER BY message_id DESC LIMIT 20) sub ORDER BY message_id ASC";
		$sql = "SELECT * FROM(SELECT username, u.user_id, profile_pic, message, event_id, message_id, time_stamp FROM users AS u, event_messages AS em WHERE em.user_id = u.user_id AND em.event_id = '$event' ORDER BY message_id DESC) sub ORDER BY message_id ASC";
		$results = mysqli_query($link, $sql);
		if (mysqli_num_rows($results) > 0) {
    // output data of each row
			 $i = mysqli_num_rows($results);
			while($row = mysqli_fetch_assoc($results)) {
				if ($row['username'] == $_SESSION['user']) {
					$appearance = "myMessageCss";
					$namePosition = "right";
				} else {
					$appearance = "otherMessageCss";
					$namePosition = "left";
				}
				// $timeHr = (int)substr($row['time_stamp'], 11, -4);
				// $timeHalf = 'AM';

				// if ($timeHr > 12) {
				// 	$timeHr = $timeHr - 12;
				// 	$timeHalf = 'PM';
				// } else if ($timeHr == 0) {
				// 	$timeHr = 12;
				// 	$timeHalf = 'AM';				
				// } else if ($timeHr == 12) {
				// 	$timeHr = 12;
				// 	$timeHalf = 'PM';				
				// }


				// $timeMin = substr($row['time_stamp'], 13, -3);

				// $time = $timeHr . $timeMin . " " . $timeHalf;
				$date = strtotime($row['time_stamp']);
				$time = date('h:i a',$date);



				echo "<div class='messageWrapper'>
						<div class='message'>
						<span class='clickToShowTime'>
							<img src='" .  $row['profile_pic'] ."'class='circle " . $namePosition . " tooltipped' height='40px' width='40px' data-position='top' data-delay='50' data-tooltip='" .  $row['username'] ."'></img>
							<li class='card-panel " . $appearance  . " ". $namePosition ."'>" 
							. $row['message'] . 
							"</li>
							<br><br>
						</span>
						 <label class='timestamp " . $namePosition ."'>" . $time . "</label>
					</div>
					</div>";
				//echo "<div class='message'><li class='card-panel'>" . $row['message'] . "</div>";
				
			}
		} else {
			// echo "<li class='collection-item' style='height: 80px; text-align:center;'>
			// 		      <span>
			// 		        <p style='padding: 5px 55px 0 15px;' class='quipCellText'>No messages</p>
			// 		      </span>

			// 		    </li>";
		}
	}
}

if (isset($_POST['saveMessage'])){
	if ($_POST['saveMessage'] == 'true') {
		HandleMessage::saveMessage($link);
	}
}

?>