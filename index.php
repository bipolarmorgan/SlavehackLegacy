<!--
    Copyright (C) "Slavehack: Legacy" 2014

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<?php
	session_start();
?>

<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
	    <link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="shortcut icon" href="img/icon.ico" />
    	<script type="text/javascript" src="js/jQuery.js"></script>
		<title>
			Slavehack: Legacy
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
					127.0.0.1@localhost
					<div id="date"></div>
				</div>
				<div id="container">
					<div id="message">
						<div id="title">
							<b>Welcome to Slavehack: Legacy</b><br /><br />
						</div>
						Slavehack: Legacy is the open-source continuation
						of the original franchise: Slavehack.<br /><br />
						Slavehack: Legacy is a game about virtual hacking
						wherein you must conquer your opponents through
						breaking into their virtual computer and turning
						them into a "slave", or a computer infected that
						now will do your bidding. Be careful though, as
						others are looking to do the same to you.<br /><br />
						For more information on Slavehack: Legacy, visit
						the <a href="about.php">about page.</a>
					</div>
				</div>
			</div>
			<div id = "footer">
				Copyright (C) "Slavehack: Legacy" 2014 -
				An open-source project founded by Trizzle, developed by WitheredGryphon
			</div>
		</div>
	</body>
</html>

<?php
	$timestamp = $_SERVER['REQUEST_TIME'];
	date_default_timezone_set('UTC');

	$tz = "America/Chicago";

	if(isset($_SESSION['tz'])){
		$tz = $_SESSION['tz'];
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