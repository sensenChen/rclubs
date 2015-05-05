                                                                                                <?php
session_start();
if (!isset($_SESSION['myusername'])) {
    header("location: http://rclubs.me");
}

require_once('../php/club_functions.php');
require_once('../php/calendar_functions.php');

connectToDatabase();

$myusername = $_SESSION['myusername'];

//search for user id
$myuserid = getUserId($myusername);

echo "Username: ". $myusername . "<br/><br/>";
echo "Clubs added: <br/>";

mysql_select_db("rclubsme_userdata")or die("cannot select DB");
$tbl_name = $myuserid . "_Clubs";
$check = mysql_query("SELECT clubid FROM $tbl_name");
if(mysql_num_rows($check) == 0)
{
    exit("No clubs saved.<br/>");
}

//notify the user when there's a club meeting
$notifications = array();

//get the current day of the week
date_default_timezone_set('America/New_York');
$currentday = date("l");

$str = "<iframe src='https://www.google.com/calendar/embed?title=Schedule&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;";
$colors = array('%238C500B', '%23AB8B00', '%236B3304', '%2342104A', '%232F6309', '%231B887A', '%23853104', '%236B3304', '%23333333', '%23125A12');
$counter = 0;

while ($row = mysql_fetch_assoc($check)) 
{
    $myclubid = $row['clubid'];
    //search for club name 
    
    mysql_select_db("rclubsme_users")or die("cannot select DB");
    $sql = "SELECT * FROM Clubs WHERE clubid='$myclubid'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubname = $db_field['name'];
    $meetingdays = $db_field['day_time'];
    $calendar = $db_field['calendar'];

    //print each club found (provide a link to the clubpage)
    echo "<a href=http://rclubs.me/clubpage/" . $db_field['urlname'] . ">";
    echo $myclubname . "</a>";
    echo "<br/>";

    //notify the user if there is a meeting on this day (for example Friday)
    //make sure to mention the time
    $days = explode(";", $meetingdays);
    $size = count($days);
    for ($i = 0; $i < $size; $i++)
    {
       if (strpos($days[$i], $currentday) !== false)
       {
           $hours = explode("_", $days[$i]);
           $start_time = $hours[1];
           $notifications[] = $myclubname . " at " . date('h:i a', strtotime($start_time)) . " in " . $db_field['location'] . "<br/>"; 
       }
    }
    
    if($calendar) {
    	$str .= "src=" . str_replace('@', '%40', $calendar) . "&amp;color=" . $colors[$counter] . "&amp;";
   	$counter++;
   }
}

$str .= "ctz=America%2FNew_York' style=' border-width:0 ' width='800' height='600' frameborder='0' scrolling='no'></iframe>";

echo "<br/><h3>Today is " . $currentday . "</h3>";

//Creates a notification message string
if (!empty($notifications)) {
    $message = "You have meetings for the following clubs:<br/>";
    foreach($notifications as $msg) {
        $message .=  $msg;
    }
    echo $message;
}
else
{
    echo "You have no club meetings today.<br/>";
}

echo "<center>" . $str . "</center>";
?>

                            
                            
                            