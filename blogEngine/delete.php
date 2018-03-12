<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	
	$sql = "DELETE FROM blog_posts WHERE id = :id";
	$query = $dbhandle->prepare($sql);
	//the parameter is passed into the URL from the previous page, I want to bind this parameter to the id, datatype string
	$query->bindValue(':id', $_GET['id'] , PDO::PARAM_STR);
	$query->execute();
	?>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		
		<div id="nav">
			<?php include 'Includes/nav.php'?>
			<!-- A small greeting at the top that welcomes the site admin.-->
			<?php echo "<div id=\"right\">" . "Welcome " . $_COOKIE["user"] . "! You are logged in." . "<a href=\"logout.php\" id=\"button2\">" . "Log out" . "</a>" . "</div>";?>
		</div>
		<div id="content">
		<h2>Post a blog</h2>
		<?php
			echo '<p class="msg">You have successfully deleted your blog. Click <a href="frontEndIndex.php">Here</a> to return to Homepage.</p>';
		?>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>