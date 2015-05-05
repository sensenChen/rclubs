<?
session_start();

if(isset($_SESSION['myusername']))
{
    $text = $_POST['usermsg'];
     
    $fp = fopen("log.html", 'a');
    date_default_timezone_set('America/New_York');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['myusername']."</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);

    header("location: http://rclubs.me/chat");
}
?>

