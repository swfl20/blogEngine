<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	$sql = "SELECT * FROM blog_posts WHERE id = :id";
	$query = $dbhandle->prepare($sql);
	//the parameter is passed into the URL from the previous page, I want to bind this parameter to the id, datatype string
	$query->bindValue(':id', $_GET['id'] , PDO::PARAM_STR);
	$query->execute();
	//fetch the elements with the id thats passed from previous page
	$results = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<html>
	<?php include 'Includes/head.php' ?>
	<a name="Top page"></a>
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
		<div id="content">
		<?php 
			foreach($results as $row) {
				//display all the elements when looping through
				echo '<div id="blog"><h3>' . $row['Title'] . '</h3>';
				echo "Submitted on " . $row['Submission'] . "." ."<br/><br/>";?>
				<img id="frontImg" width="400" height="300" src="<?php echo $row['Image']; ?>" alt="Blog image"> <br/>
				<?php echo '<p class="this">'. $row['Content'] . '</p><br/></div>';
			} ?>
			<hr />
			<h2>Comments</h2>
			<?php
				//query to look through all the foreign id's that is the same as what's passed in the URL parameter :id 
				$anotherSql = "SELECT * FROM Comments WHERE BP_id = :id";
				$query = $dbhandle->prepare($anotherSql);
				$search = (isset($_GET['id']) == true) ? $_GET['id'] : '';
				$query->bindValue(':id', $search , PDO::PARAM_STR);
				$query->execute();
	
				$new = $query->fetchAll(PDO::FETCH_ASSOC);
				//loop through the query that's been fetched and display all the elements 
				foreach($new as $row) {
					echo '<hr /><div class="white"><img class="left " src="Images/avatar.jpg" width="50px" height="50px">';
					echo '<div><strong>' . $row['name'] . ' says: </strong><br>';
					echo $row['comment'] . '</div>';
					echo '<div class="right">Submitted: ' . $row['submitted'] . '</div>' . '<br></div>' . '<hr />';
				}
			?>
			<hr/>
			<h2>Post a comment</h2>
			<!-- form to post a comment (hidden input to post the foreign id)-->
			<form action="frontEndDatabase.php" method="POST">
			<fieldset>
			<legend>Post a comment</legend>
				<p><label for="name"> Name: </label><input type="text" name="Name" id="textbox1"/><p>
				<p><label for="email"> Email: </label><input type="text" name="Email" id="textbox1"/><p>
				<p><label for="comment"> Comment: </label><textarea rows="9" cols="28" name="Comment" id="textbox1"></textarea><p>
				<p><input type="hidden" name="BP_id" value="<?php echo $_GET['id']; ?>"/></p> 
				<p class="submit"><input type="submit" value="comment"></p>
			</fieldset>
			</form>
		</div>
		<!--end of content-->
		Go to <a href="#Top page">top of page</a><br><br>
		<?php include 'Includes/footer.php' ?>
	</body>
</html>