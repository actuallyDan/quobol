<?php

?>

<html>
<head>
	<?php  require_once 'includes/head.php'; ?>
	<title>Contact Us</title>

</head>
<body>
	<style type="text/css">
	html { 
  background: url('img/stock1.jpeg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
	</style>
	<?php require_once 'includes/topNav.php'; ?>
	<?php require_once 'includes/sideNav.php'; ?>
	
	<section class="main fullscreenMain">
		<!--all things not sidebar go here-->
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
		
		<!--contact body here-->
		<div class="row" style="margin: 5% 5% 5% 5%;">
			<style type="text/css">
			
html { 
  background: url('img/stock1.jpeg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}			
body{
	background: none;
}
			</style>
			<div class="col s12 m12">
				<div class="card-panel bknd-blue-light" style="opacity:0.9; text-align:center; width: 100%;">
					<span class="white-text">
						<p id="blurb" class="hide-on-med-and-down"> If you need help using Quobol or would like to contact us for any reason, please email <a href="mailto:admin@quobol.com">admin@quobol.com</a>
							<br>
							Quobol News and Announcements can be found on <a href="blog.php"> our Blog </a>
						</p>
						<p id="blurb" class="hide-on-large-only">
							Contact <a href="mailto:admin@quobol.com">admin@quobol.com</a>
							<br>
							News and Announcements <a href="blog.php"> Blog </a>
						</p>
					</span>
				</div>
			</div>
		</div>
		
	</section>


</body>
</html>