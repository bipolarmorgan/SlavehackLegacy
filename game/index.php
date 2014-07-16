<?php
	session_start();
?>

<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
 		<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
    	<script type="text/javascript" src="../js/jQuery.js"></script>
    	<link rel="stylesheet" type="text/css" href="backgrounds/desktop.css">
        <script src = "js/node_modules/socket.io/node_modules/socket.io-client/socket.io.js"></script>
		<title>
			SHL - My Computer
		</title>
		<script>
		    var socket = io.connect('http://localhost:3000');
	        socket.on('login', function() {
	            console.log("<?php echo($_SESSION['user'] . ' has signed on to ' . $_SESSION['ip']); ?>");
	        });

	        socket.on('persist', function() {
	        	console.log("User is still logged in.");
	        });
	        // function showRecaptcha(element) { -- Need a domain before we can use Recaptcha
	        //    Recaptcha.create("your_public_key", element, {
	        //    theme: "red",
	        //    callback: Recaptcha.focus_response_field});
	        // }

	        function captchaPlaceholder() {
	        	var confirm = prompt("Did you complete the captcha?", "");
	        	if (confirm == "yes" || confirm == "Yes") {
	        		$("#captcha_block").css("opacity", "1");
	        		$("#captcha_block").css("width", "0");
	        		$("#captcha_block").css("height", "0");
	        		$("#captcha_block").css("z-index", "0");
	        	}
	        }

	        window.onload = function(){
	        	var n = 5;
	        	var number = Math.floor(Math.random()*n)+1;
//				showRecaptcha('recaptcha_div');
	        	if(number > 3) {
	        		$("#captcha_block").css("opacity", "0.5");
	        		$("#captcha_block").css("width", "100%");
	        		$("#captcha_block").css("height", "100%");
	        		$("#captcha_block").css("z-index", "6000");
	        		captchaPlaceholder();
//	        		Recaptcha.reload();
//	        		Recaptcha.focus_response_field();
	        	} else {
	        		$("#captcha_block").css("opacity", "1");
	        		$("#captcha_block").css("width", "0");
	        		$("#captcha_block").css("height", "0");
	        		$("#captcha_block").css("z-index", "0");
	        	}
	        }
      	</script>
	</head>
	<body>
		<div id = "userinfo">
		<div id = "recaptcha_div">
			<div id = "captcha_block"></div>
		</div>
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
				<div id = "title">My Computer</div>
				<div id = "wrapper">
					<div id = "columnLeft">
						<div class = "wrapperTitleLeft">Information</div>
						<div class = "wrapperLeftInfo">
							<ul>
								<li>My IP Address: <span id="ip"></span></li>
								<li>My password: <span id="pass"></span></li>
							</ul>
						</div>
					</div>
					<div id = "columnRight">
						<div class = "wrapperTitleRight">Statistics</div>
						<div class = "wrapperRightStats">
							<ul>
								<li>A</li>
								<li>B</li>
								<li>C</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	include_once('../config.php');
	$link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    $query2 = "CREATE TABLE IF NOT EXISTS `players` (
                    `uid` INT(10) unsigned NOT NULL AUTO_INCREMENT,
                    `username` VARCHAR(50) NOT NULL,
                    `comp_pass` VARCHAR(50) NOT NULL DEFAULT 'password',
                    `ip` VARCHAR(64) NOT NULL,
                    `timezone` VARCHAR(50) NOT NULL,
                    `role` VARCHAR(30) NOT NULL DEFAULT 'user',
                    `rank` INT(10) NOT NULL DEFAULT 0,
                    `num_ip_resets` INT(10) NOT NULL DEFAULT 0,
                    `num_pass_resets` INT(10) NOT NULL DEFAULT 0,
                    PRIMARY KEY(`uid`),
                    UNIQUE KEY `username_UNIQUE` (`username`),
                    UNIQUE KEY `comp_pass_UNIQUE` (`comp_pass`),
                    UNIQUE KEY `ip_UNIQUE` (`ip`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	if(!mysqli_query($link, $query2)){
		echo mysqli_error($link);
	}

	?><script>
		var img = new Image();
		img.src = "backgrounds/default.png";
		document.body.background = img.src;
	</script><?php 

	$user = $_SESSION['user'];

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

	$passQry = "SELECT pass FROM `players` WHERE username = '$user'";
	if(!mysqli_query($link, $passQry)){
		$pass = randomPassword();
		if(!isset($_SESSION['pass'])){
			$_SESSION['pass'] = $pass;
		}
	} else {
		$result = mysqli_query($link, $passQry);
		$r = mysqli_fetch_array($result);
		$pass = $r['pass'];
		if(!isset($_SESSION['pass'])){
			$_SESSION['pass'] = $pass;
		}
	}
	// $ipQry = "SELECT ip FROM players WHERE ip = '$ip'";
	// while(mysqli_query($link, $ipQry)){
	// 	if(!mysqli_query($link, $ipQry)){
	// 		break;
	// 	} else {
	// 		$ip = long2ip(rand(0, "4294967295"));
	// 	}
	// }
	$tz = $_SESSION['tz'];
	$plyQry = "SELECT * FROM `players` WHERE username = '$user'";
	$result = mysqli_query($link, $plyQry);
	$r2 = mysqli_fetch_array($result);
	if(!mysqli_query($link, $plyQry) || $r2['username'] == ""){
    	$ip = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    	$ipQry = "SELECT ip FROM players WHERE ip = '$ip'";
    	$_SESSION['ip'] = $ip;
    	while(mysqli_num_rows(mysqli_query($link, $ipQry)) >= 1) {
    		$ip = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    		if(mysqli_num_rows(mysqli_query($link, $ipQry)) <= 0){
    			$_SESSION['ip'] = $ip;
    			break;
    		}
    	}

		$newPlyQry = "INSERT INTO players(username, comp_pass, ip, timezone)
		VALUES('$user', '$pass', '$ip', '$tz')";
		if(!mysqli_query($link, $newPlyQry)){
			echo mysqli_error($link);
		} else {
			if(!mysqli_query($link, $plyQry)){
				echo mysqli_error($link);
			} else {
				$row = mysqli_fetch_array(mysqli_query($link, $plyQry));
			}
		}
	} else {
		if(!mysqli_query($link, $plyQry)){
			echo mysqli_error($link);
		} else {
			$row = mysqli_fetch_array(mysqli_query($link, $plyQry));
			$ip = $row['ip'];
			$user = $row['username'];
			$pass = $row['comp_pass'];
			$_SESSION['ip'] = $ip;
			$_SESSION['pass'] = $pass;
		}
	}

	$timestamp = $_SERVER['REQUEST_TIME'];

	$dtzone = new DateTimeZone($tz);
	$dtime = new DateTime();

	$dtime->setTimestamp($timestamp);
	$dtime->setTimeZone($dtzone);
	$curTime = $dtime->format('g:i A m/d/y');
	?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
		$("#ip").html("<?php echo $ip; ?><a href='index.php?reset=1'> Reset</a>");
		$("#pass").html("<?php echo $pass; ?><a href='index.php?reset=2'> Reset</a>");
	</script><?php
?>