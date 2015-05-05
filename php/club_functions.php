                                                                <?php
//This file contains commonly used functions for managing clubs

function connectToDatabase()
{
    //MySQL database information
    $host="localhost"; 
    $username="rclubsme_user";
    $password="rpi123"; 
    $db_name="rclubsme_users"; 
    $tbl_name="Clubs";

    //Connect to server and select databse.
    mysql_connect("$host", "$username", "$password")or die("cannot connect");
    mysql_select_db("$db_name")or die("cannot select DB");
}

function searchClubUrl($word)
{
    mysql_select_db("rclubsme_users")or die("cannot select DB");
    $query = "SELECT * FROM Clubs"; 
    $result = mysql_query($query) or die(mysql_error());

    while($row = mysql_fetch_array($result)){
    	if (strpos(strtolower($row['name']),strtolower($word)) !== false) {
            return $row['urlname'];
	   }
    }
    
    return "";
}

function getUserAndClubId($username, $clubname)
{
    mysql_select_db("rclubsme_users")or die("cannot select DB");
    //search for user id
    $myuserid = getUserId($username);

    //search for club id
    $sql = "SELECT * FROM Clubs WHERE urlname='$clubname'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    $myclubid = $db_field['clubid'];

    return array($myuserid, $myclubid);
}

function getUserId($username)
{
    mysql_select_db("rclubsme_users")or die("cannot select DB");
    $sql = "SELECT * FROM Users WHERE username='$username'";
    $result = mysql_query($sql);
    $db_field = mysql_fetch_assoc($result);
    return $db_field['userid'];
}

function isClubAdded($userid, $clubid)
{

    mysql_select_db("rclubsme_userdata")or die("cannot select DB");

    //Checks to see if the user already added the club to the MyClubs list
    $tbl_name = $userid . "_Clubs";
    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name (entryid int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, clubid int(10))";
    mysql_query($sql);
    
    $sql = "SELECT * FROM $tbl_name WHERE clubid='$clubid'";
    $result = mysql_query($sql);
    return (mysql_num_rows($result) != 0); 
}

function isUserAdded($userid, $clubid)
{
    mysql_select_db("rclubsme_clubdata")or die("cannot select DB");

    //Checks to see if the user already added the club to the MyClubs list
    $tbl_name = $clubid . "_Users";
    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name (entryid int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userid int(10), boolean)";
    mysql_query($sql);
    $sql = "SELECT * FROM $tbl_name WHERE userid='$userid'";
    $result = mysql_query($sql);
    return (mysql_num_rows($result) != 0);  
}


function validURL($text)
{
    // Swap out Non "Letters" with a -
    $text = preg_replace('/[^\\pL\d]+/u', '-', $text); 

    // Trim out extra -'s
    $text = trim($text, '-');

    // Convert letters that we have left to the closest ASCII representation
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

    // Make text lowercase
    $text = strtolower($text);

    // Strip out anything we haven't been able to convert
    $text = preg_replace('/[^-\w]+/', '', $text);
    
    if(strlen($text) == 0)
    	$text = md5($text);

    return $text;
}


function insertClub($clubname, $location, $meetingdays, $starttimes, $endtimes) //Adds the club to the database
{
	mysql_select_db("rclubsme_users")or die("cannot select DB");
	$tbl_name = 'Clubs';
	$urlname = str_replace(' ', '_', $clubname);
	$urlname = validURL($urlname);
	
	$sql = "SELECT * FROM $tbl_name WHERE name='$clubname' OR urlname ='$urlname'";
   	$result = mysql_query($sql);
    	if (mysql_num_rows($result) != 0) {
    		echo "This club already exists";
    		return false;
    	} 
	
        
	$clubname = mysql_real_escape_string($clubname);
	$location = mysql_real_escape_string($location);
	
	$daytime ="";
	for ($i = 0; $i < count($meetingdays); $i++) {
		$starttime = date("G:i", strtotime($starttimes[$i])); 
        	$endtime = date("G:i", strtotime($endtimes[$i]));
		if($i>0) 
			$daytime .= ';';
		$daytime .= $meetingdays[$i] . '_' . $starttime . '_' . $endtime;
	} 
	
	$sql = "INSERT INTO $tbl_name (urlname, name, location, day_time, public) VALUES ('$urlname', '$clubname', '$location', '$daytime', true)";
	$result = mysql_query($sql);
	return true;
}


function changeDayTime($clubid, $meetingdays, $starttimes, $endtimes) //Adds the club to the database
{
	mysql_select_db("rclubsme_users")or die("cannot select DB");
	$tbl_name = 'Clubs';
        
	
	$daytime ="";
	for ($i = 0; $i < count($meetingdays); $i++) {
		$starttime = date("G:i", strtotime($starttimes[$i])); 
        	$endtime = date("G:i", strtotime($endtimes[$i]));
		if($i>0) 
			$daytime .= ';';
		$daytime .= $meetingdays[$i] . '_' . $starttime . '_' . $endtime;
	} 
	
	
	$sql = "UPDATE $tbl_name SET day_time='$daytime' WHERE clubid='$clubid'";
	$result = mysql_query($sql);
	return true;
}


function addClub($userid, $clubid) //Adds club to the user's list
{
    mysql_select_db("rclubsme_userdata")or die("cannot select DB");
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $tbl_name = $userid . "_Clubs";
    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name (entryid int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, clubid int(10))";
    mysql_query($sql);
    
    $query = "INSERT INTO $tbl_name (clubid) VALUES ('$clubid')";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        echo "Club successfully added to the MyClubs list<br/>";
    }
}

function addUser($userid, $clubid) //Adds user to the club's list
{
    mysql_select_db("rclubsme_clubdata")or die("cannot select DB");
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $tbl_name = $clubid . "_Users";
    $sql = "CREATE TABLE IF NOT EXISTS $tbl_name (entryid int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, userid int(10), admin boolean)";
    mysql_query($sql);
    
    $query = "INSERT INTO $tbl_name (userid,admin) VALUES ('$userid',false)";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        return "User successfully added to the Club's list<br/>";
    }
}

function deleteClub($userid, $clubid)
{
    mysql_select_db("rclubsme_userdata")or die("cannot select DB");
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $tbl_name = $userid . "_Clubs";
    //Delete this entry in the MyClubs table
    $query = "DELETE From $tbl_name WHERE clubid='$clubid'";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        echo "Club successfully removed from your MyClubs list.<br/>";
    }
}

function deleteUser($userid, $clubid)
{
    mysql_select_db("rclubsme_clubdata")or die("cannot select DB");
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $tbl_name = $clubid . "_Users";
    //Delete this entry in the MyClubs table
    $query = "DELETE From $tbl_name WHERE userid='$userid'";
    $data = mysql_query($query)or die(mysql_error());
    if($data)
    {
        return "User successfully removed from the Club's list.<br/>";
    }
}

function isAdmin($userid, $clubid)
{
    mysql_select_db("rclubsme_clubdata")or die("cannot select DB");
    //Add a new entry in the MyClubs table that maps the user id to the club id
    $tbl_name = $clubid . "_Users";
    //Delete this entry in the MyClubs table
    $query = "SELECT * From $tbl_name WHERE userid='$userid'";
    $data = mysql_query($query);
    $db_field = mysql_fetch_assoc($data);
    return $db_field['admin'];
}

function makeAdmin($userid, $clubid)
{
    mysql_select_db("rclubsme_clubdata")or die("cannot select DB");
    $tbl_name = $clubid . "_Users";
    $query = "UPDATE $tbl_name SET admin=1 WHERE userid='$userid'";
    $data = mysql_query($query);
}

function getDaytimeHours($day_time)
{
    mysql_select_db("rclubsme_users")or die("cannot select DB");
    
    //return "Not Available!" if time of meetings are empty or not in database
    if($day_time == ""){return "Not Available!";}
    
    //split the string into separate days
    $days = explode(";", $day_time);
    $numDays = count($days);

    //split the string into the day of the week, start time, and end time
    for ($i = 0; $i < $numDays; $i++)
    {
       $times = explode("_", $days[$i]);	//split time into day of week, time of start of meeting, and time of end of meeting
       
       //convert the start and end hours to "am" or "pm"
       $start = date("g:i a", strtotime($times[1])); 
       $end = date("g:i a", strtotime($times[2]));

       //do not add a comma if printing last day
       $str .= $times[0] . " " . $start . "-" . $end;
       if($i != $numDays-1)
       {
           $str .= ", ";
       }
    }

    return $str;
}
?>
                            
                            