<?php
include("page_parts.php");

function newEntry( $text ){
    $url=parse_url(getenv("CLEARDB_DATABASE_URL"));

    $server = $url["host"];
    $username = $url["user"];
    $password = $url["pass"];
    $db = substr($url["path"],1);

    $newlink = mysqli_connect($server, $username, $password);
    mysqli_select_db($newlink, $db) or die("Cannot connect to database.");

    $user = $_SESSION['user'];
}

$loggedIn = cookie_check();
echo $loggedIn;
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
            News
        </title>
        <?php clock_head() ?>
    </head>
    <body onload="startTime()">

    <?php menu() ?>

    <?php content_news() ?>

    <?php footer() ?>

    </body>
    </html>

<?php
$timestamp = $_SERVER['REQUEST_TIME'];

if(isset($_SESSION['tz'])){
    $tz = $_SESSION['tz'];
} else {
    $tz = "America/Chicago";
}

if($loggedIn == "true"){
?>
<script>
    $("#gameswitch").html("<a href='/game/index.php?login=success'>Game</a>")
    $("#logswitch").html("<a href='logout.php'>Logout</a>");
</script>
<?php
    } else {
?>
<script>
    $("#gameswitch").html("");
    $("#logswitch").html("<a href='login.php'>Login</a>");
</script>
<?php
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