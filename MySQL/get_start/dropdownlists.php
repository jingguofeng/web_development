            
<body>

    <form method="get" action="http://www.yourwebskills.com/files/examples/process.php">
        
        <select id="cd" name="cd">
        
            <?php
            
			$hostname = "mytest002.db.11793472.hostedresource.com";   //for Godaddy.com
			$username = "mytest002";
			$dbname = "mytest002";
			
			//These variable values need to be changed by you before deploying
			$password = "Pontiac@95563";
			$usertable = "firsttable";
			$yourfield = "cdTitle";
			
			//Connecting to your database
			mysql_connect($hostname, $username, $password) OR DIE ("Unable to
			connect to database! Please try again later.");
			mysql_select_db($dbname) OR die ("Page error 4287: sorry there seems to be a problem.");;
			
			//Fetching from your database table.
			$query = "SELECT * FROM $usertable";  //choose your own query 
			$cdresult = mysql_query($query);    //It holds a pointer to the results. We can make use of the pointer by communicating with the server again
                       
            while ($cdrow=mysql_fetch_array($cdresult)) {
            	$cdTitle=$cdrow["cdTitle"];
            	$cdReference = $cdrow["cdReference"];
                echo "<option value=\"$cdReference\">
                    $cdTitle
                </option>";
            
            }
                
            ?>
    
        </select>
        
    </form>
    
</body> 