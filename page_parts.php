<?php
function menu()
{
    ?>

    <div id = "bgMenuBar">
        <div class = "logo" style="font-family: 'Oswald', sans-serif;">Slavehack: Legacy</div>
        <ul id = "homeMenu" style="font-family: 'Oswald', sans-serif;">
            <li><a href="index.php">Home</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="terms.php">Terms</a></li>
            <li><span id = "logswitch"></span></li>
        </ul>
    </div>

<?php
}

function footer()
{
    ?>
    <div id = "footer">
        Copyright (C) "Slavehack: Legacy" 2014<br>
        An open-source project founded by Trizzle, developed by WitheredGryphon
    </div>
<?php
}

function content_index(){
    ?>

    <div id = "wrapper">
        <div id = "entryBlock">
            <div id="ipLog">
                127.0.0.1@localhost
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>Welcome to Slavehack: Legacy</b><br /><br />
                    </div>
                    Slavehack: Legacy is the open-source continuation
                    of the original franchise: Slavehack.<br /><br />
                    Slavehack: Legacy is a game about virtual hacking
                    wherein you must conquer your opponents through
                    breaking into their virtual computer and turning
                    them into a "slave", or a computer infected that
                    now will do your bidding. Be careful though, as
                    others are looking to do the same to you.<br /><br />
                    For more information on Slavehack: Legacy, visit
                    the <a href="about.php">about page.</a>
                </div>
            </div>
        </div>
    </div>

<?php
}

function content_news(){
    ?>

    <div id = "wrapper">
        <div id = "entryBlock">
            <div id="ipLog">
                127.0.0.1@localhost
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>Placeholder Title</b><br /><br />
                    </div>
                    News goes here.
                </div>
            </div>
        </div>
    </div>

<?php
}

function content_about(){
    ?>

    <div id = "wrapper">
        <div id = "entryBlock">
            <div id="ipLog">
                127.0.0.1@localhost
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>What is Slavehack: Legacy?</b><br /><br />
                    </div>
                    Slavehack: Legacy is an online hacking simulation
                    game. At no time in this game will you actually hack
                    or be hacked, as <u>this is a virtual game
                        only</u>. Your computer will not be exposed
                    to any exploits or actual software other than
                    the cookies used to play the actual game. If at
                    any time a game-wide exploit has been found that
                    affects real computers, an announcement will be
                    made for all users and the servers will be taken
                    down.<br /><br />

                    When you enter the game you'll be given a very
                    mediocre computer. In Slavehack, your task is to
                    gather computer slaves who will benefit you through
                    different tasks including earning you income to upgrade
                    your rig.<br /><br />

                    In addition to upgrading your rig, you'll also be
                    gathering software such as firewalls, malware,
                    adware, spyware, rootkits, trojans,
                    and more to help you in your endeavors.<br /><br />

                    As you venture the web in search of slaves, you
                    must be diligent, however. Each website you visit
                    will leave a connection log that a player can
                    trace back to your own computer and make you their
                    slave. Fear not, becoming a slave computer is not
                    the end of the world if you've backed up your
                    software.<br /><br />

                    So what's the goal of the game? Make it to the top
                    of the leaderboards.<br /><br />Good luck!
                </div>
            </div>
        </div>
    </div>

<?php
}

function content_terms(){
    ?>
    <!-- Changed the margins due to the amount of space that this page
    will require. -->
    <div id = "wrapper" style="margin-left: 10%; margin-right: 10%;">
        <div id = "entryBlock">
            <div id="ipLog">
                127.0.0.1@localhost
                <div id="date"></div>
            </div>
            <div id="container">
                <div id="message">
                    <div id="title">
                        <b>Terms and Conditions</b><br /><br />
                    </div>
                    Terms and conditions go here.
                </div>
            </div>
        </div>
    </div>

<?php
}

?>