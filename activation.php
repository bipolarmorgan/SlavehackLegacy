<!-- Credits to Srinivas Tamada Production
	for help with the email verification code.
-->
<?php
include("page_parts.php");
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
    <title>
        Activate
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
                    <b>Activation</b><br /><br />
                </div>
                <div id="error"></div><div id="success"></div>
            </div>
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

$msg = '';
if(!empty($_GET['code']) && isset($_GET['code'])){
    $code = mysqli_real_escape_string($link, $_GET['code']);
    $c=mysqli_query($link, "SELECT uid FROM users WHERE activation = '$code'");

    if(mysqli_num_rows($c) > 0){
        $count = mysqli_query($link, "SELECT uid FROM users WHERE activation = '$code' AND email_confirmed='false'");

        if(mysqli_num_rows($count) == 1){
            if(!mysqli_query($link, "UPDATE users SET email_confirmed='1' WHERE activation='$code'")){
                echo "Error: " . mysqli_error($link);
            }
            ?><script>
                $("#success").html("You've successfuly activated your account. You may now <a href='login.php'>log in</a>. Redirecting in 5 seconds.");
                header("refresh:5;url=login.php");
            </script><?php
        } else {
            ?><script>
                $("#error").html("Your account has already been activated. Redirecting in 5 seconds.");
                header("refresh:5;url=login.php");
            </script><?php
        }
    } else {
        ?><script>
            $("#error").html("Incorrect activation code.");
        </script><?php
    }
}
?>