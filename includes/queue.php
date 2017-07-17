<?php
require_once 'linkDB/connect.php';
require_once 'linkDB/manageEvents.php';
require_once 'linkDB/manageUsers.php';
require_once 'misc/location.php';
require_once 'linkDB/msgHandle.php';

?>
<html>
<head>
	<?php  require_once 'includes/head.php'; ?>
	<title>Quobol</title>

</head>
<body onload="getLocation()">
	<div id="sections">
		<?php require_once 'includes/topNav.php'; ?>

		<section class="main fullscreenMain">
			<!--all things not sidebar go here-->
			<div id="content">

				<?php if (isset($_SESSION['user'])) { ?>
				<ul class="bknd-blue-dark">
					<!-- new conversation in queue; does not get replaced later-->
					<div style="line-height:49px; padding-left:15px;">
						<a class="text-blue-light valign center" style="padding-top: 4px;">
							<span>
								<i class="material-icons mainSideIcons left" style="font-size:45px;">add</i>
								<p class="left subText">New </p>
							</span>
						</a>
					</div>
					<!--spacer li for queue, must include after each queue item-->
					<li style="height: 5px; border:none; margin: 0; padding: 0; background-color: #005699;" ></li>
					<!--begin queue -->
					<div id="beginQueueRefresher">
						<div id="myQueue">

							<?php $results = ManageUser::getQueue($link);
							while ($row = mysqli_fetch_assoc($results)){
								?>
								<li class="queueItemsFull hoverable">
									<a href="event.php?eventId=<?php echo $row['event_id']; ?>"class="text-blue-light valign-wrapper center loadThisEvent">
										<img src="<?php echo $row['image_url']; ?>" height="45px" width="45px" class="queuePreviewIcons left circle"></img>
										<div class="left-align">
											<p class="no-margin subText truncate"><?php echo $row['title']; ?></p>
											<p class=" subSubText truncate"><?php echo $row['description']; ?></p>
										</div>
									</a>
								</li>

								<li style="height: 4px; border:none; margin: 0; padding: 0; background-color: #005699;" ></li>
								<?php } ?>
							</div>
						</div>

					</ul>
					<?php } ?>
				</div>

			</section>
			<?php require_once 'includes/newQuip.php'; ?>

		</div>
	</body>
	</html>