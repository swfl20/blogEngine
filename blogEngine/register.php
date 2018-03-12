<!DOCTYPE html>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<!-- START OF CONTENT -->
		<?php include 'Includes/header.php' ?>
		<div id="nav">
			<?php include 'Includes/nav.php' ?>
		</div>
		<div id="content">
		<h2>Register Page</h2>
			<p class="msg">Please enter your details below to register.</p>
		<form name="regForm" action="registerDatabase.php" method="GET">
				<label for="username"> Username: </label><input type="text" name="newUser" id="textbox" onchange='checkName( this.value );'><br>
				<label for="password">Password:</label><input type="password" name="newPW" id="textbox" onchange='checkPW( this.value );'><br>
				<input type="submit" name="register" value="register"> <br/>
		<img src="http://www.thefa.com/~/media/Images/TheFAPortal/Pillars/fa-competitions/The%20FA%20Cup/Season%202011-12/4RP/arsene-wenger-point.ashx?as=1&db=web&h=349&thn=0&w=620&c=gallery" alt="wenger" width="290px" height="180px" id ="frontImg">
		</form>
		</div>
		<!--end of content-->
		<?php include 'Includes/footer.php' ?>
	</body>
</html>