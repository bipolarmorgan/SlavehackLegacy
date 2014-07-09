<!-- Credits to Srinivas Tamada Production
	for help with the email verification code.
-->
<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="shortcut icon" href="img/icon.ico" />
    	<script type="text/javascript" src="js/jQuery.js"></script>
    	<title>
    		Activate
    	</title>
	</head>
	<body>
		<div id = "bgMenuBar">
			<div class = "logo">Slavehack: Legacy</div>
			<ul id = "homeMenu">
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="terms.html">Terms of Use</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		</div>
		<div id = "wrapper">
			<div id = "entryBlock">
				<div id="ipLog">
					132.45.86.1@registerHost
					<div id="date"></div>
				</div>
				<div id="container">
					<div id="message">
						<div id="title">
							<b>Activation</b><br /><br />
						</div>
						<div id="error"></div><div id="success"></div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	include 'config.php';
    $link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$msg = '';
	if(!empty($_GET['code']) && isset($_GET['code'])){
		$code = mysqli_real_escape_string($link, $_GET['code']);
		$c=mysqli_query($link, "SELECT uid FROM users WHERE activation = '$code'");

		if(mysqli_num_rows($c) > 0){
				$count = mysqli_query($link, "SELECT uid FROM users WHERE activation = '$code' AND email_confirmed='false'");

				if(mysqli_num_rows($count) == 1){
					if(!mysqli_query($link, "UPDATE users SET email_confirmed='1' WHERE activation='$code'")){
						echo "Error: " . mysqli_error($link);
					}
					?><script>
						$("#success").html("You've successfuly activated your account. You may now log in.");
					</script><?php 
				} else {
					?><script>
						$("#error").html("Your account has already been activated.");
					</script><?php 
				}
		} else {
			?><script>
				$("#error").html("Incorrect activation code.");
			</script><?php 
		}
	}
?>