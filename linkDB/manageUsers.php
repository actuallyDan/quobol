<?php
require_once 'vendor/cloudinary/Cloudinary.php';
require_once 'vendor/cloudinary/Uploader.php';
require_once 'vendor/cloudinary/Api.php';
require_once 'misc/errorMessage.php';
require_once 'vendor/cloudinary/connect.php';

 class ManageUser{
	public function loginUser($link){
		$username = trim($_POST["LoginUsername"]);

		//check to see if user exists
		$username = mysqli_real_escape_string($link, $username);
		$sql = "SELECT username FROM users WHERE username = '$username' LIMIT 1";
		$results = mysqli_query($link, $sql);

		if (mysqli_num_rows($results) == 1){
			//username exists, continue with login	
			$sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

			$results = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($results);

			$password = trim($_POST["LoginPassword"]);

			//check password against record
			if (password_verify($password, $row['password'])) { 
			    //Password is valid! 
			    $_SESSION['user_id'] = $row['user_id'];
			    $_SESSION['user'] = $row['username'];
				$_SESSION['profile_pic'] = $row['profile_pic'];
				if(isset($_POST['stayLoggedIn'])){
					//if user checks "Keep Me Logged In" sets cookies 
				setcookie('user_id', $_SESSION['user_id'], time() + (86400 * 2), "/"); // sets user Id 86400 = 2 days
				setcookie('user', $_SESSION['user'], time() + (86400 * 2), "/"); // sets username 86400 = 2 days
				setcookie('profile_pic', $_SESSION['profile_pic'], time() + (86400 * 2), "/"); // sets user profile_pic 86400 = 2 days
				}
				
				header('Location: index.php');
			} else { 
				//return error: password is invalid
			     $message = 'Invalid password.'; 
			     ErrorMessage::displayError($message);
			} 

		} else {
			//return error
			$message = "Sorry! This user doesn't exist. Maybe try Registering?";
			 ErrorMessage::displayError($message);
		}

	}// end login function

	public function registerUser($link) {

		$username = trim(mysqli_real_escape_string($link, $_POST['SignUpUsername']));

		if(strlen($username) >= 6 && strlen($username) < 25) {
			$sql = "SELECT * FROM users WHERE username = '$username'";
				//checks if username is unique
				$results = mysqli_query($link, $sql);

				if (mysqli_num_rows($results) == 0) {
				$email = trim(mysqli_real_escape_string($link, $_POST['SignUpEmail']));
				$sql = "SELECT * FROM users WHERE email = '$email'";
				//$sql = "SELECT EXISTS(SELECT 1 FROM users WHERE email = '$email')";
				$results = mysqli_query($link, $sql);

				if (mysqli_num_rows($results) == 0) {
				$password = trim(mysqli_real_escape_string($link, $_POST['SignUpPassword']));
				if (strlen($password) >= 6) {
					//lengths sufficent, email not in use
					$user_id = dechex(crc32($email));
					$password = password_hash($password, PASSWORD_DEFAULT);

					$sql = "INSERT INTO users (user_id, username, password, email, profile_pic, cover_photo) VALUES ('$user_id', '$username', '$password', '$email', 'img/stock1.jpeg', 'img/stock7.jpeg')";
				
					if (!mysqli_query($link, $sql)) {
						//error registering
						$message = "Error registering this account, please try again at another time.";
						ErrorMessage::displayError($message);

					} else {
						$_SESSION['user_id'] = $user_id;
						$_SESSION['user'] = $username;
						$_SESSION['profile_pic'] = 'img/stock1.jpeg';
						header("Location: index.php");

					}
				} else {
					//password is too short
					$message = "Password must be at least 6 characters";
					 ErrorMessage::displayError($message);
				}

			} else {
				//email is already taken
				$message = "This email is already taken";
				 ErrorMessage::displayError($message);
			} 
		} else {
			$message = "This username has already been taken";
			 ErrorMessage::displayError($message);
		}
		} else {
		//username is too short
			$message = "Username must be between 6 and 25 characters$message =";
			 ErrorMessage::displayError($message);
		}

		
	}//end register function

	public function showUserPage($link, $userToDisplay){
		$sql = "SELECT user_id, username, profile_pic, cover_photo FROM users WHERE user_id = '$userToDisplay'";
		$results = mysqli_query($link, $sql);
		return $results;
	}
	
	public function getQueue($link) {
		$user = $_SESSION['user_id'];
		$sql = "SELECT * FROM events, event_info, sub_user_events WHERE events.event_id = event_info.event_id AND events.event_id = sub_user_events.event_id AND sub_user_events.user_id = '$user'";
	
		$results = mysqli_query($link, $sql);
		return $results;

	}

	public function getEventsByUser($link, $userToDisplay){
		$sql = "SELECT * FROM events, event_info WHERE submitted_by = '$userToDisplay' AND events.event_id = event_info.event_id";
		$results = mysqli_query($link, $sql);
		return $results;
	}

	public function logoutUser(){
		unset($_SESSION['user_id']);
		unset($_SESSION['user']);
		unset($_SESSION['profile_pic']);
		setcookie('user_id', "", time() - (3600), "/"); // sets user Id 86400 = 1 day
		setcookie('user', "", time() - (3600), "/"); // sets username 86400 = 1 day
		setcookie('profile_pic', "", time() - (3600), "/"); // sets user profile_pic 86400 = 1 day

		header('Location: index.php');
	}

	public function getQuirk($link, $userToDisplay){
		$sql2 = "SELECT * FROM events, event_info WHERE events.event_id = event_info.event_id AND events.user_id = '$userToDisplay'";
 	    $results = mysqli_query($link, $sql2);
 	    return $results;
 	
	}
	public function followEvent($link){
		$follower = $_SESSION['user_id'];
		$following = mysqli_real_escape_string($link, $_POST['id']);

		$sql = "INSERT INTO sub_user_events (user_id, event_id) VALUES ('$follower', '$following')";
		mysqli_query($link, $sql);
		//increment quirk
		$sql = "UPDATE events SET quirk = quirk + 1 WHERE event_id = '$following'";
		mysqli_query($link, $sql);
	}
	public function unfollowEvent($link){
		$follower = $_SESSION['user_id'];
		$unfollow = mysqli_real_escape_string($link, $_POST['id']);
		$sql = "DELETE FROM sub_user_events WHERE user_id = '$follower' AND event_id = '$unfollow' LIMIT 1";
		mysqli_query($link, $sql);
		//decrement quirk on unfollow
		$sql = "UPDATE events SET quirk = quirk - 1 WHERE event_id = '$unfollow'";
		mysqli_query($link, $sql);
	}
	public function changeProfilePic($link){
		$user = $_SESSION['user_id'];
		$image = \Cloudinary\Uploader::upload($_FILES["useThisPic"]["tmp_name"]);
		$image = $image['url'];
		$sql = "UPDATE users SET profile_pic = '$image' WHERE user_id = '$user'";
		mysqli_query($link, $sql);
		 $_SESSION['profile_pic'] = $image;
	}
	public function sendPasswordResetEmail($link){

		$thisEmailHashed = sha1($_POST['emailForReset']);
		$to      = $_POST['emailForReset'];
		$subject = 'Reset Your Password';
		$message = '<html>
		<body>
		<a href="quobol.com/reset.php?h='. $thisEmailHashed .'&u='. $_POST['emailForReset'] .'"> Click Here to be redirected to Quobol.com and reset your password.</a><br>
		<p> If this link doesn\'t work, copy and paste the following address into your address bar without quotes: <br><br>
		<p>www.quobol.com/reset.php?h='. $thisEmailHashed .'&u='. $_POST['emailForReset'] . '</p>
		</body></html>';
		
		$headers = 'From: admin@quobol.com' . "\r\n" .
		    'Reply-To: admin@quobol.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    

		$mail = mail($to, $subject, $message, $headers);
		if (!$mail) {
			$message = "There was an error sending your recovery message. Please try again later. <br> If this problem persists please contact us at admin@quobol.com.";
			ErrorMessage::displayMessage($message);
			header('Location: login.php');
		} else {
			$message = "An email with directions to reset your password has been sent.";
			ErrorMessage::displayMessage($message);
			header('Location: login.php');
		}
	}
	public function resetPassword($link, $emailForReset){
		if ($_POST['newPass'] == $_POST['newPassConfirm']) {
			//update password
			$email = mysqli_real_escape_string($link, $emailForReset);
			$pass = mysqli_real_escape_string($link, $_POST['newPass']);
			$password = password_hash($pass, PASSWORD_DEFAULT);
			$sql = "UPDATE users SET password = '$password' WHERE email = '$email'";

			if (mysqli_query($link, $sql)) {
				//if update is successful login
				$sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

				$results = mysqli_query($link, $sql);	
				while($row = mysqli_fetch_assoc($results)){
					$user = $row['username'];
					$user_id = $row['user_id'];
					$user_pic = $row['profile_pic'];
				}

				$_SESSION['user_id'] = $user_id;
			    $_SESSION['user'] = $user;
				$_SESSION['profile_pic'] = $user_pic;
			
				header('Location: index.php');
			} else {
				$message = 'An error occured while resetting your password. Please try again. <br> If this problem persists please contact us at admin@quobol.com.';
				ErrorMessage::displayError($message);

			}


		} else {
			$message = 'Passwords must match';
			ErrorMessage::displayError($message);
		}
	}

}

if (isset($_POST['ajaxAction'])) {
	if ($_POST['ajaxAction'] == 'followEvent') {
		ManageUser::followEvent($link);

	} else if ($_POST['ajaxAction'] == 'unfollowEvent'){
		ManageUser::unfollowEvent($link);
	}
}
if (isset($_POST['changeProfilePic'])) {
		ManageUser::changeProfilePic($link);
	}
if (isset($_POST['RecoverUser'])) {
		ManageUser::sendPasswordResetEmail($link);
	}	

?>