                                <?php
//I MADE SOME MINOR CHANGES TO YOUR CODE TO IMPLEMENT A SEPARATE DATABASE FOR USERS AND CLUBS
//I THINK THAT IT ORGANIZES THE DATA BETTER AND SETS A BETTER EXAMPLE FOR FUTURE CODING

session_start();
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
    deleteClub($myuserid, $myclubid);
    if (isUserAdded($myuserid, $myclubid))
    	deleteUser($myuserid, $myclubid);
}
else
{
    exit("This club isn't on your MyClubs list.<br/>");
}

//automatically redirect to the MyClubs page
echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>
                            
                            
                            
                            
                            