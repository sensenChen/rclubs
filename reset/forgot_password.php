<?php
    session_start();
    if (isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
?>

<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../css/main.css"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <title>rClubs</title>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/autocomplete.js"></script>
    </head>
    
    <body>
        <div class="heading">
            <a href="http://rclubs.me"><img class="homebutton" src="../images/rClubs.png"></a>
            <ul>
            </ul>
        </div>
        
        <div id="search" class="ui-widget">
            <form method="post" action="../php/display_search.php">
                <input name="mysearch" id="searchbar" placeholder="Search for Clubs"/>
            </form>
        </div>
        <a href="http://rclubs.me/about"><div id="about" class="button">About</div></a>
        <a href="http://rclubs.me/feedback.php"><div id="contact" class="button">Feedback</div></a>
        <a href="http://rclubs.me/login"><div id="login" class="button">Login</div></a>
        <a href="http://rclubs.me/signup"><div id="signup" class="button">Signup</div></a>
        <center>
            <div id="bodi">
                <div class="talk">
                    <p id=slogan class="body-text">rClubs</p>
                    <p id="descr" class="body-text">Manage your clubs more easily with our very useful features</p>
                </div>
                <div class="boxes">
                    <form method="post" action="send_reset_email.php">
                        <input name="myemail" id="fbox" type="text" placeholder="email">
                        
                        <input id="register" type="submit" value="SUBMIT">
                    </form>
                </div>
              
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>                                
                            
                            
                            
                            