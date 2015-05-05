f<?php
	if($isAdmin) {
		echo '<form method="post" action="change_club.php?club=';
			echo $get['urlname'];
			 echo '">';
	}
?>

<!--
<script>
    function changePage(page) {
    	//if (page)
    	//document.getElementById("pageType").textContent = "<?php
		//require_once('../clubpage/" + page + ".php');
	//?>";
    }
</script>
-->

	<div class="clubbanner"><p><?php if($isAdmin) {
		                        	echo '<input name="clubName" type="text" value="';
		                	}
		                	echo "$clubname"; 
		                	if($isAdmin) {
		                        	echo '" class="clubnameinput">';
		                	}
		                	?></p></div>
	
	<div class="container">
	    <div id="navcontainer" class="clubnav" style="background: #99ccff;"> 
	    <ul>
	        <li><a onclick="changePage('about')">About</a></li>
	        <li><a onclick="changePage('announcements')">Announcements</a></li>
	        <li><a onclick="changePage('members')">Members</a></li>
	        <li><a onclick="changePage('photos')">Photos</a></li>
	    </ul>
	    <br style="clear:right"/>
	    </div>
	</div>
	
	<!--Print club information from database-->  
	<div class="clubabout">
	    <table id="clubtable" border="1" width="25%" cellpadding="4" cellspacing="3">
		    <th colspan="2">
		        <h3><br><?php echo "Club Info"; ?></h3>
		    </th>
		    <tr>
		        <td>Meeting Day(s)</td>
		        <td><?php 
			        	if ($public || $isMember) {
			        		$meetings = explode(',',$hours);
			        		$meetingsCount = count($meetings);
			        		if (!$isAdmin) {
				        		for ($i = 0;$i<$meetingsCount;$i++) {
				        			echo $meetings[$i];
				        			if ($i != $meetingsCount-1)
				        				echo "," . "<br>" ;
				        		}
			        		}
			        		else {
			        			for ($i = 0;$i<$meetingsCount;$i++) {
			        				$startTimeName = "starttime" . ($i+1);
			        				$endTimeName = "endtime" . ($i+1);
			        				$meetingDayName = "meetingday" . ($i+1);
			        				$temp = explode(";", $day_time);
			        				$temp2 = explode("_",$temp[$i]);
			        				$meetingDay = $temp2[0];
			        				$startTime = $temp2[1];
			        				$endTime = $temp2[2];
			        				if(strlen($startTime) == 4)
			        					$startTime = 0 . $startTime;
			        				if(strlen($endTime) == 4)
			        					$endTime = 0 . $endTime;
			        				echo"<p>";
			        				$selected0 = ''; if($meetingDay == 'Sunday')$selected0 = 'selected';
			        				$selected1 = ''; if($meetingDay == 'Monday')$selected1 = 'selected';
			        				$selected2 = ''; if($meetingDay == 'Tuesday')$selected2 = 'selected';
			        				$selected3 = ''; if($meetingDay == 'Wednesday')$selected3 = 'selected';
			        				$selected4 = ''; if($meetingDay == 'Thursday')$selected4 = 'selected';
			        				$selected5 = ''; if($meetingDay == 'Friday')$selected5 = 'selected';
			        				$selected6 = ''; if($meetingDay == 'Saturday')$selected6 = 'selected';
			        				echo"<select name='$meetingDayName'>
						                        <option value=''>Day of the Week...</option>
						                        <option value='Monday' $selected1>Monday</option>
						                        <option value='Tuesday' $selected2>Tuesday</option>
						                        <option value='Wednesday' $selected3>Wednesday</option>
						                        <option value='Thursday' $selected4>Thursday</option>
						                        <option value='Friday' $selected5>Friday</option>
						                        <option value='Saturday' $selected6>Saturday</option>
						                        <option value='Sunday' $selected0>Sunday</option>
						                </select>";
			        				echo "from";
				        			echo "<input name='$startTimeName' type='Time' value='$startTime'>";
				        			echo "to";
				        			echo "<input name='$endTimeName' type='Time' value='$endTime'>";
				        			echo"</p>";
				        		}
				        		echo "<span id='writeroot'></span>";
                					echo "<input type='button' onclick='moreFields()' value='Add more fields' />";
				        		
				        		echo"<p id = 'readroot' style='display: none'>";
				        			echo"<select id = 'meetingday'>
						                        <option value=''>Day of the Week...</option>
						                        <option value='Monday'>Monday</option>
						                        <option value='Tuesday'>Tuesday</option>
						                        <option value='Wednesday'>Wednesday</option>
						                        <option value='Thursday'>Thursday</option>
						                        <option value='Friday'>Friday</option>
						                        <option value='Saturday'>Saturday</option>
						                        <option value='Sunday'>Sunday</option>
						                </select>";
			        				echo "from";
				        			echo "<input type='Time' id = 'starttime'>";
				        			echo "to";
				        			echo "<input type='Time' id = 'endtime'>";
				        		echo"</p>";
			        		}
			        		echo "<div id='meetingsCount' style='display: none;'>";
        						echo htmlspecialchars($meetingsCount); 
						echo "</div>";
			        	}	
			        		
			        	else 
			        		echo "Please add the club to view this information.";
		            ?>
		            
			            <script>
			                    var counter = 0;
			
			                    function moreFields() {
			                        counter++;
			                        var node = document.getElementById('meetingsCount');
			                        var meetingsCount = parseInt(node.textContent);
			                        var newFields = document.getElementById('readroot').cloneNode(true);
			                        
			                        if(counter + meetingsCount>10)
			                            return;
			                        newFields.id = '';
			                        newFields.style.display = '';
			                        var newField = newFields.childNodes;
			                        for (var i=0;i<newField.length;i++) {
			                            var theName = newField[i].id;
			                            if (theName)
			                                newField[i].name = theName + (counter +  meetingsCount);
			                        }
			                        var insertHere = document.getElementById('writeroot');
			                        insertHere.parentNode.insertBefore(newFields,insertHere);
			                        
			                    }
	               		 </script>
		            
		        </td>
		    </tr>
		    <tr>
		        <td>Location</td>
		        <td><?php 
		        if ($public  || $isMember) {
		        	if($isAdmin) {
		                        echo '<input name="location" type="text" value="';
		                }
		        	echo "$location"; 
		        	if($isAdmin) {
		        		echo '">';
		                }
		        }
		        else 
		        	echo "Please add the club to view this information.";	
		        ?></td>
		    </tr>
	    </table>
	</div>

	
<?php
	if($isAdmin) {
	    echo '<center>';
	    echo '<input type="submit" value="Save Changes">';
	    echo '</center>';
	    echo '</form>';
	    
	}                      
	$client = new Google_Client();
	accessToken($client);
	createClubCalendar($client, $myclubid);
	
	$calendar_html = str_replace('@', '%40', $calendar);
	
	//echo $calendar_html;
	//echo $day_time;
	if ($public || $isMember) {
		echo "<center>";
		echo "<iframe src='https://www.google.com/calendar/embed?src=" . $calendar_html . "&ctz=America/New_York' style='border: 0' width='800' height='600' frameborder='0' scrolling='no'></iframe>";
		echo "</center>";
	}
	

?>                