                                                                <?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Confirm"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form
$mykey=$_GET['key'];

//anti-injection
$mykey = mysql_real_escape_string($mykey);

//Checks to see if the key exists in the confirm table
$sql = "SELECT * FROM $tbl_name WHERE confirmkey='$mykey'";  
$result = mysql_query($sql);
$count = mysql_num_rows($result);

if ($count != 1) {
	echo("Make sure you have a valid confirmation link.");
}

//Get does not correspond to a key in the confirmation table
//$sql = "SELECT * FROM $tbl_name";
//$result = mysql_query($sql);
//$db_field = mysql_fetch_assoc($result);
//echo($db_field['key']);
//echo(($db_field['key'] == $mykey)+2);
//if ($db_field['key'] != "a9888c0f267130a880c17b7c456f1532") {
  //  echo("Make sure that you have a valid confirmation link.");
//}

//Updates the activated status of the user
else {
    //Stores the userid and email from the confirm table
    $db_field = mysql_fetch_assoc($result);
    $myuserid = $db_field['userid'];
    $myemail = $db_field['email'];

    echo "Email: " . $myemail . "<br/>";

    //Access users table now
    $tbl_name="Users";
    $sql = "SELECT * FROM $tbl_name WHERE userid='$myuserid' AND email='$myemail'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) != 1) {
        exit("User exists " . mysql_num_rows($result) . " times in database.");
    }

    $db_field = mysql_fetch_assoc($result);
    $myusername = $db_field['username'];
    echo "Username: " . $myusername. "<br/>";

    //Changes the activated status of the user
    $sql = "UPDATE $tbl_name SET activated='1' WHERE userid='$myuserid' AND email='$myemail'";
    mysql_query($sql);
    echo("Congratulations! Your email was confirmed, so your account is now active.");

    //Delete element from confirm table
    $sql = "DELETE FROM Confirm WHERE userid='$myuserid' AND email='$myemail'";
    mysql_query($sql);
}

?>

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            