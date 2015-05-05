                                                                <?php
    session_start();
    if (isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
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
                    <p id=slogan class="body-text">rClubs</p>
                    <p id="descr" class="body-text">Manage your clubs more easily with our very useful features</p>
                </div>
                <div class="boxes">
                    <p id="confirmfont" class="body-text"> <?php include 'confirm.php';?> </p>
                </div>
            </div>
            
            <div class="bottom">
                <p id="why" class="bottom-text">Why should you use rClubs?</p>
            </div>
        </center>
    
        
    </body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            