<?php 
    session_start();
    require_once('../php/club_functions.php');
    require_once('../php/calendar_functions.php');
?>
<?php
    connectToDatabase();
	$myusername = $_SESSION['myusername'];
	if(!isset($_GET['club'])) {
		echo "Club not selected.";
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/myclubs/'>";
	}
	$club = $_GET['club'];

	
	list($myuserid, $myclubid) = getUserAndClubId($_SESSION['myusername'], $club);
	$isAdmin = isAdmin($myuserid, $myclubid);
	
	if(!$isAdmin) {
		echo "Not admin.";
		echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/clubpage/". $club. "'>";
	}
	
	if (isset($_POST['location'])) {
		mysql_select_db("rclubsme_users")or die("cannot select DB");
		$location = $_POST['location'];
		$sql = "UPDATE Clubs SET location='$location' WHERE urlname='$club'";
		mysql_query($sql);
	}
	
	
	$meetingdays = array();
	$starttimes = array();
	$endtimes = array();
	

	for($i=1; $i < 11 ;$i++) {
		if (!($i<11 && ($_POST['meetingday'.$i])!="" && isset($_POST['starttime'.$i]) && isset($_POST['endtime'.$i])))
			continue;
		
		
		$meetingday = $_POST['meetingday'.$i];
		$starttime = $_POST['starttime'.$i];
		$endtime = $_POST['endtime'.$i];
		array_push($meetingdays, $meetingday);
		array_push($starttimes, $starttime);
		array_push($endtimes, $endtime);
	}
	
	changeDayTime($myclubid, $meetingdays, $starttimes, $endtimes);
	
	if (isset($_POST['clubName'])) {
		mysql_select_db("rclubsme_users")or die("cannot select DB");
		$clubName = $_POST['clubName'];
		$urlName = str_replace(' ', '_', $clubName);
		$urlName = validURL($urlName);
		
		$sql = "SELECT * FROM $tbl_name WHERE name='$clubName'";
   		$result = mysql_query($sql);
    		if (mysql_num_rows($result) == 0) {
			$sql = "UPDATE Clubs SET name='$clubName' WHERE urlname='$club'";
			mysql_query($sql);
	
			$sql = "UPDATE Clubs SET urlname='$urlName' WHERE name='$clubName'";
			mysql_query($sql);
			$club = $urlName;
    		} 

		
	}
	
	$client = new Google_Client();
	accessToken($client);
	updateClubCalendar($client, $myclubid);
	
	echo "<meta http-equiv='refresh' content='1.5; url=http://rclubs.me/clubpage/". $club. "'>";
?>