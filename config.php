<?php
	$server = "127.0.0.1";
    $username = "root";
    $password = "";
    $db = "SHL";
    
    $link = mysqli_connect($server, $username, $password, $db);
    
    if (!$link) {
        die("Connection Failed: ".mysqli_connect_error());
    }
?>