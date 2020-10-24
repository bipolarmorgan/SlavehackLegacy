<?php
	session_start();
    include("game_page_parts.php");

	require "config.php";

	function updateLogs(){
		require "config.php";
		$user = $_SESSION['user'];
		$msg = $_POST['message'];
		$updateQry = "UPDATE `players` 
						SET `logs` = '$msg'
						WHERE `username` = '$user'";

		if(!mysqli_query($newlink, $updateQry)){
			echo mysqli_error($link);
		} else { }

		mysqli_close($newlink);
	}

	function fetchLogs(){
require "config.php";
		$user = $_SESSION['user'];

		if(isset($_POST['message'])){
			return $_POST['message'];
		} else {
			$newLogQry = "SELECT * FROM `players` WHERE username = '$user'";
			if(!mysqli_query($newlink, $newLogQry)){
				echo mysqli_error($link);
			} else {
				$newLogRes = mysqli_query($newlink, $newLogQry);
			}
			$newLogRows = mysqli_fetch_array($newLogRes);
			$newLog = $newLogRows['logs'];	
			
			return $newLog;		
		}

		mysqli_close($newlink);
	}
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
							$user = $_SESSION['user'];
							$logQry = "SELECT * FROM `players` WHERE username = '$user'";

							if(!mysqli_query($link, $logQry)){
								echo mysqli_error($link);
								echo "error";
							} else {
								$logRes = mysqli_query($link, $logQry);
							}

							$logRows = mysqli_fetch_array($logRes);
							?><script>
							//setTimeout(function() {
							//	location.reload();
							//}, 15000);
							</script><?php
							$log = $logRows['logs'];
							echo "<textarea id='logs' name='message' cols='90' rows='20'>";
							echo fetchLogs();
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

    user_bg(); // Moved bg determination script to game_page_parts.php

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
?>