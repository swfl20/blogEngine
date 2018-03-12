<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	$sql ="SELECT * FROM blog_posts";
	$query = $dbhandle->prepare($sql);
	$query->execute();
	
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
	
if (isset($_COOKIE["user"])){
?>
<html>
	<?php include 'Includes/head.php' ?>
	<a name="Top page"></a>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		
		<div id="nav">
			<?php include 'Includes/nav.php'?>
			<!-- A small greeting at the top that welcomes the site admin.-->
			<?php echo "<div id=\"right\">" . "Welcome " . $_COOKIE["user"] . "! You are logged in." . "<a href=\"logout.php\" id=\"button2\">" . "Log out" . "</a>" . "</div>";?>
		</div>
		<div id="content">
		<h2>List of blogs</h2>
		<!-- image source: http://thecannon1886.files.wordpress.com/2011/09/117811.jpg-->
		<img src="Images/Lcannon.jpg" alt="gunners" width="190px" height="150px" class="left img">
		<img src="Images/Rcannon.jpg" alt="gunners" width="190px" height="150px" class="right img">			
		<fieldset>
		<?php 
			//loop through and show these blogs within the lists
			foreach($results as $row) {
				echo $row['Title'] . '<br/>Date submitted:' . $row['Submission'] . '<br/>'; 
				echo '<a href="delete.php?id=' . $row['id'] . '" id="button1">Delete</a>';
				echo '<a href="edit.php?id=' . $row['id'] . '" id="button1">Edit</a><br/><hr/>';
			}
		?>
		</fieldset>
		<?php
			//rowcount feature
			echo "Displaying " . $query->rowCount() . " blog entries.";
		?>
		</div>
		<!--end of content-->
		Go to <a href="#Top page">top of page</a><br><br>
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