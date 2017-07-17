  <!-- Modal Structure -->
  <div id="modal2" class="modal">
  	<nav>
  		<div class="nav-wrapper bknd-blue container-fluid">
  			<h1 class="brand-logo center" style="padding-top: 15px; font-size:20px;">Change Profile Picture</h1>
  			<a id="closeNewQuip" class="right text-blue-light modal-close" style="padding-right:15px;"><i class="material-icons">clear</i></a>
  		</div>
  	</nav>  
  	<form id="changeProfilePic" method="POST" enctype="multipart/form-data" >
  	<div class="row" style="margin: 20px;"><!--profile pic preview-->
  		<div class="col s12 m7 l6">
  			<img id="preview_image" class="responsive-img forPreview" src="<?php echo $image; ?>" alt="" />
  		</div>
  		<div class="file-field input-field col s12 m5 l6" style="padding: 20px 10px 10px 10px;">

  			<div class="waves-effect waves-light waves-ripple btn-flat bknd-blue white-text col ">
  				<span>Browse</span>
  				<input type="file" style="text-align:center;" name='useThisPic'>
  			</div>
  			<div class="file-path-wrapper left">
  				<input class="file-path validate"  type="text">
  			</div>
  		</div>

  	</div><!-- end file picker-->
  	<p class="center-align center text-grey"> Select a new profile picture. <br>For best results, we recommend a picture that is at least 150px tall and 150px wide.</p>
  	<br>
  	<div class="row" style="margin: 20px;">
  		<div class="modal-footer col l12" style="text-align:center;">
  			<button id="submitChangeToProfilePic" name="changeProfilePic" class="waves-effect waves-light waves-ripple btn-flat bknd-blue white-text" onclick="changeProfilePic()">Save</button>
  		</div>
  		  	</form>

  	</div>
  

</div>

<script type="text/javascript">
	function changeProfilePic(){
		$('#changeProfilePic').submit();
	}
</script>