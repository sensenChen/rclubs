<?php
	require_once('../google-api-php-client-master/src/Google/autoload.php'); 
	require_once('../php/club_functions.php');
	
	
	function accessToken($client){
	    	$clientID      =   '441664366151-6f194dm56tbe7459tjsfrm4m6ot9vgk8.apps.googleusercontent.com';
		$clientSecret  =   'knbgLs50KEWdZhUjqa3YMtP2';
		$redirectURI   =   'https://rclubs.me/test/test2.php';
		  
		$refreshToken      =   '1/MEZgjrLPRZT1TtENWNWry1SVNKyA3emKaPXuZGEDErwMEudVrK5jSpoR30zcRFq6';
	
	    	$client->setApplicationName("rclubsme"); //DON'T THINK THIS MATTERS
		$client->setClientId($clientID );
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectURI);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		$client->setDeveloperKey('AIzaSyCycvbBaIh-jy4-kzdUuqP0hNRXngPW_Ug');
		
		if (isset($_SESSION['oa2_token'])) {
			$client->setAccessToken($_SESSION['oa2_token']);
		}
		
		if ($client->isAccessTokenExpired()) {
			$client->refreshToken($refreshToken);
			$_SESSION['oa2_token'] = $client->getAccessToken();
		}
	}
	
	function createClubCalendar($client, $clubid) {
		connectToDatabase();
		$service = new Google_Service_Calendar($client);
		
		$sql = "SELECT * FROM Clubs WHERE clubid='$clubid'";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) != 1)
			return;
    		$db_field = mysql_fetch_assoc($result);
   		if (!($db_field['calendar'])){
   			updateClubCalendar($client, $clubid);
   		}
	}
	
	function updateClubCalendar($client, $clubid) {
		connectToDatabase();
		$service = new Google_Service_Calendar($client);
		
		$sql = "SELECT * FROM Clubs WHERE clubid='$clubid'";
		$result = mysql_query($sql);
		if (mysql_num_rows($result) != 1)
			return;
    		$db_field = mysql_fetch_assoc($result);
   		if ($db_field['calendar']){
   			$service->calendars->delete($db_field['calendar']);
   		}

		
		// Create a new calendar
		$calendar = new Google_Service_Calendar_Calendar($client);
		$calendar->setSummary($db_field['name']);
		$calendar->setTimeZone("America/New_York");
		
		$createdCalendar = $service->calendars->insert($calendar);
		$calendarName = $createdCalendar->getId();
		
		$sql = "UPDATE Clubs SET calendar='$calendarName' WHERE clubid='$clubid'";
		mysql_query($sql);
		
		$club_name = $db_field['name'];
		$day_time = $db_field['day_time'];
		//split the string into separate days
		$days = explode(";", $day_time);
		$numDays = count($days);
		
		$dates = array();
		$startTimes = array();
		$endTimes = array();
	   	 //split the string into the day of the week, start time, and end time
	  	for ($i = 0; $i < $numDays; $i++){
		       $times = explode("_", $days[$i]);	//split time into day of week, time of start of meeting, and time of end of meeting
	       
	   	    	//convert the start and end hours to "am" or "pm"
	   	    	//echo $times[0];
	   	    	
	   	       $dates[$i] = date('Y-n-d', strtotime('next ' . $times[0]));
		       $start = $times[1]; 
		       $end = $times[2];
		
		       //do not add a comma if printing last day
		       //$days[$i] = $times[0];
		       $startTimes[$i] = $start . ':00';
		       $endTimes[$i] = $end . ':00';
		 }
		
		for ($i = 0; $i < $numDays; $i++){
			//echo $i . $dates[$i];
			$event = new Google_Service_Calendar_Event();
			$event->setSummary($club_name . ' Meeting');
			$event->setLocation($db_field['location']);
			$start = new Google_Service_Calendar_EventDateTime();
			$start->setDateTime($dates[$i] . 'T' . $startTimes[$i]);
			$start->setTimeZone('America/New_York');
			$event->setStart($start);
			$end = new Google_Service_Calendar_EventDateTime();
			$end->setDateTime($dates[$i] . 'T' . $endTimes[$i]);
			$end->setTimeZone('America/New_York');
			$event->setEnd($end);
			$event->setRecurrence(array('RRULE:FREQ=WEEKLY;UNTIL=20180701T170000Z'));
			
			$createdEvent = $service->events->insert($calendarName, $event);
		}
	}
?>