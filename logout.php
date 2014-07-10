<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['tz']);
    unset($_SESSION['TWLI']);
    unsert($_SESSION['background']);
    echo "Successfully logged out. <a href='index.php'><br />Click here if you don't want to wait.</a>";
    header("refresh:5;url=index.php");
?>