<?php
$cScope         =   'https://www.googleapis.com/auth/calendar';
$cClientID      =   '441664366151-6f194dm56tbe7459tjsfrm4m6ot9vgk8.apps.googleusercontent.com';
$cClientSecret  =   'knbgLs50KEWdZhUjqa3YMtP2';
$cRedirectURI   =   'https://rclubs.me/test/test4.php';
  
$cAuthCode      =   '4/aA3GAwIDpIf2OQ-2o5xA6LtQxdu3zm7inycph4ihaPY.8jafBZMMKfYZJvIeHux6iLan9uJEmgI';
 
if (empty($cAuthCode)) {
    $rsParams = array(
                        'response_type' => 'code',
                        'client_id' => $cClientID,
                        'redirect_uri' => $cRedirectURI,
                        'access_type' => 'offline',
                        'scope' => $cScope,
                        'approval_prompt' => 'force'
                     );
 
    $cOauthURL = 'https://accounts.google.com/o/oauth2/auth?' . http_build_query($rsParams);
    echo("Go to\n$cOauthURL\nand enter the given value into this script under \$cAuthCode\n");
    exit();
} // ends if (empty($cAuthCode))
elseif (empty($cRefreshToken)) {
    $cTokenURL = 'https://accounts.google.com/o/oauth2/token';
    $rsPostData = array(
                        'code'          =>   $cAuthCode,
                        'client_id'     =>   $cClientID,
                        'client_secret' =>   $cClientSecret,
                        'redirect_uri'  =>   $cRedirectURI,
                        'grant_type'    =>   'authorization_code',
                        );
    $ch = curl_init();
  
    curl_setopt($ch, CURLOPT_URL, $cTokenURL);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $rsPostData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
    $cTokenReturn = curl_exec($ch);
    $oToken = json_decode($cTokenReturn);
    echo("Here is your Refresh Token for your application.  Do not loose this!\n\n");
    echo("Refresh Token = '" . $oToken->refresh_token . "';\n");
} // ends
?>