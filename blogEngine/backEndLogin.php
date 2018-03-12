<!DOCTYPE html>
<?php
	if (!isset($_COOKIE["user"])){
?>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		<div id="nav">
			<?php include 'Includes/nav.php' ?>
		</div>
		<div id="content">
		<h2>Login Page</h2>
			<p class="msg">Please Login to access administrative rights.</p>
		<!--form for users to log in, submits to the page that processes log ins via POST method(backEndLogSubmit)-->
		<form action="backEndLogSubmit.php" method="POST">
		<fieldset>
		<legend>Login form</legend>
				<p><label for="username"> Username: </label><input type="text" name="username" id="textbox" /></p>
				<p><label for="password"> Password: </label><input type="password" name="password" id="textbox" /></p>
				<p class="submit"><input type="submit" name="Login" value="Login"/> </p>
				<p>Not a member? click <a href="register.php">Here</a> to register.</p>
		</fieldset>
		</form>
		<!--Image source http://www.thefa.com/~/media/Images/TheFAPortal/Pillars/fa-competitions/The%20FA%20Cup/Season%202011-12/4RP/arsene-wenger-point.ashx?as=1&db=web&h=349&thn=0&w=620&c=gallery-->
		<img src="Images/wenger.jpg" alt="wenger" width="290px" height="180px" id ="frontImg">
		
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>
<?php
}
else{
	header( 'Location: backEndLogSubmit.php');
	exit();
}
?>