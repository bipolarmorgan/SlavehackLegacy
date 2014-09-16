<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['tz']);
    unset($_SESSION['TWLI']);
    unset($_SESSION['ip']);
    unset($_SESSION['pass']);

    header("refresh:5;url=index.php");

    echo "
    <html>
    <body bgcolor='black' style='color: #FFFFFF; text-align: center;'>
You have successfully logged out of Slavehack: Legacy<br />
<a href='index.php'>Click here if you don't want to wait.</a>
    </body>
    </html>";
?>