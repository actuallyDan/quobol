<?php 
require_once 'connect.php';

class ConnectBlog{
	public function getBlogPosts($link){
		$sql = "SELECT * FROM blog ORDER BY blog_id DESC";
		$results = mysqli_query($link, $sql);

		while($row = mysqli_fetch_assoc($results)){ 

			$date = strtotime($row['blog_date']);
			$date = date("j F Y", $date); //output will be 10 July 2013
			?>

			<div class="row blogPosts">
		        <div class="col s12">
		          <div class="card bknd-blue">
		            <div class="card-content" style="background-color: white;">
		              <span class="card-title text-blue blogTitle"><?php echo $row['title']; ?></span>
		              <p class="text-grey" style="font-size: 14px;margin-bottom: 10px; text-underline: underline;"><?php echo $date; ?></p>

		              <p class="text-grey"><?php echo $row['blog_content']; ?> </p>
		            </div>
		            
		          </div>
		        </div>
		      </div>
		<?php }
	}
	public function submitBlogPost($link){
		$title = $_POST['blogPostTitle'];
		$content = $_POST['blogPostContent'];
		$sql = "INSERT INTO blog (blog_id, title, blog_date, blog_content) VALUES (NULL, '$title', NOW(), '$content')";
		if (!mysqli_query($link, $sql)) {
			echo "there was an error";
		}
	}
}

if (isset($_POST['submitBlogPost'])){
	ConnectBlog::submitBlogPost($link);
}
?>