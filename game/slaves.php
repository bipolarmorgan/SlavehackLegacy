<?php
//session_start();
include('game_page_parts.php');
?>

<html>
<head>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:700,400' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="http://www.google.com/recaptcha/api/js/recaptcha_ajax.js"></script>
    <script type="text/javascript" src="../js/jQuery.js"></script>
    <link rel="stylesheet" type="text/css" href="backgrounds/desktop.css">

    <title>SHL - Slaves</title>

    <?php clock_head() ?>

</head>
<body onload="startTime()">

<?php side_menu() ?>

<div id = "background">
    <div id = "container">
        <div id = "header">
            <span id = "ipuser"></span>
            <span id = "timedate"></span>
        </div>
        <hr>
        <div id = "title">Slaves</div>
        <div id = "wrapper">
            <form>
                <script>
                    function showBankChooser(target, source, hide) {
                        document.getElementById(target).innerHTML = document.getElementById(source).innerHTML;
                        <?php
                            // Get player's banks in array from table
                            // Temp testing data
                            $banks = array();
                            $banks = ["135.122.214.119 - 378987", "217.56.191.88 - 874638", "244.114.81.111 - 321875"];
                        ?>
                    }
                </script>
                <div style="text-align: right; margin-right: 20px;">
                    <a href='#' onclick="showBankChooser('place', 'rep_place', 'toHide'); return false"><b>Collect All</b></a>
                </div>

                <div id="place" style="text-align: right; margin-right: 20px;"></div>
            </form>
            <div id="replacements" style="display:none">
                        <span id="rep_place">
                            <?php
                            $numBanks = count($banks);
                            if($numBanks <= 0){
                                echo "You need to setup a bank account.";
                            } else {
                                echo "<select>";
                                for($h = 0; $h < $numBanks; $h++){
                                    echo "<option value = ".$h." >".$banks[$h]."</option >";
                                }
                                echo "</select>
                                          <input type='submit' value='Transfer' onclick='collectAll()'>";
                            }
                            ?>
                        </span>
            </div>
            <div class="slaves_table">

                <table>
                    <?php
                    // Should we create a new "slaves" table for each player?
                    /*
                    $slave_query = "SELECT slaves FROM $user = '".mysql_real_escape_string($player)."'";
                    $slave_result = mysql_query($slave_query) or die ("no slaves");

                    $slaves_array = array();
                    while($row = mysql_fetch_assoc($slave_result))
                    {
                        $slaves_array[] = $row;
                    }
                    */

                    // Temporary const data for testing
                    $slave_IP = ["192.168.0.0", "192.168.0.1", "192.168.1.0", "192.168.1.1"];
                    $slave_pass = ["lkmnasgl", "viemnsew", "agdjneqb", "aldvfnio"];
                    $slave_spam = ["0.2", " - ", " - ", " - "];
                    $slave_warez = [" - ", "0.5", " - ", " - "];
                    $slave_ddos = ["0.2", " - ", " - ", "0.9"];
                    echo "<tr><td>Slave IP</td><td>Password</td><td>Spam</td><td>Warez</td><td>DDoS</td><td>Action</td></tr>";
                    $slaves = 4;
                    for($i = 0; $i < $slaves; $i++){
                        echo "<tr><td>".$slave_IP[$i]."</td><td>".$slave_pass[$i]."</td><td>".$slave_spam[$i]."</td><td>".$slave_warez[$i]."</td><td>".$slave_ddos[$i]."</td><td><a href='#' onclick='collectIP(); return false'>Collect</a> / <a href='#' onclick='deleteIP(); return false'>Delete</a></td></tr>";
                    }

                    ?>

                </table>
            </div>


        </div>
    </div>
</div>

</body>
</html>