<?php
	session_start();
?>

<html>
	<head>
		<title>
			SHL - Logs
		</title>
    	<link rel="stylesheet" type="text/css" href="css/logs.css">
		<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
 		<script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
     	<script type="text/javascript" src="../js/jQuery.js"></script>
    	<!--Captcha Stuff-->
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
				<div id = "title">My Log File</div>
				<div id = "wrapper">
					<div id = "contentHolder">
						Your log file holds important information about you.<br />
						This ranges from things such as accessing your computer, to managing software.<br />
						You can even converse with other players using your log file.<br />
						It's important you make sure unwanted eyes are kept away from this.<br />
					</div><br />
					<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
						<?php 
							echo "<textarea name='message' cols='90' rows='20'>";
							//echo "<div id='messages'></div>"
							echo "</textarea>";
							if(isset($_POST['message'])){
								updateLogs();
							} else { }
						?>
						<br />
						<input type = "submit" value = "Edit Log" id = "submit" style = "width: 8em; margin-left: 45%; text-align: center;">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>

<?php
	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"],1);

	$link = mysqli_connect($server, $username, $password);
	mysqli_select_db($link, $db) or die("Cannot connect to database.");

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
	?><script>
		$("#ipuser").html("<?php echo $ip;?>@<?php echo $user;?>");
		$("#timedate").html("<?php echo ($curTime); ?>");
		$("#ip").html("<?php echo $ip; ?><a href='index.php?reset=1'> Reset</a>");
		$("#pass").html("<?php echo $pass; ?><a href='index.php?reset=2'> Reset</a>");
	</script><?php

	function updateLogs(){
		$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

		$server = $url["host"];
		$username = $url["user"];
		$password = $url["pass"];
		$db = substr($url["path"],1);

		$newlink = mysqli_connect($server, $username, $password);
		mysqli_select_db($newlink, $db) or die("Cannot connect to database.");

		$user = $_SESSION['user'];
		$msg = $_POST['message'];
		$updateQry = "UPDATE `players` 
						SET `logs` = '$msg'
						WHERE `username` = '$user'";

		if(!mysqli_query($newlink, $updateQry)){
			echo mysqli_error($link);
		} else { }

		$newLogQry = "SELECT * FROM `players` WHERE username = '$username'";
		if(!mysqli_query($newlink, $newLogQry)){
			echo mysqli_error($link);
		} else {
			$newLogRes = mysqli_query($newlink, $newLogQry);
		}
		$newLogRows = mysqli_fetch_array($newLogRes);
		$newLog = $newLogRows['logs'];

		?><script>
			$("#messages").append('<?php echo($newLog); ?>');
		</script><?php

		mysqli_close($newlink);
	}
?>