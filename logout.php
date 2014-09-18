<?php
setcookie('auth', 'deleted', time() - 3600);
session_start();
unset($_SESSION['user']);
unset($_SESSION['tz']);
unset($_SESSION['TWLI']);
unset($_SESSION['ip']);
unset($_SESSION['pass']);

header("refresh:5;url=index.php");

echo "
    <html>
        <head>
            <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
            <link rel='stylesheet' type='text/css' href='css/main.css'>
        </head>

        <body bgcolor='black' style='color: #FFFFFF; text-align: center;'>

            <div id = 'wrapper'>
                <div id = 'entryBlock'>
                    <div id='ipLog'>
                        127.0.0.1@localhost
                        <div id='date'></div>
                    </div>
                    <div id='container'>
                        <div id='message'>
                            <div id='title'>
                                <b>Logging Out</b><br /><br />
                            </div>
                            You have successfully logged out of Slavehack: Legacy<br />
                            <a href='index.php'>Click here if you don't want to wait.</a>
                         </div>
                    </div>
                </div>
            </div>
            <div id = 'footer'>
                <a href='http://jigsaw.w3.org/css-validator/check/referer'>
                <img style='border:0;width:88px;height:31px' src='http://jigsaw.w3.org/css-validator/images/vcss' alt='Valid CSS!' /></a>
                Copyright (C) 'Slavehack: Legacy' 2014<br>
                An open-source project founded by Trizzle, developed by WitheredGryphon
            </div>
        </body>
    </html>";
?>