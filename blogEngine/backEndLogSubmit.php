<!DOCTYPE html>
<?php
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	//referenced from: co525 practical classes SESSIONS & COOKIES
	$salt = "Salty";
	$secretusername = "AzureDiamond";
	$secretpassword = "ff9d0aeec301ae55e7e5566b8a518af97b25f9fa";
	/* implementing of the extra feature  - register users (Incomplete)
	
	$errors = array();
	
	function exists($username){
		$query = $dbhandle -> prepare("SELECT COUNT['id'] FROM blog_users WHERE username = '$username'");
		$query -> execute();
	}
	
	if (!empty($_POST)){
	
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		if(empty($username)|| empty($password)){
			$errors[] = 'Please enter a username and password';
		}
		else if(exists($username) == false){
			$errors[] = 'You are not a registered member';
		}
		else{
		
		}
	}*/
		
	if(( isset($_POST['username']) == $secretusername ) && ( sha1($salt . $_POST['password']) == $secretpassword)){
		session_start();
		$_SESSION['username'] = $_POST['username'];
		setcookie("user", "AzureDiamond", time()+3600);
	}
	
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
			<?php echo "<div id=\"right\">" . "Welcome " . $_COOKIE['user'] . "! You are logged in." . "<a href=\"logout.php\" id=\"button2\">" . "Log out" . "</a>" . "</div>";?>
		</div>
		<div id="content">
		<h2>Login Page</h2>
			<p class="msg">You are in the members area, you now have administrative rights.</p>
			
		<img src="http://stuartnoel.files.wordpress.com/2012/09/wenger.jpg" alt="wenger" width="270px" height="220px"id ="frontImg">
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