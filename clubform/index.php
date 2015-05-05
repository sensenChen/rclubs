<?php
    session_start();
    if (!isset($_SESSION['myusername'])) {
        echo "You must be logged in to view this page";
        exit(0);
    }
?>  
<?php 
    include ( "../header.php" ); 
?>

<html>
    <body>
        <center>
        <form method="post" action="submit.php">
            <div class="account" id="accountname"><//?php echo "$username"; ?></div>
            <div class="account" id="accountleft">
                
                <script>
                    var counter = 0;

                    function moreFields() {
                        counter++;
                        if(counter>10)
                            return;
                        var newFields = document.getElementById('readroot').cloneNode(true);
                        newFields.id = '';
                        newFields.style.display = 'block';
                        var newField = newFields.childNodes;
                        for (var i=0;i<newField.length;i++) {
                            var theName = newField[i].name
                            if (theName) {
                                newField[i].name = theName + counter;
                                newField[i].attributes.required = "required";
                            }
                        }
                        var insertHere = document.getElementById('writeroot');
                        insertHere.parentNode.insertBefore(newFields,insertHere);
                        
                    }

                    window.onload = moreFields;
                </script>
                

                <?php 
                    echo "<p>Club Name</p>";
                    echo "<p>Location</p>";
                    echo "<p>Meeting times</p>";
                ?>
            </div>
            <div class="account" id="accountmid">
                <?php 
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                    echo "<p>|</p>";
                ?>
            </div>
            <div class="account" id="clubformright">
                <p><input name="clubname" type="text" required></p>
                <p><input name="location" type="text" required></p>
                
                <p id="readroot" style="display: none">
                    <select name="meetingday" >
                        <option value="">Day of the Week...</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    from
                    <input name="starttime" type="time" >
                    to
                    <input name="endtime" type="time" >
                </p>
                
                <span id="writeroot"></span>
                <input type="button" onclick="moreFields()" value="Add more fields" />
 
            </div>
            <div class="accountbutton" id="accountedit"><input class="accountbutton" id="accountsave" type="submit" value="Submit"></div>
        </form>
        </center>
    </body>
</html>     