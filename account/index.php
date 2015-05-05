<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
    require_once('../php/club_functions.php');
    connectToDatabase();
    $username = $_SESSION['myusername'];
    $query = "SELECT * FROM Users WHERE username='$username'";
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) != 1) {
    	echo mysql_num_rows($result);
    	echo " instances of user in database.";
    	echo $username;
    	exit();
    }
    $db_field = mysql_fetch_assoc($result);
    $firstname = $db_field['firstname'];
    $lastname = $db_field['lastname'];
    $email = $db_field['email'];
    $phonenumber = $db_field['phonenumber'];
    $emailnotification = $db_field['emailnotification'];
    $textnotification = $db_field['textnotification'];
?>
<?php 
    include ( "../header/header.php" ); 
?>                          
<html>
<body>
    <form method="post" action="account.php">
        <div class="account" id="accountname"><?php echo "$username"; ?></div>
        <div class="question">
            <input  name="myfirstname" type="text" value = <?php echo $firstname ?> />
            <label>First Name</label>
        </div>
        <div class="question">
            <input  name="mylastname" type="text" value = <?php echo $lastname ?> />
            <label>Last Name</label>
        </div>
        <div class="question">
            <input  name="myemail" type="text" value = <?php echo $email ?> />
            <label>Email</label>
        </div>
        <div class="question">
            <input  name="myphonenumber" type="text" value = <?php echo $phonenumber ?> />
            <label>Phone Number</label>
        </div>
        <button>Save</button>
    </form>
    
</body>
</html>            
                            