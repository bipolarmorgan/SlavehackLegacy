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
		<title>
			SHL - My Computer
		</title>

		<script type="text/javascript">
	        // function showRecaptcha(element) {
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
				showRecaptcha('recaptcha_div');
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
		<div id="recaptcha_div">
			<div id = "captcha_block"></div>
		</div>
			<div id = "leftColumn">
				<ul>
					<li><a href = "index.php"><img src = "img/ico_comp.png">My Computer</a></li>
					<li><a href = "processes.php"><img src = "img/ico_procs.png">Processes</a></li>
					<li><a href = "log.php"><img src = "img/ico_logs.png">Computer Logs</a></li>
					<li><a href = "files.php"><img src = "img/ico_files.png">Files</a></li>
					<li><a href = "internet.php"><img src = "img/ico_world.png">Internet</a></li>
					<li><a href = "slaves.php"><img src = "img/ico_slaves.png">My Slaves</a></li>
				</ul>
			</div>
	</body>
</html>

<?php
	if(!isset($_SESSION['background'])){
		$_SESSION['background'] = "localhost/SlavehackLegacy/game/backgrounds/default.png";
		$bg = $_SESSION['background'];
	} else {
		$bg = $_SESSION['background'];
	}
	?><script>
		var img = new Image();
		img.src = "<?php echo $bg; ?>";
		document.body.background = img.src;
	</script><?php 
?>