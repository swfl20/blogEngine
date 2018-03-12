<!DOCTYPE html>
<?php
	if (isset($_COOKIE["user"])){
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
			<!-- form to post a blog-->
			<!-- image source: http://thecannon1886.files.wordpress.com/2011/09/117811.jpg-->
			<img src="Images/Lcannon.jpg" alt="gunners" width="190px" height="150px" class="left img">
			<img src="Images/Rcannon.jpg" alt="gunners" width="190px" height="150px" class="right img">			
			<form action="backEndDatabase.php" method="GET">
			<fieldset>
			<legend>Blog post form</legend>
				<p><label for="username"> Title: </label><input type="text" name="Title" id="textbox1"/></p>
				<p><label for="username"> Image URL: </label><input type="text" name="Image" id="textbox1"/></p>
				<p><label for="username"> Content: </label><textarea id="textbox1" name="Content" rows="9" cols="28"></textarea></p> 
			
				<p class="submit"><input type="submit" name="Post" value="post"></p>
			</fieldset>
			</form>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>
<?php
}
else{
	header( 'Location: backEndLogin.php');
	exit();
}
?>