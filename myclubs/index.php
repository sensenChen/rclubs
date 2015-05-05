<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
?>
<?php 
  	  include ( "../header.php" ); 
?>
<html>
    <body>
        <?php
            include 'display_myclubs.php';
        ?>
    </body>
</html>
                            
                            
                            
                            
                            
                            