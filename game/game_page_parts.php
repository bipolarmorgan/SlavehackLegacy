<?php
// Function order determined from page's code content from top to bottom.

// Awaiting approval to move user login/logout check scripts.
function clock_head() {
    ?>

    <script>
        function startTime() {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            var mm=today.getMonth()+1;
            var dd=today.getDate();
            var yyyy=today.getFullYear()
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('timedate').innerHTML = h+":"+m+":"+s+" - "+mm+"/"+dd+"/"+yyyy;
            var t = setTimeout(function(){startTime()},500);
        }

        function checkTime(i) {
            if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>

<?php
}

function capta_check() {
    ?>

    <div id = "userinfo">
        <div id = "recaptcha_div">
		    <div id = "captcha_block"></div>
		</div>
    </div> <!-- Inserted to close div userinfo -->

<?php
}

function side_menu() {
    ?>

    <div id = "leftColumn">
        <ul>
            <li><a href = "index.php"><img src = "img/ico_comp.png">My Computer</a></li>
            <li><a href = "processes.php"><img src = "img/ico_procs.png">Processes</a></li>
            <li><a href = "logs.php"><img src = "img/ico_logs.png">Computer Logs</a></li>
            <li><a href = "files.php"><img src = "img/ico_files.png">Files</a></li>
            <li><a href = "internet.php"><img src = "img/ico_world.png">Internet</a></li>
            <li><a href = "slaves.php"><img src = "img/ico_slaves.png">My Slaves</a></li>
            <li><a href = "../logout.php"><img src = "img/ico_logout.png">Logout</a></li>
        </ul>
    </div>

<?php
}

function user_bg() {
    ?>

    <script>

        // Add IF statement to pull user bg from database if it exists, otherwise use default.

        // Added field MEDIUMBLOB to database in players table to store images when upload code is finished
        // Maximum image size is 16Mb for the field type MEDIUMBLOB

        var img = new Image();
        img.src = "backgrounds/background.png";
        document.body.background = img.src;
    </script>

<?php
}

?>
