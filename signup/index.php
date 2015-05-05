<?php
    session_start();
    if (isset($_SESSION['myusername'])) {
        header("location: http://rclubs.me");
    }
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
    <link rel="stylesheet" type="text/css" media="all" href="../css/signup.css">
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</head>

<body>
    <nav>
    <div class="wrapper">
        <div class="logo"><a href="http://rclubs.me"><img  id="logoo" src="../images/rClubs4.png"></a></div>
            
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
    
    
    <form method="post" action="signup.php">
        <h1>rClubs Registration</h1>
        <div class="question">
            <input  name="myusername" type="text" required/>
            <label>Username</label>
        </div>
        <div class="question">
            <input name="mypassword" type="password" required/>
            <label>Password</label>
        </div>
        <div class="question">
            <input name="repassword" type="password" required/>
            <label>Confirm Password</label>
        </div>
        <div class="question">
            <input name="myemail" type="text" required/>
            <label>Email Address</label>
        </div>
        <button>Submit</button>
    </form>
    
</body>
</html>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            