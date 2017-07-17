<?php
require_once 'linkDB/connect.php';
require_once 'linkDB/manageEvents.php';
require_once 'linkDB/manageUsers.php';
require_once 'linkDB/msgHandle.php';

if (trim($_GET['eventId']) == '') {
	header('Location: index.php');
}
$event = mysqli_real_escape_string($link, trim($_GET['eventId']));

$results = EventManage::showEventPage($link, $event);

if (mysqli_num_rows($results) == 0){
//event deosnt exist redirect
	header('Location: index.php');
} else {
	while ($row = mysqli_fetch_assoc($results)) {
		$submitter = $row['username'];
		$submitter_id = $row['user_id'];
		$title = $row['title'];
		$desc = $row['description'];
		$quirk = $row['quirk'];
		$date = $row['e_date'];
		$time = $row['e_time'];
		$image = $row['image_url'];
	}
}


?>

<html>
<head>
	<?php  require_once 'includes/head.php'; ?>
	<title><?php echo $title; ?></title>

</head>
<body onload=>
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
			<div id="eventInfoAndChatWrapper">
				<div>

					<ul class="collection with-header pls-no-border">

						<div class="row">
							<div class="col s12 l12">
								<div class="card bknd-blue-dark">

									<div class="card-content white-text bknd-blue" id="eventInfo">
										<span>
											<!--image title and submitter-->
											<div class="row" style="margin-bottom: 5px;">
												<div class="col l2 m2 s3">
													<div class="card-image">
														<img src="<?php echo $image; ?>" class="circle materialboxed">
													</div>
												</div>
												<div class="col l10 m10 s9">
													<div class="row no-margin">
														<div class="col s12">
															<span class="card-title">
																<h1 class="left eventName"><?php echo $title; ?></h1>
															</span>
														</div>
														<div class="row">
															<div class="col s12">
																<a href="user.php?userId=<?php echo $submitter_id ; ?>" class="text-blue-darker"><?php echo $submitter ?></a>
															</div>
														</div>
													</div>
												</div>
											</div>


											<!--info-->
											<div class="row">
												<div class="col l12 s12">
													<p class="left userProfileQuirkLabel">Info: </p>
													<p class=" userProfileQuirkNumber text-blue-light"><?php echo $desc;?> </p>
												</div>
											</div>	
											<!--date and time-->
											<div class="row">
												<div class="col l6 s6">
													<p class="left userProfileQuirkLabel">Date: </p>
													<p class="userProfileQuirkNumber text-blue-light"><?php echo $date ?></p>
												</div>
												<div class="col l6 s6">
													<p class="left userProfileQuirkLabel">Time: </p>
													<p class="userProfileQuirkNumber text-blue-light"><?php echo $time ?></p>
												</div>
											</div>
											<div class="row no-margin" >
												<div class="col s6 l6">
													<p class="left userProfileQuirkLabel">Quirk: </p>
													<p class="userProfileQuirkNumber text-blue-light"><?php echo $quirk ?></p>
												</div>
												<div class="col s6 l6">
													<?php 
													if (isset($_SESSION['user_id']) == false) {
													//display nothing
													} else {
														$user = $_SESSION['user_id'];
														$sql = "SELECT * FROM sub_user_events WHERE user_id = '$user' AND event_id = '$event'";

														$results = mysqli_query($link, $sql);
														$row = mysqli_fetch_assoc($results);
														if ($row == null) {
														//user has not subbed to event display normal
															$isSub = false;
															?>
															<a class="secondary-content text-blue-light left" >
																<i id="toggleFollowEvent"
																data-event-id="<?php echo $event; ?>"
																data-event-title="<?php echo $title; ?>"
																class="toggleFollowPerson fa fa-plus-square tooltipped" data-position="bottom" data-delay="50" data-tooltip="Subscribe"></i>
															</a>
															<?php } else {
													//user is subbed to event, only allow unsub
																$isSub = true;
																?>
																<a class="secondary-content text-blue-light left" >
																	<i id="toggleFollowEvent"
																	data-event-id="<?php echo $event; ?>"
																	data-event-title="<?php echo $title; ?>"
																	class="toggleFollowPerson fa fa-minus-square text-blue-light tooltipped" data-position="bottom" data-delay="50" data-tooltip="Unsubscribe"></i>
																</a>
																<?php }
															}
															?>				
														</div>
													</div>			
												</span>
											</div> <!--end of card content-->
											<div class="card-action white-text" id="subbedUsers">
												<span>
													<!--show each user subbed to this event-->
													<?php EventManage::getEventSubs($link, $event)?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</ul>
						</div>
						<div id="allThingsEventChat">
							<div id="beginRefreshChat">
								<?php if (isset($_SESSION['user'])){
									if ($isSub == true) { ?>
									<!--chat window here-->
									<div id="chatWindow">
										<ul data-role="listview" id="messageList">
											<!-- <li><span class="username">User123:</span>This is my message.</li> -->
											<?php HandleMessage::getMessages($link, $event); ?>
										</ul>
									</div>
									<div id="eventChatInput">
										<div class="row">
											<div class="col s10">
												<textarea id="messageContent" placeholder="Comment on this quip..." ></textarea>
											</div>
											<div class="col s2">
												<a id="sendMessageButton"><i class="material-icons">send</i></a>
											</div>
										</div>
									</div>
									<?php } else { ?>
									<ul class="collection z-depth-1 hoverable" style="margin-left:10px; margin-right: 10px;">
									<li class="collection-item avatar">
										<a>
											<span>
												<p style="padding: 5px 55px 0 15px;" class="quipCellText center">Add this to your Queue to see what others are saying.</p>
											</span>
										</a>	      
									</li>
								</ul>									<?php }
								} else {?>
								<ul class="collection z-depth-1 hoverable" style="margin-left:10px; margin-right: 10px;">
									<li class="collection-item avatar">
										<a href="login.php">
											<span>
												<p style="padding: 5px 55px 0 15px;" class="quipCellText center">Questions or Comments about this Quip? Login or Register to join the conversation!</p>
											</span>
										</a>	      
									</li>
								</ul>
										<?php } ?>
										<script src="http://cdn.pubnub.com/pubnub-3.4.4.js"></script>
										<script src="js/messenger.js"></script>
									</div>
								</div>
							</div>
						</section>
						<?php require_once 'includes/newQuip.php'; ?>
						<script type="text/javascript">
						$(document).ready(function(){ 
								$('#content').on("scroll", function() {
							    if($(this).scrollTop() > 200) {
							        $("#eventInfo").toggleClass("hidden");
							    } else {
							        //remove the background property so it comes transparent again (defined in your css)
							       $("#eventInfo").toggleClass("hidden");
							    }
							});
						});					
						</script>
					</body>
					</html>