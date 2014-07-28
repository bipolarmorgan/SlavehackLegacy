<table>
	<?php
		include_once('../config.php');
		$link   = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
	    mysqli_select_db($link, DB_NAME) or die("Cannot connect to database.");
	    $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

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