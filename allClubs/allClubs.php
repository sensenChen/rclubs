                                                                                                <?php
session_start();

require_once('../php/club_functions.php');

connectToDatabase();

mysql_select_db("rclubsme_users")or die("cannot select DB");
$tbl_name = "Clubs";

// Array used to store clubs' IDs as key and clubs' names as value.
$sorted_clubs = [];

// Get clubid and its name from database.
$loop = mysql_query("SELECT clubid, name FROM $tbl_name")
   or die (mysql_error());

// Loop through every club in database and store its ID and name in array.
while ($row = mysql_fetch_array($loop))
{
	$myclubid = $row['clubid'];
	$myclubname = $row['name'];
	$sorted_clubs[$myclubid] = $myclubname;
}

// Sort (case insensive) the array by value (club name).
natcasesort($sorted_clubs);

// Print each club's name and linking it to club page.
foreach($sorted_clubs as $myclubid => $myclubname){
	$sql = "SELECT urlname FROM Clubs WHERE clubid='$myclubid'";
   	$result = mysql_query($sql);
   	$db_field = mysql_fetch_assoc($result);
    	$myurlname = $db_field['urlname'];

	echo "<a href=http://rclubs.me/clubpage/" . $myurlname . ">";
    	echo $myclubname . "</a>";
   	echo "<br/>";
}


?>
                            
                            
                            