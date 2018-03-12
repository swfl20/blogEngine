<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	$sql = "INSERT INTO blog_users(username,password,registered) VALUES ('$_GET[newUser]','$_GET[newPW]',NOW())";
	$query = $dbhandle->prepare($sql);
	$query->execute();
?>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		
		<div id="nav">
			<?php include 'Includes/nav.php'?>
		</div>
		<div id="content">
		<h2>Register Page</h2>
			<p class="msg">You have successfully registered, you may now log in.</p>
			
		<img src="http://stuartnoel.files.wordpress.com/2012/09/wenger.jpg" alt="wenger" width="270px" height="220px"id ="frontImg">
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>