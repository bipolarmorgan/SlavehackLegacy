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

	$isNPC = "false";
	$isPly = "false";
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
     	<script type="text/javascript" src="js/termlib/termlib.js"></script>

        <?php clock_head() ?>

	</head>
	<body onload="startTime()">

        <!-- Should there be a Capta check here? -->

        <?php side_menu() ?>

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

					<div id="terminal1" style="position:absolute; visibility: hidden; z-index:1" class="termHidden"><table class="termOuterChrome" onmouseup="termBringToFront(1)" cellpadding="1" cellspacing="0"><tr><td>
						<tr><td class="termHeaderActive" onmousedown="dragTerm(1); return false" id="termHeader1">Pulsar Terminal</td></tr>
						<tr><td class="termMenuPane"><a href="javascript:termClose(1)" onfocus="if(this.blur)this.blur();" class="termMenu">Close</a><a href="javascript:termConfigure(1)" onfocus="if(this.blur)this.blur();" class="termMenu">Settings</a></td></tr>
						<tr><td class="termBody"><div id="termDiv1" style="position:relative; background-color:#000000;"></div></td></tr></td></tr>
					</table></div>

					<div id="settingsdialog" style="position:absolute; visibility: hidden; z-index:3" class="termHidden"><table class="termOuterChrome" cellpadding="1" cellspacing="0"><tr><td><table class="termInnerChrome" cellpadding="0" cellspacing="0" width="300">
						<tr><td align="center" class="termMenuPane">
							<table border="0" cellspacing="0" cellpadding="4" width="260">
							<tr><td align="center" class="settings">Terminal Settings</td></tr>
							<form name="settingvalues" onsubmit="return false">
							<tr><td class="settings">&nbsp;<br><b>Size</b></td></tr>
							<tr><td><table border="0" cellspacing="0" cellpadding="2">
								<tr valign="middle"><td class="settings">Rows:</td><td><input name="rows" type="text" value="" size="4" class="settings"></tr>
								<tr valign="middle"><td class="settings">Cols:</td><td><input name="cols" type="text" value="" size="4" class="settings"></tr>
							</table></td></tr>
							<tr><td class="settings">&nbsp;<br><b>Color</b></td></tr>
							<tr><td><table border="0" cellspacing="0" cellpadding="2">
								<tr valign="middle"><td><input type="radio" name="color" value="1"></td><td class="settings"><a href="javascript:settingsSetColor(1)" onfocus="if (this.blur) this.blur();" class="settingsLabel">green on black</a></td></tr>
								<tr valign="middle"><td><input type="radio" name="color" value="2"></td><td class="settings"><a href="javascript:settingsSetColor(2)" onfocus="if (this.blur) this.blur();" class="settingsLabel">white on black</a></td></tr>
								<tr valign="middle"><td><input type="radio" name="color" value="3"></td><td class="settings"><a href="javascript:settingsSetColor(3)" onfocus="if (this.blur) this.blur();" class="settingsLabel">black on white</a></td></tr>
								<tr valign="middle"><td><input type="radio" name="color" value="4"></td><td class="settings"><a href="javascript:settingsSetColor(4)" onfocus="if (this.blur) this.blur();" class="settingsLabel">black on green</a></td></tr>
							</table></td></tr>
							</form>
							<tr><td class="settings" align="right" nowrap>&nbsp;<br><a href="javascript:closeSettings(0)" onfocus="if(this.blur)this.blur();" class="uiButton">Cancel</a>&nbsp;<a href="javascript:closeSettings(1)" onfocus="if(this.blur)this.blur();" class="uiButton">Configure</a><br>&nbsp;</td></tr>
							</table>
					</table></td></tr>
					</table></div>
			</div>
		</div>
	</body>
</html>

<?php

    ?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
	</script><?php

    user_bg(); // Moved bg determination script to game_page_parts.php

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

	function cryptPassword( $pass ) {
		$newPass = hash('crc32', $pass);
		return $newPass;
	}

	// Lots of NPCS going into the table for the first time here.
	// Prepare for massive copy-pasta.
	// As soon as the game is published this section can be removed.
	// This is to prevent any cheating by skipping NPC riddles, etc.
	// This code also only needs to run once. It's just to prevent MySQL errors for when I drop
	// tables or it's run for the first time.

    ///////////////////////////

	//The Hidden Portal//

	$curIP = "1.1.1.1";
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
		$content = addslashes("<div id='content'><br /><b>Hey there script kiddie.</b><br /><br />Need some warez?<br />Then hop into our server. The password is " . $newPass . "</div>");
		if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content, trojan, spamware, firewall, waterwall)
			    					VALUES('Free Warez Online', '$curIP', '$newPass', '$content', '0.1', '0.1', '0.1', '0.1')")){
			echo mysqli_error($link);
		}	
	} else { 
		$npcRes = mysqli_query($link, $npcChk);
		$r = mysqli_fetch_array($npcRes);
		if($r['name'] == ""){
			$newPass = randomPassword();
			$content = addslashes("<div id='content'><br /><b>Hey there script kiddie.</b><br /><br />Need some warez?<br />Then hop into our server. The password is " . $newPass . "</div>");
			if(!mysqli_query($link, "INSERT INTO npcs(name, ip, pass, content, trojan, spamware, firewall, waterwall)
			    						VALUES('Free Warez Online', '$curIP', '$newPass', '$content', '0.1', '0.1', '0.1', '0.1')")){
				echo mysqli_error($link);
			}			
		}
	}	

	/////////////////////

	// End NPC declarations //

	$targetIP = isset($_GET['ip']) ? mysqli_real_escape_string($link,$_GET['ip']) : mysqli_real_escape_string($link,$row['homepage']);
	$usrChk = "SELECT * FROM players
				WHERE ip = '$targetIP'";
	$npcChk = "SELECT * FROM npcs
				WHERE ip = '$targetIP'";
	$grabContent = "false";
	$confirmIP = "false";

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
			$("#result").html("<img src='img/ico_check.png'> You were able to ping this address. <a href='javascript:termOpen(1)' onfocus='if(this.blur)this.blur();' onmouseover=\"window.status='terminal 1'; return true\" onmouseout=\"window.status=''; return true\" class=\"termopen\"><img src='img/ico_key.png'></a>");
		</script><?php
		$confirmIP = "true";
		$grabContent = "true";
		$getTgtPlyQry = "SELECT * FROM players WHERE ip = '$targetIP'";
		$result = mysqli_query($link, $getTgtPlyQry);
		$row = mysqli_fetch_array($result);
		$pass = $row['comp_pass'];
		$chaPass = cryptPassword($pass);
		$fwLevel = $row['firewall'];
		$getPlyQry = "SELECT * FROM players WHERE username = '$user'";
		$result = mysqli_query($link, $getPlyQry);
		$row = mysqli_fetch_array($result);
		$wwLevel = $row['waterwall'];
		$decryptFlag = "false";
		$isPly = "true";
		if($wwLevel >= $fwLevel){
			$decryptFlag = "true";
		}
	} else if(mysqli_query($link, $npcChk) && $npcRow['name'] != ""){
		?><script>
			$("#result").html("<img src='img/ico_check.png'> You were able to ping this address. <a href='javascript:termOpen(1)' onfocus='if(this.blur)this.blur();' onmouseover=\"window.status='terminal 1'; return true\" onmouseout=\"window.status=''; return true\" class=\"termopen\"><img src='img/ico_key.png'></a>");
		</script><?php
		$grabContent = "true";
		$confirmIP = "true";
		$getNPCQry = "SELECT * FROM npcs WHERE ip = '$targetIP'";
		$result = mysqli_query($link, $getNPCQry);
		$row = mysqli_fetch_array($result);
		$pass = $row['pass'];
		$chaPass = cryptPassword($pass);
		$fwLevel = $row['firewall'];
		$user = $_SESSION['user'];
		$getPlyQry = "SELECT * FROM players WHERE username = '$user'";
		if(!mysqli_query($link, $getPlyQry)){
			echo mysqli_error($link);
		} else {
			$result = mysqli_query($link, $getPlyQry);
		}
		$row = mysqli_fetch_array($result);
		$wwLevel = $row['waterwall'];
		$decryptFlag = "false";
		$isNPC = "true";
		if($wwLevel >= $fwLevel){
			$decryptFlag = "true";
		}
	} else {
		?><script>
			$("#result").html("<img src='img/ico_err.png'> Nothing located at this address.");
		</script><?php
	}

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

	// TermLib stuff //

	?><script>
		var term = new Array();
		var loginFlag = false;

		function termOpen(n) {
			if (termToSet) return; // do not open while there is modal dialog
			n = parseInt(n);
			if ((!n) || (isNaN(n))) n = 1;
			var termid = 'terminal'+n;
			if (!term[n]) {
				term[n] = new Terminal(
					{
						x: 0,
						y: 0,
						id: n,
						termDiv: 'termDiv'+n,
						frameWidth: 1,
						frameColor: '#aaaaaa',
						bgColor: '#000000',
						greeting: 'Terminal ready.',
						handler: termHandler,
						exitHandler: termChromeHide
					}
				);
				term[n].colorsetting=1;
				if (term[n]) {
					termChromeShow(n);
					term[n].open();
				}
			}
			else if (term[n].closed) {
				termSetChromeState(n, true);
				termChromeShow(n);
				term[n].open();
			}
			else {
				termSetChromeState(n, true);
			}
			termBringToFront(n);
		}

		function termHandler() {
			this.newLine();
			var line = this.lineBuffer;
			if (line != '') {
				if (line == 'exit') this.close()
				//else this.type('You typed: '+line);
				else if (line == 'help') {
					this.type('For info on a specific command, type: help [COMMAND].');
					this.newLine();
					this.type('bin2hex       [STRING]    Converts a binary string to hexadecimal.');
					this.newLine();
					this.type('hex2bin       [STRING]    Converts a hexadecimal string to binary.');
					this.newLine();
					this.type('pulse                     Dumps encrypted data containing a password.');
					this.newLine();
					this.type('base64_decode [STRING]    Decodes a string encoded with MIME base64.');
					this.newLine();
					this.type('mutilate      [STRING]    Uses WaterWall software to crack CHA-encryption.');
					this.newLine();
					this.type('exit                      Exits the terminal.');
					this.newLine();
					this.newLine();
				}
				else if (line.substr(0, 7) == "bin2hex"){
					if (line.substr(7, 8) != " "){
						if (!line.substr(7,8)){
							this.type("Error, parameter [STRING] required.");
							this.newLine();
						} else {
							this.type("Error, unrecognized command: " + line);
							this.newLine();
						}
					} else {
						this.type("bin2hex command detected.");
						this.newLine();
					}
				}
				else if (line.substr(0, 7) == "hex2bin"){
					if (line.substr(7, 8) != " "){
						if (!line.substr(7,8)){
							this.type("Error, parameter [STRING] required.");
							this.newLine();
						} else {
							this.type("Error, unrecognized command: " + line);
							this.newLine();
						}
					} else {
						this.type("hex2bin command detected.");
						this.newLine();
					}
				}
				else if (line.substr(0, 5) == "pulse"){
					if (!line.substr(5, 6) && line.substr(5,6) != " "){
						if("<?php echo($isPly); ?>" == "true"){
							this.type("Extracting CHA-encrypted data.");
							this.newLine();
							var pass = "<?php echo($chaPass); ?>";
							this.type("Done.");
							this.newLine();
							this.type("Extracted CHA-encrypted password: " + pass);
						}
						else if("<?php echo($isNPC); ?>" == "true"){
							this.type("Extracting CHA-encrypted data.");
							this.newLine();
							var pass = "<?php echo($chaPass); ?>";
							this.type("Done.");
							this.newLine();
							this.type("Extracted CHA-encrypted password: " + pass);
						}
						else {
							this.type("If you are seeing this report it immediately.");
							this.newLine();
						}		
					} else {
						this.type("Error, unrecognized command: " + line);
						this.newLine();
					}
				}
				else if (line.substr(0, 13) == "base64_decode"){
					if (line.substr(13, 14) != " "){
						if (!line.substr(13,14)){
							this.type("Error, parameter [STRING] required.");
							this.newLine();
						} else {
							this.type("Error, unrecognized command: " + line);
							this.newLine();
						}
					} else {
						this.type("base64_decode command detected.");
						this.newLine();
					}
				}
				else if (line.substr(0, 8) == "mutilate"){
					if (line.substring(8, 9) != " "){
						if (!line.substring(8,9)){
							this.type("Error, parameter [STRING] required.");
							this.newLine();
						} else {
							this.type("Error, unrecognized command: " + line);
							this.newLine();
							this.type("You typed: " + line + ". line.substring(8,9) was: " + line.substring(8,9));
							this.newLine();
						}
					} else {
						if(line.substring(9) == "<?php echo($chaPass); ?>"){
							if("<?php echo($decryptFlag); ?>" == "true"){
								this.type("CHA-decryption successful.");
								this.newLine();
								this.type("User password: <?php echo($pass); ?>");
								this.newLine();
								this.newLine();
							} else {
								this.type("CHA-decryption failed with error: \'FireWall version is superior to WaterWall\'");
							}
						} else {
							this.type("CHA-decryption failed with error: \'unrecognized data\'");
						}
					}
				}
				else if (line.substr(0,5) == "login"){
					this.type("Blackhole Login System loaded.");
					this.newLine();
					this.newLine();
					this.type("User: <?php echo($targetIP); ?>");
					this.newLine();
					this.type("Password required: ");
					this.newLine();
					loginFlag = true;
				}
				else if (loginFlag == true){
					if(line == "<?php echo($pass); ?>"){
						this.type("Login successful.");
						this.newLine();
						this.type("Redirecting to user computer now.");
						loginFlag = false;
						window.location.replace("http://slavehack-legacy.herokuapp.com/game/internet.php?ip=<?php echo($targetIP); ?>&pass=<?php echo($pass); ?>");
					} else {
						this.type("Error, incorrect password detected.");
						this.newLine();
						this.type("Closing Blackhole Login System.");
						this.newLine();
						loginFlag = false;
					}
				}
				else {
					this.type('Error, unrecognized command: ' + line);
					this.newLine();
				}
			}
			this.prompt();
		}

		function termSetChromeState(n, v) {
			var header = 'termHeader'+n;
			var classname = (v)? 'termHeaderActive':'termHeaderInactive';
			if (document.getElementById) {
				var obj = document.getElementById(header);
				if (obj) obj.className = classname;
			}
			else if (document.all) {
				var obj = document.all[header];
				if (obj) obj.className = classname;
			}
			
		}

		function termChromeShow(n) {
			var div = 'terminal'+n;
			TermGlobals.setElementXY(div, 210+n*20, 30+n*20);
			TermGlobals.setVisible(div,1);
			if (document.getElementById) {
				var obj = document.getElementById(div);
				if (obj) obj.className = 'termShow';
			}
			else if (document.all) {
				var obj = document.all[div];
				if (obj) obj.className = 'termShow';
			}
		}

		function termChromeHide() {
			var div='terminal'+this.id;
			TermGlobals.setVisible(div,0);
			if (document.getElementById) {
				var obj = document.getElementById(div);
				if (obj) obj.className = 'termHidden';
			}
			else if (document.all) {
				var obj = document.all[div];
				if (obj) obj.className = 'termHidden';
			}
			if (termToSet==this.id) closeSettings(0);
		}

		function termClose(n) {
			if ((term[n]) && (term[n].closed == false)) term[n].close();
		}

		function termBringToFront(n) {
			for (var i=1; i<term.length; i++) {
				if ((n!=i) && (term[i])) {
					var obj=(document.getElementById)? document.getElementById('terminal'+i):document.all['terminal'+i];
					if (obj) obj.style.zIndex=1;
					termSetChromeState(i, false);
				}
			}
			var obj=(document.getElementById)? document.getElementById('terminal'+n):document.all['terminal'+n];
			if (obj) obj.style.zIndex=2;
			termSetChromeState(n, true);
			term[n].focus();
		}

		var termToSet=0;

		function termConfigure(n) {
			var t=term[n];
			if (parseFloat(t.version)<1.03) {
				alert('This utility requires termlib.js 1.03 or better.');
				return;
			}
			var color = t.colorsetting;
			termToSet = n;
			var f=document.forms.settingvalues;
			f.rows.value=t.conf.rows;
			f.cols.value=t.conf.cols;
			f.color[color-1].checked=true;
			var div='settingsdialog';
			TermGlobals.setVisible(div,1);
			if (document.getElementById) {
				var obj = document.getElementById(div);
				if (obj) obj.className = 'termShow';
			}
			else if (document.all) {
				var obj = document.all[div];
				if (obj) obj.className = 'termShow';
			}
			var td='terminal'+n;
			objs = (document.getElementById)? document.getElementById(td):document.all[td];
			if (obj) TermGlobals.setElementXY(div, parseInt(objs.style.left)+26, parseInt(objs.style.top)+26);
			TermGlobals.keylock=true;
		}

		function closeSettings(state) {
			var t=term[termToSet];
			if (state) {
				var f=document.forms.settingvalues;
				color = 3;
				if (f.color[0].checked) color = 1
				else if (f.color[1].checked) color=2
				else if (f.color[3].checked) color=4;
				var rows = parseInt(f.rows.value);
				var cols = parseInt(f.cols.value);
				if ((isNaN(rows)) || (rows<2) || (isNaN(cols)) || (cols<4)) {
					rows=t.conf.rows;
					cols=t.conf.cols;
				}
				var changed=((rows==t.conf.rows) && (cols==t.conf.cols) && (color==t.colorsetting))? false:true;
				t.colorsetting=color;
				var rstring= 'New Settings: Terminal set to '+rows+' rows, '+cols+' cols, ';
				if (color==1) {
					t.conf.bgColor='#000000';
					t.conf.fontClass='term';
					rstring+='green on black.';
				}
				else if (color==2) {
					t.conf.bgColor='#000000';
					t.conf.fontClass='term2';
					rstring+='white on black.';
				}
				else if (color==3) {
					t.conf.bgColor='#FFFFFF';
					t.conf.fontClass='term3';
					rstring+='black on white.';
				}
				else if (color==4) {
					t.conf.bgColor='#00FF00';
					t.conf.fontClass='term4';
					rstring+='black on green.';
				}
				if (changed) {
					t.cursorOff();
					t.conf.rows=t.maxLines=rows;
					t.conf.cols=t.maxCols=cols;
					t.rebuild();
					t.newLine();
					t.write(rstring);
					t.prompt();
				}
			}
			var div='settingsdialog';
			TermGlobals.setVisible(div,0);
			if (document.getElementById) {
				var obj = document.getElementById(div);
				if (obj) obj.className = 'termHidden';
			}
			else if (document.all) {
				var obj = document.all[div];
				if (obj) obj.className = 'termHidden';
			}
			termToSet = 0;
			TermGlobals.keylock=false;
		}

		function settingsSetColor(n) {
			document.forms.settingvalues.elements.color[n-1].checked=true;
		}

		// simple drag & drop

		var dragobject=null;
		var dragOfsX, dragOfsY;
		var lastX, lastY;

		function drag(e) {
			if (dragobject!=null) {
				if (window.event) e = window.event;
				var x = (typeof e.clientX != 'undefined')? e.clientX:e.pageX;
				var y = (typeof e.clientY != 'undefined')? e.clientY:e.pageY;
				dragobject.style.left=x+dragOfsX-lastX;
				dragobject.style.top=y+dragOfsY-lastY;
			}
		}

		function dragStart(e) {
			if (window.event) e = window.event;
			lastX = (typeof e.clientX != 'undefined')? e.clientX:e.pageX;
			lastY = (typeof e.clientY != 'undefined')? e.clientY:e.pageY;
		}

		function dragTerm(n) {
			termBringToFront(n)
			var div='terminal'+n;
			dragobject = (document.getElementById)? document.getElementById(div):document.all[div];
			dragOfsX = parseInt(dragobject.style.left);
			dragOfsY = parseInt(dragobject.style.top);
		}

		function dragRelease(e) {
			dragobject=null;
		}

		document.onmousemove=drag;
		document.onmouseup=dragRelease;
		document.onmousedown=dragStart;
	</script><?php

	//Verify correct password. If correct,
	//display user content.

	if(isset($_GET['ip']) && isset($_GET['pass'])){
		$targetIP = $_GET['ip'];
		$targetPass = $_GET['pass'];
		if($isNPC == "true"){
			$targetInfo = "SELECT * FROM npcs WHERE ip = '$targetIP'";
			$targetRes = mysqli_query($link, $targetInfo);
			$targetRows = mysqli_fetch_array($targetRes);

			if($targetRows['pass'] == $targetPass){
				?><script>
					$("#wrapper").html("<div id='compContent'>Test1</div>");
				</script><?php
			} else { }
		}
		else if($isPly == "true"){
			$targetInfo = "SELECT * FROM players WHERE ip = '$targetIP'";
			$targetRes = mysqli_query($link, $targetInfo);
			$targetRows = mysqli_fetch_array($targetRes);

			if($targetRows['comp_pass'] == $targetPass){
				?><script>
					$("#wrapper").html("<div id='compContent'>Test2</div>");
				</script><?php
			} else { }
		}
		else {
			echo("If you are seeing this, create a bug report.");
		}
	}
?>