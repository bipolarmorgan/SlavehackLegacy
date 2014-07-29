<?php
	ob_start();
	session_start();
	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"],1);

	$link = mysqli_connect($server, $username, $password);
	mysqli_select_db($link, $db) or die("Cannot connect to database.");
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

					<div id = "result"></div>
					<form method = "GET" action = "<?php echo($_SERVER['PHP_SELF']);?>" id = "interform">
						<?php
							if(isset($_GET['ip']) && $_GET['ip'] == true){
								echo "<input type=\"text\" name=\"ip\" size=\"60\" value=\"" . $_GET['ip'] . "\">";
							} else {
								echo "<input type=\"text\" name=\"ip\" size=\"60\" value=\"" . $homepage . "\">";
							}
						?>
						<input type="submit" id = "connect" value="Connect">
					</form>
					<br />
				</div>
			</div>
		</div>
	</body>
</html>

<?php

    ?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
	</script><?php

	?><script>
		var img = new Image();
		img.src = "backgrounds/default.png";
		document.body.background = img.src;
	</script><?php 
    $npcQry = "CREATE TABLE IF NOT EXISTS `npcs` (
                    `uid` INT(128) unsigned NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(64) NOT NULL,
                    `ip` VARCHAR(64) NOT NULL,
                    `pass` VARCHAR(16) NOT NULL,
                    `content` VARCHAR(512) NOT NULL,
                    `trojan` VARCHAR(32) NOT NULL,
                    `worm` VARCHAR(32) NOT NULL,
                    `adware` VARCHAR(32) NOT NULL,
                    `virus` VARCHAR(32) NOT NULL,
                    `rootkit` VARCHAR(32) NOT NULL,
                    `backdoor` VARCHAR(32) NOT NULL,
                    `keylogger` VARCHAR(32) NOT NULL,
                    `ransomware` VARCHAR(32) NOT NULL,
                    `spyware` VARCHAR(32) NOT NULL,
                    `spamware` VARCHAR(32) NOT NULL,
                    `firewall` VARCHAR(32) NOT NULL,
                    `waterwall` VARCHAR(32) NOT NULL,
                    `trojan_inf` VARCHAR(32) NOT NULL,
                    `worm_inf` VARCHAR(32) NOT NULL,
                    `adware_inf` VARCHAR(32) NOT NULL,
                    `virus_inf` VARCHAR(32) NOT NULL,
                    `rootkit_inf` VARCHAR(32) NOT NULL,
                    `backdoor_inf` VARCHAR(32) NOT NULL,
                    `keylogger_inf` VARCHAR(32) NOT NULL,
                    `ransomware_inf` VARCHAR(32) NOT NULL,
                    `spyware_inf` VARCHAR(32) NOT NULL,
                    `spamware_inf` VARCHAR(32) NOT NULL,
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

    ///////////////////////////

	//The Hidden Portal//

	$curIP = "30.12.129.47";
	$npcChk = "SELECT * FROM npcs WHERE ip = '$curIP'";
	$content = addslashes("<div id = 'content'><b><br />Welcome to The Hidden Portal!</b><br /><br />Check out some of the links below to get started browsing. Or chat with online strangers you will probably never meet using our chat client.<br /><br /><a href='internet.php?ip=1.216.20.96'>FTP Warez</a><br /><br /><a href='internet.php?ip=5.195.112.80'>Free Chat Online</a><br /><br /><a href='internet.php?ip=19.38.42.12'>U-Choose Banking</a><br /><br /><a href='internet.php?ip=101.49.37.86'>My Money My Bank</a></div>");
	if(!mysqli_query($link, $npcChk)){
		$newPass = randomPassword();
		if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content)
		    						VALUES('The Hidden Portal', '$curIP', '$newPass', '$content')")){
			echo mysqli_error($link);
		}
	} else { 
		$npcRes = mysqli_query($link, $npcChk);
		$r = mysqli_fetch_array($npcRes);
		if($r['name'] == ""){
			$newPass = randomPassword();
			if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content)
			    						VALUES('The Hidden Portal', '$curIP', '$newPass', '$content')")){
				echo mysqli_error($link);
			}			
		}
	}

	//Free Chat Online//
	$curIP = "5.195.112.80";
	$npcChk = "SELECT * FROM npcs WHERE ip = '$curIP'";
	$user = $_SESSION['user'];																																																																																																					
	$content = addslashes("<div id='content'><b>Welcome to Free Chat Online!</b><br />The best chat program out there!<div class='chat_wrapper' style='display: block'><div id = 'messages'></div><form id='chatmessage'><input type='text' name='name' id='name' value='' style='width: 20%' readonly><input id='m' name = 'm' placeholder='Message' style='width:60%' autocomplete='off'></form><input type='button' id='msg' value='Send'></div>");
	if(!mysqli_query($link, $npcChk)){																																																																																																										
		$newPass = randomPassword();
		if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content)
		    						VALUES('Free Chat Online', '$curIP', '$newPass', '$content')")){
			echo mysqli_error($link);
		}
	} else { 
		$npcRes = mysqli_query($link, $npcChk);
		$r = mysqli_fetch_array($npcRes);
		if($r['name'] == ""){
			$newPass = randomPassword();
			if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content)
			    						VALUES('Free Chat Online', '$curIP', '$newPass', '$content')")){
				echo mysqli_error($link);
			}			
		}
	}	

	//Free Warez Online//
	$curIP = "1.216.20.96";
	$npcChk = "SELECT * FROM npcs WHERE ip = '$curIP'";
	$user = $_SESSION['user'];
	if(!mysqli_query($link, $npcChk)){																																																																																																										
		$newPass = randomPassword();
		$content = addslashes("<div id='content'><b>Hey there script kiddie.</b>Need some warez?<br /><br />Then hop into our server. The password is " . $newPass . "</div>");
		if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content, trojan, spamware, firewall, waterwall)
			    					VALUES('Free Warez Online', '$curIP', '$newPass', '$content', '0.1', '0.1', '0.1', '0.1')")){
			echo mysqli_error($link);
		}	
	} else { 
		$npcRes = mysqli_query($link, $npcChk);
		$r = mysqli_fetch_array($npcRes);
		if($r['name'] == ""){
			$newPass = randomPassword();
			$content = addslashes("<div id='content'><br /><b>Hey there script kiddie.</b>Need some warez?<br /><br />Then hop into our server. The password is " . $newPass . "</div>");
			if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content, trojan, spamware, firewall, waterwall)
			    						VALUES('Free Warez Online', '$curIP', '$newPass', '$content', '0.1', '0.1', '0.1', '0.1')")){
				echo mysqli_error($link);
			}			
		}
	}	

	/////////////////////

	// End NPC declarations //

	$targetIP = isset($_GET['ip']) ? $_GET['ip'] : $row['homepage'];
	$usrChk = "SELECT * FROM players
				WHERE ip = '$targetIP'";
	$npcChk = "SELECT * FROM npcs
				WHERE ip = '$targetIP'";
	$grabContent = "false";
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
	if(mysqli_query($link, $usrChk) && $row2['username'] != ""){
		?><script>
			$("#result").html("<img src='img/ico_check.png'> You were able to ping this address. <a href='http://slavehack-legacy.herokuapp.com/game/internet.php?ip=<?php echo($targetIP); ?>&hack=0><img src='img/ico_key.png'></a>");
		</script><?php
	} else if(mysqli_query($link, $npcChk) && $npcRow['name'] != ""){
		?><script>
			$("#result").html("<img src='img/ico_check.png'> You were able to ping this address. <a href='http://slavehack-legacy.herokuapp.com/game/internet.php?ip=<?php echo($targetIP); ?>&hack=0><img src='img/ico_key.png'></a>");
		</script><?php
		$grabContent = "true";
	} else {
		?><script>
			$("#result").html("<img src='img/ico_err.png'> Nothing located at this address.");
		</script><?php
	}

	//Massive W.I.P. for phasing out Socket.IO and Node.JS to simplify
	//game's stack. Instead of using Node.JS and Socket.IO,
	//the game will now use the Prototype.js framework to handle
	//realtime messaging.

	if($npcRow['ip'] == "5.195.112.80"){

		$dropQry = "DROP TABLE IF EXISTS fcomessages";
		mysqli_query($link);
		$messagesTblQry = "CREATE TABLE `fcomessages` (
							message_id INTEGER NOT NULL AUTO_INCREMENT,
							username VARCHAR(255) NOT NULL,
							message TEXT,
							PRIMARY KEY ( message_id )
						   )";
		if(!mysqli_query($messagesTblQry)){
			echo mysqli_error($link);
		}
		$user = $_SESSION['user']
		?><script>
		</script><?php
	}

	if($grabContent == "true"){
		$contentQry = "SELECT * FROM npcs
						WHERE ip = '$targetIP'";
		$contentRes = mysqli_query($link, $contentQry);
		$contentRow = mysqli_fetch_array($contentRes);
		?><script>
			$("#wrapper").append("<?php echo(stripslashes($contentRow['content'])); ?>");
		</script><?php
	} else { }
?>