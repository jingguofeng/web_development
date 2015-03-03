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
mysql_select_db($dbname) OR die ("Page error 4287: sorry there seems to be a problem.");

//Fetching from your database table.
$query = "SELECT firsttable.cdTitle, secondtable.cdTrack FROM firsttable JOIN 
            secondtable ON firsttable.cdTitle = secondtable.cdTitle";
$cdresult = mysql_query($query);    //It holds a pointer to the results. We can make use of the pointer by communicating with the server again

if ($cdresult) {
	while ($cdrow=mysql_fetch_array($cdresult)) {
		$title = $cdrow['cdTitle'];
		$track = $cdrow['cdTrack'];
		echo "<table>";
		echo "<tr>";
		echo "<td> $title</td>";
		echo "<td> $track</td>";
		echo "</tr>";				
		echo "</table>";
	}
}

echo "<br><br><br>----------------------<br>";

$query = "SELECT firsttable.cdTitle, secondtable.cdTrack FROM firsttable LEFT OUTER JOIN
    secondtable ON firsttable.cdTitle = secondtable.cdTitle ORDER BY cdTitle DESC";
$cdresult = mysql_query($query) OR die ("Page error 4287: sorry there seems to be a problem.");    //It holds a pointer to the results. We can make use of the pointer by communicating with the server again

if ($cdresult) {
	while ($cdrow=mysql_fetch_array($cdresult)) {
		$title = $cdrow['cdTitle'];
		$track = $cdrow['cdTrack'];
		echo "<table>";
		echo "<tr>";
		echo "<td> $title</td>";
		echo "<td> $track</td>";
		echo "</tr>";
		echo "</table>";
	}
}