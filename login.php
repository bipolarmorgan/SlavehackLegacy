<?php
ini_set ('display_errors', '1');

error_reporting (E_ALL | E_STRICT); 

$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"],1);

$time = "";
$logtime = "";

$link = mysqli_connect($server, $username, $password);
mysqli_select_db($link, $db) or die("Cannot connect to database.");

if(isset($_POST['login'])){

    function verify($password, $hashedPassword){
        return crypt($password, $hashedPassword) == $hashedPassword;
    }

    if(isset($_POST['user'])){
        $user = mysqli_real_escape_string($link, stripslashes($_POST['user']));
    } else {
        $user = "";
    }

    if(isset($_POST['pass'])){
        $pass = mysqli_real_escape_string($link, stripslashes($_POST['pass']));
    } else {
        $pass = "";
    }

    //$remember = $_POST['remember'];
    $remember = (isset($_POST['remember']) ? $_POST['remember'] : null);

    $qry = "SELECT * FROM users WHERE login='" . $user . "'";
    if(!mysqli_query($link,$qry)){
        ?><script>
            $(document).ready(function() {
                $("#error").html("Invalid username or password.");
            });
        </script><?php
    } else {
        $result = mysqli_query($link, $qry);
        $row = mysqli_fetch_array($result);
        $hash = $row['hash'];

        if($row['email_confirmed'] == 0){
            ?><script>
                $(document).ready(function() {
                    $("#error").html('<?php echo "Please confirm your email. If you need another e-mail, please click <a href='register.php?resend=true&user=$user'>here.</a>"; ?>');
                });
            </script><?php
        }
        else if(verify($pass, $hash)){
            if($remember == "on"){
                $salt       = "SLAVEHACK";

                $identifier = md5($salt . md5($user . $salt));
                $token = md5(uniqid(rand(), true));
                $timeout = time() + 60 * 60 * 24 * 7;

                setcookie('auth', "$identifier:$token", $timeout, "/", ".slavehack-legacy.herokuapp.com");

                if(!mysqli_query($link, "UPDATE `users` SET identifier = '$identifier', timeout = '$timeout', token = '$token' WHERE login = '$user'")){
                    echo mysqli_error($link);
                }
            } else {
                // session_start();
                // $_SESSION['tz'] = $row['timezone']
                $timestamp = $_SERVER['REQUEST_TIME'];
                date_default_timezone_set('UTC');

                if(isset($_SESSION['tz'])){
                    $tz = $_SESSION['tz'];                    
                } else {
                    $tz = "America/Chicago";
                }

                $dtzone = new DateTimeZone($tz);
                $dtime = new DateTime();

                $dtime->setTimestamp($timestamp);
                $dtime->setTimeZone($dtzone);

                $time = $dtime->format('g:i A m/d/y');       
            }
            ?><script>
                $(document).ready(function() {
                    $("#date").html('<?php echo $time; ?>');
                    $("#logswitch").html("<a href='logout.php'>Logout</a>");
                    // Changed $logTime to $time to check for variable naming mismatch
                    $("#success").html('<?php echo "Successfully logged in at: ".$logTime."- you will be redirected in 3 seconds."; ?>');
                    window.setTimeout( function() {
                        window.location.reload();
                    }, 3000);
                });
            </script><?php
        } else {
            ?><script>
                $(document).ready(function() {
                    $("#error").html("Invalid username or password.");                    
                });
            </script><?php
        }
    }
}

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
            Login
        </title>
        <?php clock_head() ?>
    </head>
    <body onload="startTime()">
    <?php menu() ?>

    <div id = "wrapper">
        <div id = "entryBlock">
            <div id="ipLog">
                116.96.54.52@loginServer
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>Log in</b><br /><br />
                    </div>
                    <div id="error"></div><div id="success"></div>
                    <form id="register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input style="text-align: center; margin-bottom: 2px;" type = "text" name = "user" placeholder="Username" autocomplete = "off"><br>
                        <input style="text-align: center; margin-bottom: 2px;" type = "password" name = "pass" placeholder="Password" autocomplete = "off"><br />
                        <input style="text-align: center; margin-bottom: 2px;" type = "checkbox" name = "remember"><label><span>Keep me logged in</span></label><br><br />
                        <input type = "submit" value = "Login" name = "login" id = "login">
                    </form>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>

<?php

//COOKIE CHECK//

if(isset($_COOKIE['auth'])){
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

    if ($result = mysqli_query($link, $qry)){
        if(mysqli_num_rows($result)){
            $record = mysqli_fetch_assoc($result);

            if($clean['token'] != $record['token']){
                echo("Invalid token.");
            }
            else if($now > $record['timeout']){
                echo("Timeout detected.");
            }
            else if($clean['identifier'] != md5($salt .md5($record['username'] . $salt))) {
                echo("Invalid identifier.");
            }
            else {
                echo("Login success.");
            }
        }
    }
}

////////////////

if(isset($_SESSION['tz'])){
    $tz = $_SESSION['tz'];
} else {
    $tz = "America/Chicago";
}

if(isset($_SESSION['user'])){
    ?><script>
        $("#gameswitch").html("<a href='/game/index.php?login=success'>Game</a>");
        $("#logswitch").html("<a href='logout.php'>Logout</a>");
    </script><?php
} else {
    ?><script>
        $("#gameswitch").html("");
        $("#logswitch").html("<a href='login.php'>Login</a>");
    </script><?php
}

?>
<script>
    $("#date").html('<?php echo $time; ?>');
</script>