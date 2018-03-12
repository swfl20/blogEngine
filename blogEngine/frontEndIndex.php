<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	/*
		all blog contents referenced from www.arseblog.com
	*/
	//query to display the latest 3 blog posts on the part referenced from class exercise
	$sql = "SELECT * FROM blog_posts ORDER BY Submission DESC LIMIT 3";
	$query = $dbhandle->prepare($sql);
	$query->execute();
	
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		
		<div id="nav">
			<?php include 'Includes/nav.php'?>
			<!-- A small greeting at the top that welcomes guest users or the site admin.-->
			<?php 
				if (isset($_COOKIE["user"])){
					echo "<div id=\"right\">" . "Welcome " . $_COOKIE["user"] . "! You are logged in." . "<a href=\"logout.php\" id=\"button2\">" . "Log out" . "</a>" . "</div>";
				}else{
					echo '<div id="right">' . 'Welcome guest!'  . '</div>';
				}
			?>
		</div>
		<div id="content"><h2>Latest articles</h2>
		<a href="olderBlogs.php" class="olderButton">Show older blogs</a>
		<?php echo 'Displaying latest ' . $query->rowCount() . ' results.'; ?>
			<!--if the user is logged in display the edit buttons otherwise just display the blogs-->
			<?php if (isset($_COOKIE["user"])){
				//loops through the results and displays all the elements 
				foreach($results as $row) {
					echo '<hr/><div id="blog">' . '<a href="frontEndIndivi.php?id=' . $row['id']. '"><h3>' . $row['Title'] . '</h3></a>';
					echo "Submitted on: " . $row['Submission'] . "<br/>";
					echo "Edited on: " . $row['Edited']; ?><br/>
					<img id ="frontImg" width="400" height="300" src="<?php echo $row['Image']; ?>" alt="Blog image"> <br/>
					<?php echo '<p class="this">' . $row['Content'] . '</p>'; ?> <br/>
					<div><a href="delete.php?id=<?php echo $row['id']; ?>" id="button1">Delete</a>
					<a href="edit.php?id=<?php echo $row['id']; ?>" id="button1">Edit</a></div>
					<?php echo '</div>'; ?>
					<hr/>
			<?php } 
			}else{
				//loops through the results and displays all the elements 
				foreach($results as $row) {
					echo '<hr/><div id="blog">' . '<a href="frontEndIndivi.php?id=' . $row['id']. '"><h3>' . $row['Title'] . '</h3></a>';
					echo "Submitted on: " . $row['Submission'] . "<br/>";
					echo "Edited on: " . $row['Edited']; ?><br/>
					<img id="frontImg" width="400" height="300" src="<?php echo $row['Image']; ?>" alt="Blog image"> <br/>
					<?php echo '<p class="this">' . $row['Content'] . '</p></div>'; ?> <br/>
					<hr/>
			<?php }
			}?>
			<a href="olderBlogs.php" class="olderButton">Show older blogs</a>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>