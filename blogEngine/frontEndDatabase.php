<!DOCTYPE html>
<?php
	session_start();
	
	$dbhandle = new PDO(
		'mysql:host=dragon.kent.ac.uk;dbname=sl375',
		'sl375',
		'ci1nige'
	);
	//security measures to escape special characters entered by user input and also for if html entities are entered into the search textbox
	$Name = $_POST['Name'];
	$Email = $_POST['Email'];
	$Comment = $_POST['Comment'];
	$BP_id = $_POST['BP_id'];
	
	$sql = "INSERT INTO Comments(name,email,comment,BP_id,submitted) VALUES('$Name','$Email','$Comment','$BP_id',NOW())";
	$query = $dbhandle->prepare($sql);
	?>
<html>
	<?php include 'Includes/head.php' ?>
	<body>
		<?php include 'Includes/header.php' ?>
		
		<div id="nav">
			<?php include 'Includes/nav.php'?>
			<!-- A small greeting at the top that welcomes guest users or the site admin.-->
			<?php if (isset($_COOKIE["user"])){
						echo "<div id=\"right\">" . "Welcome " . $_COOKIE["user"] . "! You are logged in." . "<a href=\"logout.php\" id=\"button2\">" . "Log out" . "</a>" . "</div>";
					}else{
						echo "<div id=\"right\">" . "Welcome guest!"  . "</div>";
					}
			?>
		</div>
		<div id="content">
		<h2>Post a comment</h2>
		<?php 
			//if any of the fields are empty then display error message otherwise continue
			if(empty($_POST['Name']) || empty($_POST['Email']) || empty($_POST['Comment'])){
				$message = array(); //array to store errors
				$message[] = 'You did not fill in all the required fields!';
			}
			else{
				//if email is invalid store an error into the array
				if(filter_var($Email, FILTER_VALIDATE_EMAIL) == false){
					$message[] = 'You did not enter a valid Email address.';
				}
				//if name is invalid store an error into the array
				if(is_numeric($Name) || strlen($Name) > 20){
					$message[] = 'You did not enter a valid name';
				}
			}
			//if it's valid continue to execute the query and display success otherwise loop through the errors and display them
			if(empty($message)){
				$query->execute();
				//successfully posted a comment
				echo '<p id="msg">You have successfully posted a comment. Click <a href="frontEndIndex.php">Here</a> to return to Homepage.</p>';
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