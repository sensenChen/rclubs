
//THIS PAGE IS NOT NECESSARY ANYMORE
//THE REGULAR HOME PAGE AND THIS HOME PAGE ARE INTGRATED                      
   <?php
    session_start();

    //make sure user is signed in
    if (!isset($_SESSION['myusername']))
    {
        header("location: index.php");
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>rClubs</title>
        <link type="text/css" rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
  <script type="text/javascript" src="js/autocomplete.js"></script>
    </head>
    <body>
        <div class="heading">
            <a href="http://rclubs.me"><img class="homebutton" src="images/rClubs.png"></a>
            <ul>
                <a href="#"><li class="topbutton" id="left"><font color="#0094e1">About</font></li></a>
                <a href="http://rclubs.me/feedback.html"><li class="topbutton" id="left"><font color="#0094e1">Feedback</font></li></a>
                <a href="http://rclubs.me/login/logout.php"><li class="topbutton" id="right""><font color="#0094e1">Logout</font></li></a>
                <a href="#"><li class="topbutton" id="right"><font color="#0094e1">MyClubs</font></li></a>
            </ul>
        </div>
        <div class="search">
            <div class="logo">
                <center>
                    <img src="/images/rClubs.png" width="20%;">
                </center>
            </div>
            <center>
                <div class="ui-widget">
                    <form method="post" action="php/display_search.php">
                        <input name="mysearch" id="homesearchbar" type="text" placeholder="Search Clubs"/>
                        
                        <input type="submit" value="Search"  />
                    </form>
                </div>
            </center>
        </div>
        <div class="footer">
            <center>
                <ul class="footbar">
                    <a href="#"><li class="bottombutton"><font color="#af0000">r</font><font color="#797979">Clubs</font></li></a>
                    <a href="http://rcos.rpi.edu/projects/rpi-tradebook/"><li class="bottombutton"><font color="#af0000">@RCOS</font></li></a>
                </ul>
            </center>
        </div>
    </body>
</html>                                
                            
                            