<?php
	session_start();
?>

<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
	    <script type="text/javascript" src="js/jQuery.js"></script>
		<link rel="shortcut icon" href="img/icon.ico" />
	    <link rel="stylesheet" type="text/css" href="css/main.css">
		<title>
			About
		</title>
	</head>
	<body>
		<div id = "bgMenuBar">
			<div class = "logo">Slavehack: Legacy</div>
			<ul id = "homeMenu">
				<li><a href="index.php">Home</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="terms.html">Terms of Use</a></li>
				<li><span id = "logswitch"></span></li>
			</ul>
		</div>

		<div id = "wrapper">
			<div id = "entryBlock">
				<div id="ipLog">
					127.0.0.1@localhost
					<div id="date"></div>
				</div>
				<div id="container">
					<div id="message">
						<div id="title">
							<b>Placeholder Title</b><br /><br />
						</div>
						News goes here.
					</div>
				</div>
			</div>
		</div>

		<div id = "footer">
			Copyright (C) "Slavehack: Legacy" 2014 -
			An open-source project founded by Trizzle, developed by WitheredGryphon
		</div>
	</body>
</html>