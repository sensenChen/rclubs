                                                                                                <?php
session_start();

    //make sure user is signed in
    if (!isset($_SESSION['myusername']))
    {
        header("location: index.php");
    }
?>
<?php 
    include ( "../header.php" ); 
?>
<html>
    <body>
        <center>
            <div id="bodi">
                <div class="talk">
                    <p id=slogan class="body-text">Welcome to rClubs!</p>
                    <p id="descr" class="body-text">Search for some clubs that interest you. Like a club? Add it to your MyClubs list.</p>
                </div>
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>                
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            