<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	//this query is only used to display the elements into the textboxes for editing use only
	$sql = "SELECT * FROM blog_posts WHERE id = :id";
	$query = $dbhandle->prepare($sql);
	//the parameter is passed into the URL from the previous page, I want to bind this parameter to the id, datatype string
	$query->bindValue(':id', $_GET['id'] , PDO::PARAM_STR);
	$query->execute();
	//fetch the elements with the id thats passed from previous page to output into the textboxes for editting
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
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
		<h2>Edit a blog</h2>
			<?php
			if(isset($_POST['editTitle'],$_POST['editImage'], $_POST['editContent'])){
			//security measures to escape special characters entered by user input
				$title = $_POST['editTitle'];
				$image = $_POST['editImage'];
				$content = $_POST['editContent'];
				if(empty($title) || empty($image) || empty($content)){
					//unsuccessful edit
					echo '<div class="msg"><strong>Please fill in all the fields.</strong></div>';
				}
				else{
					//successful edit therefore carry out the new query
					$newSql = "UPDATE blog_posts SET Title = '$title',Image = '$image',Content = '$content',Edited = NOW() WHERE id = :id";
					$newQuery = $dbhandle->prepare($newSql);
					
					$search = (isset($_GET['id']) == true) ? $_GET['id'] : '';
					$newQuery->bindValue(':id', $search , PDO::PARAM_STR);
					$newQuery->execute();
					
					echo '<div class="msg"><strong>You have successfully edited your blog.</strong><br>Click <a href="frontEndIndex.php">Here</a> to return to homepage</div>';
				}
			}
			?>
			<!-- image source: http://thecannon1886.files.wordpress.com/2011/09/117811.jpg-->
			<img src="Images/Lcannon.jpg" alt="gunners" width="190px" height="150px" class="left img">
			<img src="Images/Rcannon.jpg" alt="gunners" width="190px" height="150px" class="right img">
			<form action="edit.php?id=<?php echo $_GET['id'];?>" method="POST">
			<fieldset>
			<legend>Blog post form</legend>
				<!-- output into the value of the textboxes for editting-->
				<p><label for="username"> Title: </label><input type="text" name="editTitle" value="<?php foreach($results as $row){echo $row['Title'];} ?>" id="textbox1"/></p>
				<p><label for="username"> Image URL: </label><input type="text" name="editImage" value="<?php foreach($results as $row){echo $row['Image'];} ?>" id="textbox1"/></p>
				<p><label for="username"> Content: </label><textarea rows="9" cols="28" name="editContent" id="textbox1"><?php foreach($results as $row){echo $row['Content'];} ?></textarea></p>
				<p class="submit"><input type="submit" name="edit" value="edit"></p>
			</fieldset>
			</form>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>