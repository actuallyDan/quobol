<ul id="slide-out" class="side-nav fixed bknd-blue-dark">
  <li style="margin: 5px 5px 0 0;">
    <?php if (isset($_SESSION['user'])){ 
      echo "
      <a id='loadUserPage' href='user.php?userId=" . $_SESSION['user_id'] . "' class='text-blue-light valign center'>
      <span>
      <img id='myProfilePic' src='" . $_SESSION['profile_pic'] . "' height='40px' width='40px' style='margin-right: 15px;' class='mainSideIcons left circle'></img>
      <p id='currentUser' data-user-id='" . $_SESSION['user_id'] . "'class='left subText truncate'>" . $_SESSION['user'] ."</p>
      </span>
      </a>";
    } else { echo
     "<a href='login.php' class='text-blue-light valign center'>
     <span>
     <i class='material-icons mainSideIcons left'>account_circle</i>  
     <p class='left subText'>Login</p>
     </span>
     </a> ";
   } ?>

 </li>
 <br class="hide-on-large-only">
 <li>
  <a class="text-blue-light modal-trigger valign center hide-on-large-only" href="index.php">
    <span>
      <i class="material-icons mainSideIcons left">home</i>
      <p class="left subText">Home</p>
    </span>
  </a>
</li>
<br>
 
<?php if (isset($_SESSION['user'])) { ?>

   <li>
  <a class="text-blue-light modal-trigger valign center" href="#modal1">
    <span>
      <i class="material-icons mainSideIcons left">add_box</i>
      <p class="left subText">New Quip</p>
    </span>
  </a>
</li>
<br>

<li>
 <!-- displays on desktops for normal inline sidebar Queue-->
 <a id="toggleQueue" class="text-blue-light valign center hide-on-med-and-down">
 <span>
 <i class="material-icons mainSideIcons left">inbox</i>
 <p class="left subText">Queue</p>
 </span>
 </a>
 <!-- displays on smaller screens displays alternate queue for compatability-->
 <a href="queue.php" id="toggleQueueMobile" class="text-blue-light valign center hide-on-large-only">
 <span>
 <i class="material-icons mainSideIcons left">inbox</i>
 <p class="left subText">Queue</p>
 </span>
 </a>
 </li>
 <br>
<!--  <li>
 <a href="settings.php" class="text-blue-light valign center" >
 <span>
 <i class="material-icons mainSideIcons left">perm_identity</i>
 <p class="left subText">Settings</p>
 </span>
 </a>
 </li>
 <br>  -->
<?php } ?>
 <li>
  <a id="loadContact" href="contact.php" class="text-blue-light valign center">
    <span>
      <i class="material-icons mainSideIcons left">contact_mail</i>
      <p class="left subText">Contact</p>
    </span>
  </a>
</li>
<br>
<li>
  <a id="loadBlog" href="blog.php" class="text-blue-light valign center">
    <span>
      <i class="material-icons mainSideIcons left">more</i>
      <p class="left subText">News</p>
    </span>
  </a>
</li>
<br>
<li>
  <a href="support.php" class="text-blue-light valign center">
    <span>
      <i class="material-icons mainSideIcons left">live_help</i>
      <p class="left subText">Support</p>
    </span>
  </a>
</li>
<?php 
if (isset($_SESSION['user'])){
  ?>
  <br>
  <li>
    <a id="logoutButton" class="text-blue-light valign center" href="login.php?action=logout">
      <span>
        <i class="material-icons mainSideIcons left">exit_to_app</i>
        <p class="left subText">Logout</p>
      </span>
    </a>
  </li>
  <?php } ?>

</ul><!--end Main Side Nav-->

<!--start queue (second side Nav)-->
<?php if (isset($_SESSION['user'])) { ?>
<ul id="slide-out2" class="side-nav side-nav-2 fixed bknd-blue-dark" style="display:none;">
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
        <a href="event.php?eventId=<?php echo $row['event_id']; ?>"class="text-blue-light valign-wrapper center">
         <img src="<?php echo $row['image_url']; ?>" height="45px" width="45px" class="queuePreviewIcons left circle"></img>
         <div class="left-align">
          <p class="no-margin subText truncate"><?php echo $row['title']; ?></p>
          <p class=" subSubText truncate"><?php echo $row['description']; ?></p>
        </div>
      </a>
    </li>
    <?php } ?>
  </div>
</div>

</ul>
<?php } ?>
