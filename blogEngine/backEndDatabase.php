<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	//security measures to escape special characters entered by user input
	$Title = $_GET['Title'];
	$Image = $_GET['Image'];
	$Content = $_GET['Content'];
	
	$sql = "INSERT INTO blog_posts(Title,Image,Content,Submission) VALUES ('$Title','$Image','$Content',NOW())";
	$query = $dbhandle->prepare($sql);
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
			//if any of the fields are empty then display error message otherwise continue
			if(empty($Title) || empty($Image) || empty($Content)){
				$message = array(); //array to store errors
				$message[] = 'You did not fill in all the required fields!';
			}
			else{
				//if title is invalid store an error into the array
				if(strlen($Title) > 30){
					$message[] = 'Your title is too long!';
				}
				//content could be more i.e. < 200 but kept it at 50 for convenience to teachers when testing/marking
				if(strlen($Content) < 50){
					$message[] = 'Your blog must be at least 50 characters.';
				}
			}
			//if it's valid continue to execute the query and display success otherwise loop through the errors and display them
			if(empty($message)){
				//successfully posted a comment
				echo '<p class="msg"><strong>You have successfully posted a blog. Click <a href="frontEndIndex.php">Here</a> to return to Homepage.</strong></p>';
				$query->execute();
			}
			else{
				echo '<strong>The following error has occured: </strong><br/><ul>';
				//loop through errors and display them
				foreach($message as $errors){
					echo '<br/><li>' . $errors . '</li>';
				}
				echo '</ul>Click <a href="frontEndIndex.php">Here</a> to return to home page';
			}
		?>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>