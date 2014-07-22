<?php
	session_start();
	include_once('../config.php');
	$link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
?>

<html>
	<head>
		<title>
			SHL - Internet
		</title>

    	<link rel="stylesheet" type="text/css" href="css/logs.css">
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
 		<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
     	<script type="text/javascript" src="../js/jQuery.js"></script>
     	<script src = "js/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
	</head>
	<body>
		<div id = "leftColumn">
			<ul>
				<li><a href = "index.php"><img src = "img/ico_comp.png">My Computer</a></li>
				<li><a href = "processes.php"><img src = "img/ico_procs.png">Processes</a></li>
				<li><a href = "logs.php"><img src = "img/ico_logs.png">Computer Logs</a></li>
				<li><a href = "files.php"><img src = "img/ico_files.png">Files</a></li>
				<li><a href = "internet.php"><img src = "img/ico_world.png">Internet</a></li>
				<li><a href = "slaves.php"><img src = "img/ico_slaves.png">My Slaves</a></li>
			</ul>
		</div>
		<div id = "background">
			<div id = "container">
				<div id = "header">
					<span id = "ipuser"></span>
					<span id = "timedate"></span>
				</div>
				<hr>
				<div id = "title">Connect to the Internet</div>
				<div id = "wrapper">
					<?php
						$user = $_SESSION['user'];
						$result = mysqli_query($link, "SELECT * FROM players WHERE username = '$user'");
						$row = mysqli_fetch_array($result);
						$homepage = $row['homepage']
					?>

					<form method = "GET" action = "<?php echo($_SERVER['PHP_SELF']);?>" method="post" id = "interform">
						<?php
							if(isset($_GET['ip']) && $_GET['ip'] == true){
								echo "<input type=\"text\" name=\"ip\" size=\"60\" value=\"" . $_GET['ip'] . "\">";
							} else {
								echo "<input type=\"text\" name=\"ip\" size=\"60\" value=\"" . $homepage . "\">";
							}
						?>
						<input type="submit" id = "connect" value="Connect">
					</form>

					<div id = "content"></div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	?><script>
		var img = new Image();
		img.src = "backgrounds/default.png";
		document.body.background = img.src;
	</script><?php 

	$user = $_SESSION['user'];
	$pass = $_SESSION['pass'];
	$tz = $_SESSION['tz'];
	$ip = $_SESSION['ip'];

	$timestamp = $_SERVER['REQUEST_TIME'];

	$dtzone = new DateTimeZone($tz);
	$dtime = new DateTime();

	$dtime->setTimestamp($timestamp);
	$dtime->setTimeZone($dtzone);

	$curTime = $dtime->format('g:i A m/d/y');

    $npcQry = "CREATE TABLE IF NOT EXISTS `npcs` (
                    `uid` INT(128) unsigned NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(64) NOT NULL,
                    `ip` VARCHAR(64) NOT NULL,
                    `pass` VARCHAR(16) NOT NULL,
                    PRIMARY KEY(`uid`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	if(!mysqli_query($link, $npcQry)){
		echo mysqli_error($link);
	}

	function randomPassword() { // Courtesy of Neil from StackOverflow
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ";
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }

	    return implode($pass);
	}

	// Lots of NPCS going into the table for the first time here.
	// Prepare for massive copy-pasta.
	// As soon as the game is published this section can be removed.
	// This is to prevent any cheating by skipping NPC riddles, etc.
	// This code also only needs to run once. It's just to prevent MySQL errors for when I drop
	// tables or it's run for the first time.

	//The Hidden Portal//

	$curIP = "30.12.129.47";
	$npcChk = "SELECT * FROM npcs WHERE ip = '$curIP'";
	if(!mysqli_query($link, $npcChk)){
		$newPass = randomPassword();
		mysqli_query($link, "INSERT INTO npcs(name, ip, pass)
		    						VALUES('The Hidden Portal', '$curIP', '$newPass')");
	} else { 
		$npcRes = mysqli_query($link, $npcChk);
		$r = mysqli_fetch_array($npcRes);
	}

	/////////////////////

	// End NPC declarations //
	
	?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
		$("#ip").html("<?php echo $ip; ?><a href='index.php?reset=1'> Reset</a>");
		$("#pass").html("<?php echo $pass; ?><a href='index.php?reset=2'> Reset</a>");
		var socket = io.connect('http://localhost:3000');
	</script><?php

	$targetIP = isset($_GET['ip']) ? $_GET['ip'] : $row['homepage'];
	$usrChk = "SELECT * FROM players
				WHERE ip = '$targetIP'";
	$npcChk = "SELECT * FROM npcs
				WHERE ip = '$targetIP'";
	if(!mysqli_query($link, $npcChk)){		
	} else {
		$npcRes = mysqli_query($link, $npcChk);
		$npcRow = mysqli_fetch_array($npcRes);
	}

	if(!mysqli_query($link, $usrChk)){
	} else {
		$result2 = mysqli_query($link, $usrChk);
		$row2 = mysqli_fetch_array($result2);
	}
	echo $targetIP;
	if(mysqli_query($link, $usrChk) && $row2['username'] != ""){
		?><script>
			$("#content").html("<img src='img/ico_check.png'> You were able to ping this address.");
		</script><?php
	} else if(mysqli_query($link, $npcChk) && $npcRow['name'] != ""){
		?><script>
			$("#content").html("You were able to ping this address.");
			$("#interform").append("<img src='img/ico_check.png'>");
		</script><?php
	} else {
		?><script>
			$("#content").html("Nothing located at this address.");
			$("#interform").append("<img src='img/ico_err.png'>");
		</script><?php
	}
?>