                                                                                                <?php
session_start();
//I MADE SOME MINOR CHANGES TO YOUR CODE TO IMPLEMENT A SEPARATE DATABASE FOR USERS AND CLUBS
//I THINK THAT IT ORGANIZES THE DATA BETTER AND SETS A BETTER EXAMPLE FOR FUTURE CODING


/*
if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

require_once('../php/club_functions.php');

connectToDatabase();

//Get data
$myclub=$_GET['club'];
$myusername = $_SESSION['myusername'];

//Get the user and club id
list($myuserid, $myclubid) = getUserAndClubId($myusername, $myclub);

//Checks to see if the user already added the club to the MyClubs list
if (isClubAdded($myuserid, $myclubid)){
    exit("This club has already been added to your MyClubs list.<br/>");
}

addClub($myuserid, $myclubid);

//automatically redirect to the MyClubs page
echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
*/

if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

require_once('../php/club_functions.php');
connectToDatabase();



//Get data
$myclub=$_GET['club'];
$myusername = $_SESSION['myusername'];
list($myuserid, $myclubid) = getUserAndClubId($myusername, $myclub);

//If the wrong club name was entered in te url.
if($myclubid == 0)
	exit("This club does not exist.");



//checks to see if table of name $userid_$username_clubs exists, and if not, creates one

mysql_select_db("rclubsme_userdata")or die($db_name);



//Checks to see if the user already added the club to the MyClubs list
if (isClubAdded($myuserid, $myclubid)){
    exit("This club has already been added to your MyClubs list.<br/>");
}
else {
	addClub($myuserid, $myclubid);
}
if (!isUserAdded($myuserid, $myclubid)){
    addUser($myuserid, $myclubid);
}

//automatically redirect to the MyClubs page
echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";

?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            