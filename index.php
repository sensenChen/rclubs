                                <?php
    session_start();
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>rClubs</title>
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Ubuntu">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo">
    <link rel="shortcut icon" href="http://static.tmimgcdn.com/img/favicon.ico">
    <link rel="icon" href="http://static.tmimgcdn.com/img/favicon.ico">
    <link rel="stylesheet" type="text/css" media="all" href="css/homepage.css">
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</head>

<body>
    <nav>
    <div class="wrapper">
        <div class="logo"><a href="http://rclubs.me"><img  id="logoo" src="images/rClubs4.png"></a></div>
            
        <ul id="menu" class="clearfix">
            <li><a href="http://rclubs.me">Home</a></li>
            <li><a href="http://rclubs.me/about">About</a></li>
            <li><a href="http://rclubs.me/allClubs">Browse Clubs</a></li>
            
            <?php if(!isset($_SESSION['myusername'])){ ?>
            <li><a href="http://rclubs.me/login">Login</a></li>
            <?php } ?> 
            
            <?php if(!isset($_SESSION['myusername'])){ ?>
            <li><a href="http://rclubs.me/signup">Signup</a></li>
            <?php } ?> 
            
            <?php if(isset($_SESSION['myusername'])){ ?>
            <li><a href="#">Account</a>
                <ul>
                <li><a href="http://rclubs.me/account">Profile</a></li>
                <li><a href="http://rclubs.me/myclubs">MyClubs</a></li>
                <li><a href="http://rclubs.me/chat">Chat</a></li>
                <li><a href="http://rclubs.me/login/logout.php">Logout</a></li>
                <li><a href="#"></a></li>
                </ul>
            </li>
            <?php } ?> 
        </ul>
    </div>
    </nav>
<script type="text/javascript">
$(function(){
  $('a[href="#"]').on('click', function(e){
    e.preventDefault();
  });
  
  $('#menu > li').on('mouseover', function(e){
    $(this).find("ul:first").show();
    $(this).find('> a').addClass('active');
  }).on('mouseout', function(e){
    $(this).find("ul:first").hide();
    $(this).find('> a').removeClass('active');
  });
  
  $('#menu li li').on('mouseover',function(e){
    if($(this).has('ul').length) {
      $(this).parent().addClass('expanded');
    }
    $('ul:first',this).parent().find('> a').addClass('active');
    $('ul:first',this).show();
  }).on('mouseout',function(e){
    $(this).parent().removeClass('expanded');
    $('ul:first',this).parent().find('> a').removeClass('active');
    $('ul:first', this).hide();
  });
});
</script>
    
    <div class="banner-container">
        <header class="banner">
            <h1>Introducing <span id="first-letter">r</span>Clubs! 
                <span id="banner-text">Join <span id="first-letter">or</span> manage your clubs with ease.</span>
                <span id="banner-text">Simple <span id="first-letter">&</span> Easy.</span>
            </h1>
            <a href="http://rclubs.me/signup" class="signup-button">SIGNUP</a>
        </header>
    </div>
    
<div class="home-search">
<form method="post" action="../php/display_result.php" id="search">
  <input name="mysearch" type="text" size="40" placeholder="search for clubs" />
        </form>
</div>
    
</body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            