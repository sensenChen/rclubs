<?php
    connectToDatabase();	
    		if($myurl != '213rwarf') {
    			exit();
    		}
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
	}
?>