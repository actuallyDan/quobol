<?php
require_once 'linkDB/connect.php';
require_once 'linkDB/manageEvents.php';
require_once 'linkDB/manageUsers.php';

if (isset($_GET['userId']) && $_GET['userId'] != '') {
	$userToDisplay = mysqli_real_escape_string($link, $_GET['userId']);
} else {
	header("Location: index.php");
}
$results = ManageUser::showUserPage($link, $userToDisplay);

if (mysqli_num_rows($results) == 0) {
	# user doesn't exist, redirect
	header('Location: index.php');
} else {
	while($row = mysqli_fetch_assoc($results)){
		$username = $row['username'];
		$image = $row['profile_pic'];
		$cover_img = $row['cover_photo'];

	}
	$quirkResults = ManageUser::getQuirk($link, $userToDisplay);
	$numQuips = 0;
	$quirk = 0;
	while ($row = mysqli_fetch_assoc($quirkResults)) {
		$numQuips++;
		$quirk += $row['quirk'];
	}
}
?>

<html>
<head>
	<?php  require_once 'includes/head.php'; ?>
	<title><?php echo $username; ?></title>

</head>
<body>
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
		<div id="content">

				<div class="row" style="margin-left: 10px; margin-right: 10px;">
					<div class="col s12 " style="padding:0;">
						<div class="card small bknd-blue-dark">
							<div class="card-image">
								<img src="<?php echo $cover_img; ?>">
								<span class="card-title">
									<img src="<?php echo $image; ?>" alt="" class="circle left userProfilePic"> <!--grab user img-->

									<?php if (isset($_SESSION['user'])){
										if ($_SESSION['user'] == $username) { ?>
										<a href="#modal2" class="modal-trigger2"><i class="material-icons left" style="position: relative; right: 25px; top: 65px; opacity: .8;">add_a_photo</i></a>
										<?php 
									}
								}?>

								<h1 class="left userProfileName"><?php echo $username; ?></h1>
							</span>
						</div>
						<div class="card-content white-text bknd-blue">
							<span>
								<div class="row">
									<div class="col s5 m5">
										<p class="left userProfileQuipsLabel">Quirk:</p>
										<p class=" userProfileQuipsNumber text-blue-light"><?php echo $quirk ?></p>
									</div>
									<div class="col s5 m5">
										<p class="left userProfileQuipsLabel">Quips: </p>
										<p class=" userProfileQuipsNumber text-blue-light"><?php echo $numQuips ?></p>
									</div>
									<!-- <div class="col s2 m2">
										<a class="secondary-content text-blue-light center" >
											<i id="toggleFollowPerson"
											data-event-id="EdjfR48F"
											class="toggleFollowPerson fa fa-user-plus"></i>
										</a>
									</div> -->
								</div>

							</span>
						</div> <!--end of card content-->
					</div>
				</div>
			</div>
			<ul class="collection with-header" style="margin-left:10px; margin-right: 10px;">

			<!--post history-->
			<?php 
			$sql = "SELECT * FROM events, event_info WHERE events.event_id = event_info.event_id AND events.user_id = '$userToDisplay' ORDER BY events.event_id DESC";
			$results = mysqli_query($link, $sql);

			if (mysqli_num_rows($results) > 0) {

				while ($row = mysqli_fetch_assoc($results)) { ?>
				<a href="event.php?eventId=<?php echo $row['event_id'] ; ?>">
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
			} else { ?>
			<li class="collection-item avatar hoverable">
				<span>
					<p style="padding: 5px 55px 0 15px;" class="quipCellText">This user has not made any quips yet.</p>
				</span>

			</li>
			<?php } ?>
		</ul>
	</div>
</section>
<?php require_once 'includes/newQuip.php'; ?>
<?php require_once 'includes/changeProfilePic.php'; ?>


</body>
</html>