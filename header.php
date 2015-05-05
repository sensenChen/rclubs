              <!--          <html>
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
        <div class="heading_underline"></div>
        
            
        <div id="search" class="ui-widget">
            <form method="post" action="../php/display_result.php">
                <input name="mysearch" id="searchbar" placeholder="Search for Clubs"/>
            </form>
        </div> 
        
        <a href="http://rclubs.me/allClubs"><div id="AllClubs" class="button">
                <?php
    				echo("All Clubs");
    		?> 
    	</div></a>   
               
        <a href="http://rclubs.me/about"><div id="about" class="button">    
         	<?php
                	if (!isset($_SESSION['myusername']))
    				{echo("About");}
    		?> 
    	</div></a>
    	

        <a href="http://rclubs.me/chat"><div id="chat" class="button">
        	<?php
                	if (isset($_SESSION['myusername']))
    				{echo("Chat");}
    		?> 
    	</div></a>
        <a href="http://rclubs.me/account"><div id="account" class="button">
        	<?php
                	if (isset($_SESSION['myusername']))
    				{echo("Account");}
    		?> 
    	</div></a>
        <a href="http://rclubs.me/feedback"><div id="contact" class="button">Feedback</div></a>
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
    	
        <a href="http://rclubs.me/myclubs/"><div id="myclubs" class="button">
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
</html>       -->                      
                            
                            

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script type="text/javascript" src="../js/autocomplete.js"></script>
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
        
        <title>rClubs</title> 
    </head>
        
    <body>
        <div class="container">
            
            <ul id="nav">
                <li><a href="http://rclubs.me"><img class="logo2" src="../images/rClubs2.png"></a></li>
                <li><a href="http://rclubs.me">Home</a></li>
                <li><a href="http://rclubs.me/about">About</a></li>
                <li><a href="http://rclubs.me/allClubs">Browse Clubs</a></li>
                <li><a href="http://rclubs.me/login">
                    <?php
                	   if (!isset($_SESSION['myusername']))
    				    {echo("Login");}
                    ?> 
                </a></li>
                <li><a href="http://rclubs.me/signup">
                    <?php
                	   if (!isset($_SESSION['myusername']))
    				    {echo("Signup");}
                    ?> 
                </a></li>
                <li><a href="#s1">
                    <?php
                	   if (isset($_SESSION['myusername']))
    				    {echo("Account");}
                    ?> 
                </a>
                    <?php if(isset($_SESSION['myusername'])){ ?>
                           <span id="s1"></span>
                           <ul class="subs">
                                <ul>
                                    <li><a href="http://rclubs.me/account">Profile</a></li>
                                    <li><a href="http://rclubs.me/myclubs">MyClubs</a></li>
                                    <li><a href="http://rclubs.me/chat">Chat</a></li>
                                    <li><a href="http://rclubs.me/login/logout.php">Logout</a></li>
                                </ul>
                            </ul>    
                    <?php } ?>  
                </li>
                <li id="searchbar2">
                    <form method="post" action="../php/display_result.php" id="search2">
                        <input name="mysearch" type="text" size="40" placeholder="Search For Clubs..." />
                    </form>
                </li>                

            </ul>

        </div>
    </body>
</html>
                 
                            
                            