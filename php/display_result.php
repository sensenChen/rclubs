<?php
    require_once('club_functions.php');

    connectToDatabase();

    mysql_select_db("rclubsme_users") or die("cannot select DB");
    $tbl_name = "Clubs";

    //this array will store all the clubs which have the substring from $mysearch in the club name
    $specifiedClubs = [];

    $loop = mysql_query("SELECT clubid, name FROM $tbl_name") or die(mysql_error());

    //stores the string the user specifically searched for
    $mysearch = $_POST['mysearch'];
    //gets the size of the search string which will be used for comparison purposes
    $modifiedSearch = str_replace(" ", "", $mysearch);
    $size = strlen($modifiedSearch);

    //if user did not type anything and pressed exit, display exit message to enter a valid club
    if($size == 0)
    {
        exit("Please enter a valid club name!");
    }

    else
    {
	//while loop to go through all the clubs and then specifically find the ones with the matched substring
        while($row = mysql_fetch_array($loop))
        {
            $myclubid = $row['clubid'];
            $myclubname = $row['name'];
            //if only one letter was typed in, find all clubs that begin with this letter
            if($size == 1)
            {
            	//convert searched letter and clubs name to lower case so you can compare the first letter in the string in case they are of the opposite case.
            	$allLowerSearch = strtolower($modifiedSearch);
            	$allLowerClubName = strtolower($myclubname);
            	//if the first letter between the search and the club name are the same, then add the club to the array
                if( substr($allLowerSearch, 0, $size) == substr($allLowerClubName, 0, $size) )
                {
                    $specifiedClubs[$myclubid] = $myclubname;
                }
            }
            //if size of search string is greater than 1, check if the substring exists in each club and if it doesn, then add the club to the array
            else if($size > 1)
            {
            	$modifiedClubName = str_replace(" ", "", $myclubname);
                if(stripos($modifiedClubName, $modifiedSearch) !== false)
                {
                    $specifiedClubs[$myclubid] = $myclubname;
                }
                
                else
                {
                    $allLowerSearch = strtolower($modifiedSearch);
                    $allLowerClub = strtolower($modifiedClubName);
                    $searchSplit = str_split($allLowerSearch);
                    $arraySplit = str_split($allLowerClub);
                    $sizeMispelled = sizeof($searchSplit);
                    $sizeSplit = sizeof($arraySplit);
                    $numSame = 0;
                    
                    if($sizeSplit > $sizeMispelled)
                    {
                        for($a = 0; $a < $sizeMispelled; $a++)
                        {
                            if(strcmp($searchSplit[$a], $arraySplit[$a]) === 0)
                            {
                                $numSame += 1;
                            }
                        }
                    
                        if( (($sizeMispelled - $numSame) <= 4) and ($numSame >= 2))
                        {
                            $specifiedClubs[$myclubid] = $myclubname;
                        }
                    }
                
                    else
                    {
                        $numSame = 0;
                        for($b = 0; $b < $sizeSplit; $b++)
                        {
                            if(strcmp($searchSplit[$b], $arraySplit[$b]) === 0 )
                            {
                                $numSame += 1;
                            }
                        }
                    
                        if( (($sizeSplit - $numSame) <= 4) and ($numSame >= 2))
                        {
                            $specifiedClubs[$myclubid] = $myclubname;
                        }
                    
                    }
                }
            }
        }
        //find the number of clubs in the specifiedClubs array. 
        $numClubs = sizeof($specifiedClubs);
        //if the size of the array is 0, that means no clubs were found for search string. thus notify the user about this
        if($numClubs == 0)
        {
            exit("No search results were found for your request!");
        }

	//sort all the clubs in specifiedClubs array
        natcasesort($specifiedClubs);
	//output each of the clubs with a link to the club page when the name is clicked upon.
	foreach($specifiedClubs as $myclubid => $myclubname){
	$sql = "SELECT urlname FROM Clubs WHERE clubid='$myclubid'";
   	$result = mysql_query($sql);
   	$db_field = mysql_fetch_assoc($result);
    	$myurlname = $db_field['urlname'];

	echo "<a href=http://rclubs.me/clubpage/" . $myurlname . ">";
    	echo $myclubname . "</a>";
   	echo "<br/>";
   	}
    }
?>
<html>
<style>
a {
text-decoration:none;
}
</style>
</html>