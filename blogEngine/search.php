<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);

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
		<div id="content">
		<h2>Search for blogs</h2>
		<!-- Search function extra feature-->
		<form action="search.php?id=<?php echo $_GET['id'];?>" method="POST">Search: <input type="text" id="textbox1" name="search"/>&nbsp;<input type="submit" name="search" value="search" /></form>
		<br />
		<hr />
		<?php
			if(isset($_POST['search'])){
				//security measures to escape special characters entered by user input and also for if html entities are entered into the search textbox
				$search = mysql_real_escape_string(htmlentities(trim($_POST['search']))); // trim function to ignore whitespace
					//left function referenced from: http://www.w3resource.com/mysql/string-functions/mysql-left-function.php
				$sql =("SELECT Title, LEFT('Content', 80) as 'Content' FROM blog_posts WHERE Content LIKE '%$_GET[search]%' OR Title LIKE '%$_GET[search]%'");
				$query = $dbhandle->prepare($sql);
				//if the field is empty then display error message
				if(empty($search)){
					echo 'You need to enter a search term.';
				}
				else{
					
					$query->execute();
					$results = $query->fetchAll(PDO::FETCH_ASSOC);
					
					echo 'Your search returned ' . $query->rowCount() . ' results<br/><br/>';
					foreach($results as $row){
						echo $row['Title'] . '<br/>';
						echo $row['Content'] . '<br/><hr/>';
					}
				}
			}
		?>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>