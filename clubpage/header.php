                                <?php
    session_start();
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
        </div> 
        
            
        <div id="search" class="ui-widget">
            <form method="post" action="../php/display_result.php">
                <input name="mysearch" id="searchbar" placeholder="Search for Clubs"/>
            </form>
        </div>    
        <a href="http://rclubs.me/about"><div id="about" class="button">About</div></a>
        <a href="http://rclubs.me/feedback.php"><div id="contact" class="button">Feedback</div></a>
        <a href="http://rclubs.me/login"><div id="login" class="button">
                <?php
                	if (!isset($_SESSION['myusername']))
    				{echo("Login");}
    		?> 
        </div></a>
        <a href="http://rclubs.me/signup"><div id="signup" class="button">
                <?php
                	if (!isset($_SESSION['myusername']))
    				{echo("Signup");}
    		?> 
    	</div></a>
        <a href="http://rclubs.me/myclubs"><div id="myclubs" class="button">
                <?php
                	if (isset($_SESSION['myusername']))
    				{echo("MyClubs");}
    		?> 
        </div></a>
        <a href="http://rclubs.me/login/logout.php"><div id="logout" class="button">
                <?php
                	if (isset($_SESSION['myusername']))
    				{echo("Logout");}
    		?> 
        </div></a>
        
    </body>
</html>
                            
                            
                            
                            
                            