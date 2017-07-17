<?php
	require_once 'linkDB/connect.php';
	require_once 'linkDB/connectBlog.php';
	require_once 'linkDB/manageUsers.php';
	?>
<html>
<head>
	<?php require_once 'includes/head.php'; ?>
	<title>News</title>
</head>
<body>
	<div class="wrapper no-margin" style="background-color: #0090FF;">
		<img src="img/logo-full-white-large.png" id="quobolLogoLogin">
	</div>
	<div class="wrapper no-margin" style="background-color: #242424; height:50px;">
		<h1 class="no-margin" style="color: #898989; text-align: center; font-size: 30px;padding: 10px;">News</h1>
	</div>

	<?php 
	if (isset($_SESSION['user'])) {
		if ($_SESSION['user'] === 'ActuallyDan') {?>
			<div class="row blogPosts">
		        <div class="col s12">
		          <div class="card bknd-blue">
		            <div class="card-content" style="background-color: white;">
		             <form method="POST">
		             	<input type="text" name="blogPostTitle">
		             	<input type="text" name="blogPostContent">
		             	<input type="submit" name="submitBlogPost">
		             </form>
		            </div>
		            
		          </div>
		        </div>
		      </div>
		<?php }
	}
	?>

	<div id="newsColumn">
	<?php //loop thorugh news and update here
		ConnectBlog::getBlogPosts($link);
	?>
	<style>
	body {
		background-color: #005699;
	}
	</style>
	</div>
</body>
</html>