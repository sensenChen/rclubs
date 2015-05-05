<?php

//TO DEBUG UNCOMMENT THESE LINES
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
 
//INCLUDE THE GOOGLE API PHP CLIENT LIBRARY FOUND HERE
//https://github.com/google/google-api-php-client
//DOWNLOAD IT AND PUT IT ON YOUR WEBSERVER IN THE ROOT FOLDER.
include('../google-api-php-client-master/src/Google/autoload.php'); 
require_once('../php/calendar_functions.php');
 
$clientID      =   '441664366151-6f194dm56tbe7459tjsfrm4m6ot9vgk8.apps.googleusercontent.com';
$clientSecret  =   'knbgLs50KEWdZhUjqa3YMtP2';
$redirectURI   =   'https://rclubs.me/test/test2.php';
  
$refreshToken      =   '1/MEZgjrLPRZT1TtENWNWry1SVNKyA3emKaPXuZGEDErwMEudVrK5jSpoR30zcRFq6';
 
//TELL GOOGLE WHAT WE'RE DOING
$client = new Google_Client();
/*$client->setApplicationName("rclubsme"); //DON'T THINK THIS MATTERS
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
}*/
accessToken($client);
$service = new Google_Service_Calendar($client);

// Create a new calendar
updateClubCalendar($client, 1);


?>