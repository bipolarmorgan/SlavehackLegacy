<?php
session_start();
include("page_parts.php");

$zonelist = array('Kwajalein' => '(GMT-12:00) International Date Line West',
    'Pacific/Midway' => '(GMT-11:00) Midway Island',
    'Pacific/Samoa' => '(GMT-11:00) Samoa',
    'Pacific/Honolulu' => '(GMT-10:00) Hawaii',
    'America/Anchorage' => '(GMT-09:00) Alaska',
    'America/Los_Angeles' => '(GMT-08:00) Pacific Time (US &amp; Canada)',
    'America/Tijuana' => '(GMT-08:00) Tijuana, Baja California',
    'America/Denver' => '(GMT-07:00) Mountain Time (US &amp; Canada)',
    'America/Chihuahua' => '(GMT-07:00) Chihuahua',
    'America/Mazatlan' => '(GMT-07:00) Mazatlan',
    'America/Phoenix' => '(GMT-07:00) Arizona',
    'America/Regina' => '(GMT-06:00) Saskatchewan',
    'America/Tegucigalpa' => '(GMT-06:00) Central America',
    'America/Chicago' => '(GMT-06:00) Central Time (US &amp; Canada)',
    'America/Mexico_City' => '(GMT-06:00) Mexico City',
    'America/Monterrey' => '(GMT-06:00) Monterrey',
    'America/New_York' => '(GMT-05:00) Eastern Time (US &amp; Canada)',
    'America/Bogota' => '(GMT-05:00) Bogota',
    'America/Lima' => '(GMT-05:00) Lima',
    'America/Rio_Branco' => '(GMT-05:00) Rio Branco',
    'America/Indiana/Indianapolis' => '(GMT-05:00) Indiana (East)',
    'America/Caracas' => '(GMT-04:30) Caracas',
    'America/Halifax' => '(GMT-04:00) Atlantic Time (Canada)',
    'America/Manaus' => '(GMT-04:00) Manaus',
    'America/Santiago' => '(GMT-04:00) Santiago',
    'America/La_Paz' => '(GMT-04:00) La Paz',
    'America/St_Johns' => '(GMT-03:30) Newfoundland',
    'America/Argentina/Buenos_Aires' => '(GMT-03:00) Georgetown',
    'America/Sao_Paulo' => '(GMT-03:00) Brasilia',
    'America/Godthab' => '(GMT-03:00) Greenland',
    'America/Montevideo' => '(GMT-03:00) Montevideo',
    'Atlantic/South_Georgia' => '(GMT-02:00) Mid-Atlantic',
    'Atlantic/Azores' => '(GMT-01:00) Azores',
    'Atlantic/Cape_Verde' => '(GMT-01:00) Cape Verde Is.',
    'Europe/Dublin' => '(GMT) Dublin',
    'Europe/Lisbon' => '(GMT) Lisbon',
    'Europe/London' => '(GMT) London',
    'Africa/Monrovia' => '(GMT) Monrovia',
    'Atlantic/Reykjavik' => '(GMT) Reykjavik',
    'Africa/Casablanca' => '(GMT) Casablanca',
    'Europe/Belgrade' => '(GMT+01:00) Belgrade',
    'Europe/Bratislava' => '(GMT+01:00) Bratislava',
    'Europe/Budapest' => '(GMT+01:00) Budapest',
    'Europe/Ljubljana' => '(GMT+01:00) Ljubljana',
    'Europe/Prague' => '(GMT+01:00) Prague',
    'Europe/Sarajevo' => '(GMT+01:00) Sarajevo',
    'Europe/Skopje' => '(GMT+01:00) Skopje',
    'Europe/Warsaw' => '(GMT+01:00) Warsaw',
    'Europe/Zagreb' => '(GMT+01:00) Zagreb',
    'Europe/Brussels' => '(GMT+01:00) Brussels',
    'Europe/Copenhagen' => '(GMT+01:00) Copenhagen',
    'Europe/Madrid' => '(GMT+01:00) Madrid',
    'Europe/Paris' => '(GMT+01:00) Paris',
    'Africa/Algiers' => '(GMT+01:00) West Central Africa',
    'Europe/Amsterdam' => '(GMT+01:00) Amsterdam',
    'Europe/Berlin' => '(GMT+01:00) Berlin',
    'Europe/Rome' => '(GMT+01:00) Rome',
    'Europe/Stockholm' => '(GMT+01:00) Stockholm',
    'Europe/Vienna' => '(GMT+01:00) Vienna',
    'Europe/Minsk' => '(GMT+02:00) Minsk',
    'Africa/Cairo' => '(GMT+02:00) Cairo',
    'Europe/Helsinki' => '(GMT+02:00) Helsinki',
    'Europe/Riga' => '(GMT+02:00) Riga',
    'Europe/Sofia' => '(GMT+02:00) Sofia',
    'Europe/Tallinn' => '(GMT+02:00) Tallinn',
    'Europe/Vilnius' => '(GMT+02:00) Vilnius',
    'Europe/Athens' => '(GMT+02:00) Athens',
    'Europe/Bucharest' => '(GMT+02:00) Bucharest',
    'Europe/Istanbul' => '(GMT+02:00) Istanbul',
    'Asia/Jerusalem' => '(GMT+02:00) Jerusalem',
    'Asia/Amman' => '(GMT+02:00) Amman',
    'Asia/Beirut' => '(GMT+02:00) Beirut',
    'Africa/Windhoek' => '(GMT+02:00) Windhoek',
    'Africa/Harare' => '(GMT+02:00) Harare',
    'Asia/Kuwait' => '(GMT+03:00) Kuwait',
    'Asia/Riyadh' => '(GMT+03:00) Riyadh',
    'Asia/Baghdad' => '(GMT+03:00) Baghdad',
    'Africa/Nairobi' => '(GMT+03:00) Nairobi',
    'Asia/Tbilisi' => '(GMT+03:00) Tbilisi',
    'Europe/Moscow' => '(GMT+03:00) Moscow',
    'Europe/Volgograd' => '(GMT+03:00) Volgograd',
    'Asia/Tehran' => '(GMT+03:30) Tehran',
    'Asia/Muscat' => '(GMT+04:00) Muscat',
    'Asia/Baku' => '(GMT+04:00) Baku',
    'Asia/Yerevan' => '(GMT+04:00) Yerevan',
    'Asia/Yekaterinburg' => '(GMT+05:00) Ekaterinburg',
    'Asia/Karachi' => '(GMT+05:00) Karachi',
    'Asia/Tashkent' => '(GMT+05:00) Tashkent',
    'Asia/Kolkata' => '(GMT+05:30) Calcutta',
    'Asia/Colombo' => '(GMT+05:30) Sri Jayawardenepura',
    'Asia/Katmandu' => '(GMT+05:45) Kathmandu',
    'Asia/Dhaka' => '(GMT+06:00) Dhaka',
    'Asia/Almaty' => '(GMT+06:00) Almaty',
    'Asia/Novosibirsk' => '(GMT+06:00) Novosibirsk',
    'Asia/Rangoon' => '(GMT+06:30) Yangon (Rangoon)',
    'Asia/Krasnoyarsk' => '(GMT+07:00) Krasnoyarsk',
    'Asia/Bangkok' => '(GMT+07:00) Bangkok',
    'Asia/Jakarta' => '(GMT+07:00) Jakarta',
    'Asia/Brunei' => '(GMT+08:00) Beijing',
    'Asia/Chongqing' => '(GMT+08:00) Chongqing',
    'Asia/Hong_Kong' => '(GMT+08:00) Hong Kong',
    'Asia/Urumqi' => '(GMT+08:00) Urumqi',
    'Asia/Irkutsk' => '(GMT+08:00) Irkutsk',
    'Asia/Ulaanbaatar' => '(GMT+08:00) Ulaan Bataar',
    'Asia/Kuala_Lumpur' => '(GMT+08:00) Kuala Lumpur',
    'Asia/Singapore' => '(GMT+08:00) Singapore',
    'Asia/Taipei' => '(GMT+08:00) Taipei',
    'Australia/Perth' => '(GMT+08:00) Perth',
    'Asia/Seoul' => '(GMT+09:00) Seoul',
    'Asia/Tokyo' => '(GMT+09:00) Tokyo',
    'Asia/Yakutsk' => '(GMT+09:00) Yakutsk',
    'Australia/Darwin' => '(GMT+09:30) Darwin',
    'Australia/Adelaide' => '(GMT+09:30) Adelaide',
    'Australia/Canberra' => '(GMT+10:00) Canberra',
    'Australia/Melbourne' => '(GMT+10:00) Melbourne',
    'Australia/Sydney' => '(GMT+10:00) Sydney',
    'Australia/Brisbane' => '(GMT+10:00) Brisbane',
    'Australia/Hobart' => '(GMT+10:00) Hobart',
    'Asia/Vladivostok' => '(GMT+10:00) Vladivostok',
    'Pacific/Guam' => '(GMT+10:00) Guam',
    'Pacific/Port_Moresby' => '(GMT+10:00) Port Moresby',
    'Asia/Magadan' => '(GMT+11:00) Magadan',
    'Pacific/Fiji' => '(GMT+12:00) Fiji',
    'Asia/Kamchatka' => '(GMT+12:00) Kamchatka',
    'Pacific/Auckland' => '(GMT+12:00) Auckland',
    'Pacific/Tongatapu' => '(GMT+13:00) Nukualofa');

?>

    <html>
    <head>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/nav.css">
        <link rel="shortcut icon" href="img/icon.ico" />
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="js/menu_script.js"></script>
        <script type="text/javascript" src="js/jQuery.js"></script>
        <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css"> -->
        <title>
            Register
        </title>
        <?php clock_head() ?>
    </head>
    <body onload="startTime()">

    <?php menu() ?>

    <div id = "wrapper">
        <div id = "entryBlock">
            <div id="ipLog">
                132.45.86.1@registerHost
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>Register</b><br />
                    </div>
                    <div id="error"></div><div id="success"></div>
                    <form id="register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <p align="center">
                            <input style="text-align: center; margin-bottom: 2px;" type = "text" name = "user" placeholder="Username" required><br>
                            <input style="text-align: center; margin-bottom: 2px;" type = "password" name = "pass" placeholder="Password" autocomplete = "off" required><br>
                            <input style="text-align: center; margin-bottom: 2px;" type = "text" name = "email" placeholder="Email" autocomplete = "off" required><br>
                            <select name="tz">
                                <option value="DEFAULT"> Select Your Time Zone</option>
                                <option value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                                <option value="America/Anchorage">(GMT-09:00) Alaska</option>
                                <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                <option value="America/Phoenix">(GMT-07:00) Arizona</option>
                                <option value="America/Denver">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                <option value="America/Chicago">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                <option value="America/New_York">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                <option value="America/Indiana/Indianapolis">(GMT-05:00) Indiana (East)</option>
                                <option disabled="disabled">&#8212;&#8212;&#8212;&#8212;&#8212;&#8212;&#8211;</option>
                                <?php
                                foreach($zonelist as $key => $value) {
                                    echo '		<option value="' . $key . '">' . $value . '</option>' . "\n";
                                }
                                ?>
                            </select><br>
                            <label style="font-size: 1.5em; text-decoration: underline"><b>Agreements</b></label><br>
                        <div id="agreement">
                            <table><tr><td>
                            <label for="option1"><span><b>I understand that I could lose everything I've worked for in
                                        a matter of minutes.</b></span></label></td>
                            <td style="vertical-align: bottom;"><input type = "checkbox" name = "ustand" id="option1" required></td>
                            <tr><td><label for="option2"><span><b>I've read and agree to the terms and conditions. I also agree to
                                        the use of cookies on this website for the sole purpose of this
                                        game.</b></span></label></td>
                            <td style="vertical-align: bottom;"><input type = "checkbox" name = "agree" id="option2" required></td></tr>
                            <tr><td><label for="option3"><span><b>Subscribe to email updates
                                        about the game's development?</b></span></label></td>
                            <td style="vertical-align: bottom;"><input type = "checkbox" name = "mlist" id="option3"></td></tr></table>
                        </div>
                        <br>
                        <input type = "submit" value = "Submit" name = "register" id = "register" class="pure-skin-mine pure-button">
                        </p>
                    </form>
                    <br />
                    Passwords must contain one capital and lowercase letter, one number, and be at least 8 characters long.
                    <br />
                    Usernames must be at least 8 characters long and no longer than 30 characters in length.
                </div>
            </div>
        </div>
    </div>

    <?php footer() ?>

    </body>
    </html>

<?php
$passChk = false;
$userChk = false;
$emailChk = false;
$ustandChk = false;
$agrChk = false;
$listChk = false;

$timestamp = $_SERVER['REQUEST_TIME'];
date_default_timezone_set('UTC');

if(isset($_POST['tz']) && $userChk && $passChk && $emailChk && $ustandChk && $agrChk) {
    $_SESSION['tz'] = $_POST['tz'];
}

if(isset($_SESSION['tz'])){
    $tz = $_SESSION['tz'];
} else {
    $tz = "America/Chicago";
}

if(isset($_POST['mlist'])){
    $listChk = true;
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

if (isset($_POST['register'])) {
    echo("Made it here 0.");
    // Blowfish Password Encryption Algorithm courtesy of The-Art-of-Web
    function bf_crypt($input, $rounds = 7) {
        $salt       = "";
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }
        return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
    }

    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    $link = mysqli_connect($server, $username, $password);
    mysqli_select_db($link, $db) or die("Cannot connect to database.");

    $query2 = "CREATE TABLE IF NOT EXISTS `users` (
                        `uid` INT(10) unsigned NOT NULL AUTO_INCREMENT,
                        `login` VARCHAR(50) NOT NULL,
                        `hash` VARCHAR(64) NOT NULL,
                        `email` CHAR(100) NOT NULL,
                        `timezone` VARCHAR(50) NOT NULL,
                        `activation` VARCHAR(255) NOT NULL UNIQUE,
                        `registered` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `email_confirmed` BOOLEAN NOT NULL DEFAULT FALSE,
                        `mailing_list` BOOLEAN NOT NULL DEFAULT FALSE,
                        `role` VARCHAR(30) NOT NULL DEFAULT 'user',
                        PRIMARY KEY(`uid`),
                        UNIQUE KEY `login_UNIQUE` (`login`),
                        UNIQUE KEY `email_UNIQUE` (`email`)
                    ) DEFAULT CHARSET=utf8";

    if(!mysqli_query($link, $query2)){
        echo mysqli_error($link);
    }

    $user = mysqli_real_escape_string($link, stripslashes($_POST['user']));
    $pass = mysqli_real_escape_string($link, stripslashes($_POST['pass']));
    $email = mysqli_real_escape_string($link, stripslashes($_POST['email']));

    $lC = preg_match('@[a-z]@', $pass);
    $uC = preg_match('@[A-Z]@', $pass);
    $nR = preg_match('@[0-9]@', $pass);

    if(isset($_POST['ustand']) && isset($_POST['agree'])){
        $ustandChk = true;
        $agrChk = true;
    } else {
        ?><script>
            $("#error").append("Error: All checkboxes except the mailing list must be checked.<br />");
        </script><?php
    }

    if(!$lC || !$uC || !$nR || strlen($pass) < 8) {
        if(!$lC){
            ?><script>
                $("#error").append("Error: Password must contain at least 1 lowercase letter.<br />");
            </script><?php
        }
        if(!$uC){
            ?><script>
                $("#error").append("Error: Password must contain at least 1 uppercase letter.<br />");
            </script><?php
        }
        if(!$nR){
            ?><script>
                $("#error").append("Error: Password must contain at least 1 number.<br />");
            </script><?php
        }
        if(strlen($pass) < 8){
            ?><script>
                $("#error").append("Error: Password must be at least 8 characters long.<br />");
            </script><?php
        }
    } else {
        $newPass = bf_crypt($pass);
        $passChk = true;
    }

    if(strlen($user) > 30){
        ?><script>
            $("#error").append("Error: Username must under 30 characters long.<br />");
        </script><?php
    } else {
        $userChk = true;
    }

    if(isset($_POST['email'])){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            ?><script>
                $("#error").append("Error: Invalid email detected. Please enter a valid email.<br />");
            </script><?php
        } else {
            $eCount = "";
            $emailChk = true;
            $eCount = mysqli_query($link, "SELECT uid FROM users WHERE email='$email'");

            if (!mysqli_num_rows($eCount)){
                if($userChk && $passChk && $emailChk && $ustandChk && $agrChk){
                    $activation = md5($email.time());
                    $_SERVER['activation'] = $activation;

                    if($listChk){
                        if(!mysqli_query($link, "INSERT INTO users(login, hash, email, timezone, activation, email_confirmed, mailing_list)
		    					VALUES('$user', '$newPass', '$email', '$tz', '$activation', false, 1)")) {
                            echo "Error: " . mysqli_error($link);
                        }
                    } else {
                        if(!mysqli_query($link, "INSERT INTO users(login, hash, email, timezone, activation, email_confirmed, mailing_list)
		    					VALUES('$user', '$newPass', '$email', '$tz', '$activation', false, false)")) {
                            echo "Error: " . mysqli_error($link);
                        }
                    }

                    include 'smtp/Send_Mail.php';
                    $to = $email;
                    $subject = 'Slavehack Legacy: [Email Verification]';
                    $body = $user.', <br /><br />Thanks for signing up for Slavehack: Legacy.
		    					<br /><br />To make sure you are a human, please
		    					verify your email by using the link below. <br /><br /><a 
		    					href="http://slavehack-legacy.herokuapp.com/activation.php?code='.$activation.'">http://slavehack-legacy.herokuapp.com/activation.php?code='.
                        $activation.'</a>';

                    Send_Mail($to, $subject, $body);
                    ?><script>
                        $("#success").html("Registration successful! Please use the activation link in your e-mail to continue.");
                    </script><?php
                } else { }
            } else {
                ?><script>
                    $("#error").append("Error: E-mail already in use.");
                </script><?php
            }
        }
    }
}

if(isset($_GET['resend']) && $_GET['resend'] == true){
    include 'smtp/Send_Mail.php';
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    $link = mysqli_connect($server, $username, $password);
    mysqli_select_db($link, $db) or die("Cannot connect to database.");

    $user = mysqli_real_escape_string($link, $_GET['user']);
    $result = mysqli_query($link, "SELECT * FROM users WHERE login = '$user'");
    $row = mysqli_fetch_array($result);
    $email = mysqli_real_escape_string($link, $row['email']);
    $activation = mysqli_real_escape_string($link, $row['activation']);
    $to = $email;
    $subject = 'Slavehack Legacy: [Email Verification]';
    $body = $user.', <br /><br />Thanks for signing up for Slavehack: Legacy.
	 	    	<br /><br />To make sure you are a human, please
	 	    	verify your email by using the link below. <br /><br /><a 
	 	    	href="http://slavehack-legacy.herokuapp.com/activation.php?code='.$activation.'">http://slavehack-legacy.herokuapp.com/SlavehackLegacy/activation.php?code='.
        $activation.'</a>';

    Send_Mail($to, $subject, $body);
    ?><script>
        $("#success").html("Your activation e-mail has been re-sent.");
    </script><?php
}
?>