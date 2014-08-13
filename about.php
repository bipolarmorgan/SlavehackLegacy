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
							<b>What is Slavehack: Legacy?</b><br /><br />
						</div>
						Slavehack: Legacy is an online hacking simulation
						game. At no time in this game will you actually hack
						or be hacked, as <u>this is a virtual game
						only</u>. Your computer will not be exposed
						to any exploits or actual software other than
						the cookies used to play the actual game. If at
						any time a game-wide exploit has been found that
						affects real computers, an announcement will be
						made for all users and the servers will be taken
						down.<br /><br />

						When you enter the game you'll be given a very
						mediocre computer. In Slavehack, your task is to
						gather computer slaves who will benefit you through
						different tasks including earning you income to upgrade
						your rig.<br /><br />

						In addition to upgrading your rig, you'll also be
						gathering software such as firewalls, malware,
						adware, spyware, rootkits, trojans,
						and more to help you in your endeavors.<br /><br />

						As you venture the web in search of slaves, you
						must be diligent, however. Each website you visit
						will leave a connection log that a player can
						trace back to your own computer and make you their
						slave. Fear not, becoming a slave computer is not
						the end of the world if you've backed up your
						software.<br /><br />

						So what's the goal of the game? Make it to the top
						of the leaderboards.<br /><br />Good luck!
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

<?php
	$timestamp = $_SERVER['REQUEST_TIME'];

	if(isset($_SESSION['tz'])){
		$tz = $_SESSION['tz'];
	} else {
		$tz = "America/Chicago";
	}

	if(isset($_SESSION['user'])){
		?><script>
			$("#logswitch").html("<a href='logout.php'>Logout</a>");
		</script><?php 
	} else {
		?><script>
			$("#logswitch").html("<a href='login.php'>Login</a>");
		</script><?php 
	}

	$dtzone = new DateTimeZone($tz);
	$dtime = new DateTime();

	$dtime->setTimestamp($timestamp);
	$dtime->setTimeZone($dtzone);
	$time = $dtime->format('g:i A m/d/y');
	?>
    <script>
        $("#date").html('<?php echo $time; ?>');
    </script>
    <?php
?>