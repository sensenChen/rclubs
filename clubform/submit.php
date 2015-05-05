<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
    require_once('../php/club_functions.php');
    connectToDatabase();
    $username = $_SESSION['myusername'];
    $clubname=$_POST['clubname'];
    $location=$_POST['location'];
  
	
	$meetingdays = array();
	$starttimes = array();
	$endtimes = array();
	
	for($i=1; $i<11 && ($_POST['meetingday'.$i])!="" && isset($_POST['starttime'.$i]) && isset($_POST['endtime'.$i]);$i++) {
		$meetingday = $_POST['meetingday'.$i];
		$starttime = $_POST['starttime'.$i];
		$endtime = $_POST['endtime'.$i];
		array_push($meetingdays, $meetingday);
		array_push($starttimes, $starttime);
		array_push($endtimes, $endtime);
	}
	
		

	
    if(insertClub($clubname, $location, $meetingdays, $starttimes, $endtimes)){
    	echo "This club has been added to the rClubs database.";
    	$userandclubid = getUserAndClubId($username, $clubname);
    	$userid = $userandclubid[0];
    	$clubid = $userandclubid[1];
    	
    	addClub($userid, $clubid);
    	addUser($userid, $clubid);
    	makeAdmin($userid, $clubid);
    	
    	$message='The user' . $username . ' with id ' . $userid . ' has added ' . 
            $clubname . " to rClubs\n" . 'Location: ' . $location . "\n" . 
            'Meetings: ' . $meetingday . ' from ' . $starttime . ' to ' . $endtime;
    	mail("rclubsme@gmail.com","Rclubs: New Club Added to Database",$message);
    }
    echo "<meta http-equiv='refresh' content='3; url=http://rclubs.me/myclubs/'>";
?>