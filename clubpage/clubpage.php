                                                                <?php 
    session_start();
    require_once('../php/club_functions.php');
    require_once('../php/calendar_functions.php');
?>
<?php 
  include ( "../header.php" ); 
?>
<?php
    connectToDatabase();	
    if(isset($_GET['c'])) {   //Get club name from link
        $myurl = mysql_real_escape_string($_GET['c']);   //Store club name in variable
    	
        	
        //Check if club is valid and in database, then get information about the club
        if(preg_match("/^[a-zA-Z0-9_\-]+$/", $myurl)){
            $check = mysql_query("SELECT urlname, name, location, day_time, public FROM Clubs WHERE urlname = '$myurl'");
            if(mysql_num_rows($check)==1){
                $get = mysql_fetch_assoc($check);
                $clubname = $get['name'];
                $location = $get['location'];
                $day_time = $get['day_time'];
                $hours = getDaytimeHours($day_time);
                $public = $get['public'];
                
                list($myuserid, $myclubid) = getUserAndClubId($_SESSION['myusername'], $myurl);
                $isMember = isUserAdded($myuserid, $myclubid);
                $isAdmin = isAdmin($myuserid, $myclubid);
                
                $client = new Google_Client();
		accessToken($client);
		createClubCalendar($client, $myclubid);
		
		$check = mysql_query("SELECT calendar FROM Clubs WHERE urlname = '$myurl'");
		$get = mysql_fetch_assoc($check);
		$calendar = $get['calendar'];
	}
                
           }else{
                echo "<strong>Club does not exist!</strong>";
                exit();
            }
        }

   
?>

<div class="clubbar">
<?php
session_start();

if (!isset($_SESSION['myusername'])) {
    echo "Want to bookmark this club? Login or signup for a new account.<br/>";
}
else
{
    echo "<br/>";

    //Display either an "add" or "delete" button, but not both

    //Get data
    $myusername = $_SESSION['myusername'];

   //Get the user and club id
   list($myuserid, $myclubid) = getUserAndClubId($myusername, $myurl);

    //Checks to see if the user already added the club to the MyClubs list
    if (!isClubAdded($myuserid, $myclubid)) {
       echo "<a href=http://rclubs.me/myclubs/add_club.php?club=".$get['urlname']." class=add_club>";
       echo "Add Club";
       echo "</a>";

       //echo "<br/>";
    }
    else
    {
        echo "<a href=http://rclubs.me/myclubs/delete_club.php?club=".$get['urlname']." class=delete_club>";
        echo "Delete Club";
        echo "</a>";       
    }
    mysql_select_db("rclubsme_users")or die("cannot select DB");

}                     
?>
</div>



<span id="pageType">
	<?php
		require_once('../clubpage/about.php');
	?>
</span>