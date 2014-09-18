<!--
    Copyright (C) "Slavehack: Legacy" 2014

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<?php
    include("page_parts.php");

    echo("Check 0");

    //COOKIE CHECK//

    if(isset($_COOKIE['auth'])){
        echo("Check 1");
        $clean = array();
        $mysqli = array();

        $now = time();
        $salt = 'SLAVEHACK';

        list($identifier, $token) = explode(':', $_COOKIE['auth']);

        if(ctype_alnum($identifier) && ctype_alnum($token)){
            $clean['identifier'] = $identifier;
            $clean['token'] = $token;
        }

        $mysqli['identifier'] = mysqli_real_escape_string($link, $clean['identifier']);

        $qry = "SELECT login, token, timeout
                FROM users
                WHERE identifier = '{$mysqli['identifier']}'";

        echo("Check 2");

        if ($result = mysqli_query($link, $qry)){
            echo("Check 3");
            if(mysqli_num_rows($result)){
                $record = mysqli_fetch_assoc($result);
                echo("Check 4");
                if($clean['token'] != $record['token']){
                    echo("Invalid token.");
                }
                else if($now > $record['timeout']){
                    echo("Timeout detected.");
                }
                else if($clean['identifier'] != md5($salt . md5($record['login'] . $salt))) {
                    echo("Invalid identifier.");
                }
                else {
                    echo("Logged in user detected.");
                }
            }
        } else {
            echo mysqli_error($link);
        }
    } else {
        echo "Cookie not detected.";
    }

    ////////////////
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
        Slavehack: Legacy
    </title>

    <!--[if lt IE 7]>
    <style media="screen" type="text/css">
        #container {
            height:100%;
        }
    </style>
    <![endif]-->

    <?php clock_head() ?>
</head>

<body onload="startTime()">

<?php menu() ?>

<?php content_index()?>

<?php footer() ?>

</body>
</html>

<?php
    $timestamp = $_SERVER['REQUEST_TIME'];
    date_default_timezone_set('UTC');

    $tz = "America/Chicago";

    if(isset($_SESSION['tz'])){
        $tz = $_SESSION['tz'];
    }

    if(isset($_SESSION['user'])){
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