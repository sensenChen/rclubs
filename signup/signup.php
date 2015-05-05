                                                                                                                                                                                                <?php
$host="localhost"; // Host name
$username="rclubsme_user"; // Mysql username
$password="rpi123"; // Mysql password
$db_name="rclubsme_users"; // Database name
$tbl_name="Users"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];
$repassword=$_POST['repassword'];
$myemail=$_POST['myemail'];

//anti-injection
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$myemail = mysql_real_escape_string($myemail);

//Stores all the error messages as an array
$errors = array();

//make sure user entered a username
if (empty($myusername))
{
    $errors[] = "You didn't enter a valid username.<br/>";
}

//make sure you entered valid passwords
if (strlen($mypassword) < 8 )
{
    $errors[] = "You didn't enter a valid password (8 characters or more).<br/>";
}

//make sure passwords match
if ($mypassword != $repassword)
{
    $errors[] = "Entered passwords don't match.<br/>";
}

//Make sure the email is an RPI email
/*$test = '@rpi.edu';
if(strlen($myemail) < strlen($test) || substr_compare($myemail, $test, -strlen($test), strlen($test)) != 0)
{
    $errors[] = "You didn't enter an RPI email.<br/>";
}*/

//Checks to see if username already exists
$sql = "SELECT * FROM $tbl_name WHERE username='$myusername'";
$result = mysql_query($sql);
if (mysql_num_rows($result) != 0) {
    $errors[] = "Username aleready exists.<br/>";
}

//Checks to see if email already exists
$sql = "SELECT * FROM $tbl_name WHERE email='$myemail'";
$result = mysql_query($sql);
if (mysql_num_rows($result) != 0) {
    $errors[] = "Email already exists.<br/>";
}


//Creates an error message string, and prints it out upon exit.
if (!empty($errors)) {
    $error_message = "";
    foreach($errors as $error) {
        $error_message .=  $error;
    }
    exit($error_message);
}

//Encrypt the password
$mypassword = md5($mypassword);

//Register the user
$query = "INSERT INTO $tbl_name (username, password, email) VALUES ('$myusername','$mypassword', '$myemail')";

$data = mysql_query($query)or die(mysql_error());
if($data)
{
    echo "Registration Complete!<br/>A link has been sent to your email, so please confirm.";
}


//Send confirmation email
$myuserid = mysql_insert_id(); //Get the auto-incremented user id number
$mykey = $myusername . $myemail . date('mY'); //Key
$mykey = md5($mykey); //Hash the key

$tbl_name = "Confirm";

$query = "INSERT INTO $tbl_name VALUES (NULL,'$myuserid','$mykey', '$myemail')";

$data = mysql_query($query)or die(mysql_error());
if($data)
{
    $mail_body = "Your confirmation message link is: http://rclubs.me/confirm/?key=" . $mykey;
    mail($myemail,"Rclubs: Confirmation Link", $mail_body); //Sends the mail with the confirmation link.
}

?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            