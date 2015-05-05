<?php
    session_start();

    //MySQL information
    $host="localhost"; 
    $username="rclubsme_user"; 
    $password="rpi123"; 
    $db_name="rclubsme_users"; 
    $tbl_name="Users"; 

    // Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");

    // username and password sent from form
    $myusername=$_POST['myusername'];
    $mypassword=$_POST['mypassword'];

    // To protect from MySQL injection
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string($myusername);
    $mypassword = mysql_real_escape_string($mypassword);

    //make sure to encrypt password before checking
    $mypassword = md5($mypassword);

    $sql = "SELECT * FROM $tbl_name WHERE (username='$myusername' OR email='$myusername') AND password='$mypassword'";
    $result = mysql_query($sql);

    $count = mysql_num_rows($result);

    $db_field = mysql_fetch_assoc($result);
    $isactivated = $db_field['activated'];

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1)
    {
        //Make sure the user's account is activated
        if ($isactivated == 1)
        {
             $_SESSION['myusername'] = $myusername;
             $_SESSION['mypassword'] = $mypassword;
             header("location:login_success.php");
        }
        else
        {
             echo "Your account hasn't been activated yet.<br/>";
             echo "Please check your email at " . $db_field['email'] . " to activate your account.";
        }
    }
    else 
    {
        //wait half a second
        sleep(.5);
        header('location:index.php?invalid=true');
    }
?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            