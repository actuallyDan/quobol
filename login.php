<?php
	require_once 'linkDB/connect.php';
	require_once 'linkDB/manageUsers.php';

	if (isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}
	
	if (isset($_POST['LoginUser'])) {
		ManageUser::loginUser($link);

	} else if (isset($_POST['RegisterUser'])){
		ManageUser::registerUser($link);
	} else if (isset($_POST['RecoverUser'])){
		//code for recovering password
	} 
	if (isset($_GET['action']) && ($_GET['action'] == 'logout')) {
		ManageUser::logoutUser();
	}

?>

<html>
<head>
	<?php require_once 'includes/head.php'; ?>
	<title>Login | Register</title>
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
	<div class="wrapper no-margin" style="background-color: #242424; min-height:70px;">
		<p class="no-margin" style="color: #edf0f8; text-align: center; font-size: 16px;padding: 10px;"> Create a free account to add your own quips. <br> Already registered? Login below.</p>
	</div>

	<div class="center loginCard">
		<div class="row">
			<div class="col s12 m10">
				<div class="card-panel bknd-blue-light z-depth-2">
					<div class="row"> 
						<a id="showLoginForm" class="col s6 white-text">Login</a>
						<a id="showRegisterForm" class="col s6 white-text">Register</a>
					</div>	
					<!--Register Form, hidden by default, becomes visible when clicking showRegisterForm tab at top-->
					<div id="loginForm" class="card-content">
						<div class="row">
							<form class="col s12" method="POST">

								<div class="row">
									<div class="input-field col s12">
										<input name="LoginUsername" id="username" type="text" class="validate" required>
										<label for="username">Username</label>
									</div>
								</div>

								<div class="row">
									<div class="input-field col s12">
										<input name="LoginPassword" id="password" type="password" class="validate" required>
										<label for="password">Password</label>
									</div>
								</div>
								<!--check to stay logged in-->
								<div class="row">
									<div class="input-field col s12">
									      <input type="checkbox" id="stayLoggedIn" name="stayLoggedIn"/>
									      <label for="stayLoggedIn">Keep me Logged in</label>
									</div>
								</div>

								<input id="loginUser" name="LoginUser" type="submit" value="Login" class="btn bknd-blue waves-effect waves-light waves-ripple fix-link" style="padding-top:9px; line-height: 14px;" />

							</form>
						</div>
					</form>
				</div><!-- end of login form-->
				<!--Register Form, hidden by default, becomes visible when clicking showRegisterForm tab at top-->
				<div id="registerForm" class="card-content">
					<div class="row">
						<form class="col s12" method="POST">

							<div class="row">
								<div class="input-field col s12">
									<input name="SignUpUsername" id="username" type="text" class="validate" required>
									<label for="username">Username</label>
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input name="SignUpPassword" id="password" type="password" class="validate" required>
									<label for="password">Password</label>
								</div>
							</div>

							<div class="row">
								<div class="input-field col s12">
									<input name="SignUpEmail" id="email" type="email" class="validate" required>
									<label for="email">Email</label>
								</div>
							</div>

							<input id="registerUser" type="submit" name="RegisterUser" value="Register" class="btn bknd-blue waves-effect waves-light waves-ripple fix-link" style="padding-top:9px;">
						</form>
					</div>
				</div><!-- end of register form-->
				<!--Forgotten Password Form, hidden by default, becomes visible when clicking forgotPassword tab at bottom-->
				<div id="forgotPassword" class="card-content">
					<div class="row">
						<form class="col s12" method="POST">

							<div class="row">
								<p class="white-text">Please enter your email address below to recover your account.  You should receive an email shortly with directions to recover your account and change your password.</p>

								<div class="input-field col s12">
									<input name="emailForReset" id="email" type="email" class="validate" required>
									<label for="email">Email</label>
								</div>
							</div>

							<input id="recoverUser" name="RecoverUser" type="submit" value="Recover Account" class="btn bknd-blue waves-effect waves-light waves-ripple fix-link" style="padding-top:9px;">
						</form>
					</div>
				</div><!-- end of register form-->
				<a id="showForgotPassword" class="text-blue-darker"> Forgot Password?</a>
		</div>
	</div>
</div>
</div>
</div>

</body>
</html>