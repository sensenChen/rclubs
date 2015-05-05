                                                                                                                                <?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Reset"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

//get the email
$myemail=$_POST['myemail'];

//anti-injection
$myemail = mysql_real_escape_string($myemail);

//Make sure the email exists in the Users database
$sql = "SELECT * FROM Users WHERE email='$myemail'";
$result = mysql_query($sql);
$count = mysql_num_rows($result);

//email doesn't exist
if ($count == 0)
{
    exit("The email " . $myemail . " hasn't been registered yet. Please enter a different email.");
}

//generate the reset key
$mykey = $myemail . date('mY'); //Key
$mykey = crypt($mykey); 

echo "A link to reset your password has been sent to " . $myemail . "<br/>";

$query = "SELECT * FROM $tbl_name WHERE email='$myemail'";
$result = mysql_query($query)or die(mysql_error());

if(mysql_num_rows($result) == 0) {
  $query = "INSERT INTO $tbl_name (resetkey, email) VALUES ('$mykey','$myemail')";
}
else {
  $query = "UPDATE $tbl_name SET resetkey='$mykey' WHERE email='$myemail'";
}
$data = mysql_query($query)or die(mysql_error());


if ($data)
{
    //Send reset email
    $mail_body = "Your reset key is " . $mykey . "      Click on this link to reset your password: http://rclubs.me/reset/reset_form.php";
    mail($myemail,"rClubs: Reset Password Link", $mail_body); 
}
?>
                            
                            
                            
                            
                            