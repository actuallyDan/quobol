<?php
	require_once 'linkDB/connect.php';
	require_once 'linkDB/manageUsers.php';

	$hashedToRecover = mysqli_real_escape_string($link, $_GET['h']);
	$emailToRecover = mysqli_real_escape_string($link, $_GET['u']);

	if (sha1($emailToRecover) == $hashedToRecover) {
		//reset is valid
		if (isset($_POST['resetPassword'])) {
			ManageUser::resetPassword($link, $emailToRecover);
		}
	} else {
		header('Location: index.php');
	}
?>

<html>
<head>
	<?php require_once 'includes/head.php'; ?>
	<title>Password Reset</title>
</head>
<body>
	<style>
	input {
		color: white;
	}
	body {
		background-color: #005699;
	}
	</style>
	<div class="wrapper no-margin" style="background-color: #0090FF;">
		<img src="img/logo-full-white-large.png" id="quobolLogoLogin">
	</div>
	<div class="wrapper no-margin" style="background-color: #242424; height:70px;">
		<p class="no-margin" style="color: #898989; text-align: center; font-size: 16px;padding: 10px;">Enter a New Password</p>
	</div>
	<div class="center loginCard">
		<div class="row">
			<div class="col s12 m10">
				<div class="card-panel bknd-blue-light z-depth-2" style="opacity: 0.9;">
	<div id="resetPassword" class="card-content">
					<div class="row">
						<form class="col s12" method="POST">

							<div class="row">

								<div class="input-field col s12">
									<input name="newPass" id="newPass" type="password" class="validate" required>
									<label for="email">Password</label>
								</div>
							</div>
							<div class="row">

								<div class="input-field col s12">
									<input name="newPassConfirm" id="newPassConfirm" type="password" class="validate" required>
									<label for="email">Confirm Password</label>
								</div>
							</div>

							<input id="resetButton" name="resetPassword" type="submit" value="Change Password" class="btn bknd-blue waves-effect waves-light waves-ripple" style="padding-top:9px;">
						</form>
					</div>
				</div><!-- end of register form-->
			</div>
		</div>
	</div>
</div>
</body>
</html>