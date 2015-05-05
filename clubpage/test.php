<?php
 
/* Base code provided by Sarah Bailey.
Case Western Reserve University, Cleveland OH.
Please do not email me for support. Post a comment instead.
Current v 1.2
Props to commenter Matt for pointing out the maxResults parameter.
*/
 
//TO DEBUG UNCOMMENT THESE LINES
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
 
//INCLUDE THE GOOGLE API PHP CLIENT LIBRARY FOUND HERE
//https://github.com/google/google-api-php-client
//DOWNLOAD IT AND PUT IT ON YOUR WEBSERVER IN THE ROOT FOLDER.
include(__DIR__."/header.php"); 
 
 
//TELL GOOGLE WHAT WE'RE DOING
$client = new Google_Client();
$client->setApplicationName("rclubsme"); //DON'T THINK THIS MATTERS
$client->setDeveloperKey('AIzaSyCycvbBaIh-jy4-kzdUuqP0hNRXngPW_Ug'); //GET AT AT DEVELOPERS.GOOGLE.COM
$cal = new Google_Service_Calendar($client);
//THE CALENDAR ID, FOUND IN CALENDAR SETTINGS. IF YOUR CALENDAR IS THROUGH GOOGLE APPS
//YOU MAY NEED TO CHANGE THE CENTRAL SHARING SETTINGS. THE CALENDAR FOR THIS SCRIPT
//MUST HAVE ALL EVENTS VIEWABLE IN SHARING SETTINGS.
$calendarId = 'rclubs rclubs';
//TELL GOOGLE HOW WE WANT THE EVENTS
$params = array(
//CAN'T USE TIME MIN WITHOUT SINGLEEVENTS TURNED ON,
//IT SAYS TO TREAT RECURRING EVENTS AS SINGLE EVENTS
 'singleEvents' => true,
 'orderBy' => 'startTime',
 'timeMin' => date(DateTime::ATOM),//ONLY PULL EVENTS STARTING TODAY
'maxResults' => 7 //ONLY USE THIS IF YOU WANT TO LIMIT THE NUMBER
 //OF EVENTS DISPLAYED
 
);
//THIS IS WHERE WE ACTUALLY PUT THE RESULTS INTO A VAR
$events = $cal->events->listEvents($calendarId, $params);
$calTimeZone = $events->timeZone; //GET THE TZ OF THE CALENDAR
 
//SET THE DEFAULT TIMEZONE SO PHP DOESN'T COMPLAIN. SET TO YOUR LOCAL TIME ZONE.
 date_default_timezone_set($calTimeZone);
 
 //START THE LOOP TO LIST EVENTS
 foreach ($events->getItems() as $event) {
 
 //Convert date to month and day
 
 $eventDateStr = $event->start->dateTime;
 if(empty($eventDateStr))
 {
 // it's an all day event
 $eventDateStr = $event->start->date;
 }
 
 $temp_timezone = $event->start->timeZone;
 //THIS OVERRIDES THE CALENDAR TIMEZONE IF THE EVENT HAS A SPECIAL TZ
 if (!empty($temp_timezone)) {
 $timezone = new DateTimeZone($temp_timezone); //GET THE TIME ZONE
 //Set your default timezone in case your events don't have one
 } else { $timezone = new DateTimeZone($calTimeZone);
 }
 
 $eventdate = new DateTime($eventDateStr,$timezone);
 $link = $event->htmlLink;
 $TZlink = $link . "&ctz=" . $calTimeZone; //ADD TZ TO EVENT LINK
 //PREVENTS GOOGLE FROM DISPLAYING EVERYTHING IN GMT
 $newmonth = $eventdate->format("M");//CONVERT REGULAR EVENT DATE TO LEGIBLE MONTH
 $newday = $eventdate->format("j");//CONVERT REGULAR EVENT DATE TO LEGIBLE DAY
 
 ?>
 <div class="event-container">
 <div class="eventDate">
 <span class="month"><?php
 
 echo $newmonth;
 
 ?></span><br />
 <span class="day"><?php
 
 echo $newday;
 
 ?></span><span class="dayTrail"></span>
 </div>
 <div class="eventBody">
 <a href="<?php echo $TZlink;
 //ECHO DIRECT LINK TO EVENT
?>">
 
 <?php echo $event->summary; //SUMMARY = TITLE
 
 ?>
 </a>
 </div>
 </div>
 <?php
 }
 
?>