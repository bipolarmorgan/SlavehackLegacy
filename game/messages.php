<table>
	<?php
	$url=parse_url(getenv("CLEARDB_DATABASE_URL"));

	$server = $url["host"];
	$username = $url["user"];
	$password = $url["pass"];
	$db = substr($url["path"],1);

	$link = mysqli_connect($server, $username, $password);
	mysqli_select_db($link, $db) or die("Cannot connect to database.");

	    $fetchQry = "SELECT * FROM messages";
	    if(!mysqli_query($link, $fetchQry)){
	    	echo(mysqli_error($link));
	    } else {
	    	$result = mysqli_query($link, $fetchQry);
	    }

	    while( odbc_fetch_into($result, $row) ){
	    	?>
	    	<tr><td><?php echo($row[1]); ?></td>
	    	<td><?php echo($row[2]); ?></td></tr>
	    	<?php
	    }
	?>
</table>