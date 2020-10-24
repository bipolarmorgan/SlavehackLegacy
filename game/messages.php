<table>
	<?php
			require "config.php";

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