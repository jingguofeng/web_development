<?php
//Variables for connecting to your database.
//These variable values come from your hosting account.
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

if ($cdresult) {
	while ($cdrow=mysql_fetch_array($cdresult)) {
	    $cdReference=$cdrow['cdReference'];
	    $cdTitle=$cdrow['cdTitle'];
	    $cdArtist=$cdrow['cdArtist'];
	    $cdPrice=$cdrow['cdPrice'];
	    if ($cdPrice<=5) {$highlightclass="style=\"color:red;\";";} else {$highlightclass="";}    // ****
		echo "<table>";
	    echo "<tr $highlightclass>";    //****
	    echo "<td>$cdReference</td>
	            <td>$cdTitle</td>
	            <td>$cdArtist</td>
	            <td>$".$cdPrice."</td>
	            <td>$cdLabel</td>";
	    echo "<td><a href=\"delete_button.php?cd=$cdReference\">delete</a></td>";
	    echo "</tr>";
	    echo "</table>";
	}
}
?>
<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
	<input type="text" length=20 value="" name="input_search">
	<input type="submit" value="Check price">
</form>

<?php

$productid = mysql_real_escape_string($_POST['input_search']);
$searchquery = "SELECT `cdPrice` FROM firsttable WHERE cdReference='$productid'";
$search_result = mysql_query($searchquery);

if($search_result){
	while ($cdprice=mysql_fetch_array($search_result)) {
		echo "The product you are searching: $".$cdprice["cdPrice"];
	}
}


/*
 * Sorting data in a MySQL query
 */

//$cdquery="SELECT cdTitle FROM firsttable ORDER BY cdTitle ASC"; 

/*
 * Deleting data using a MySQL query
 */

//$cddeletequery="DELETE FROM firsttable WHERE cdReference=1 LIMIT 1";  


//Close the connection
mysql_close();

/*
 * Conclusion:
 * Always run POST or GET data through mysql_real_escape_string() and always put quotes around the variable inside the query. 
 * That makes you safe. Always hash passwords and encrypt data and then the data is safe.
 */
?>

<?php 
	echo "<div style=\"background: blue;\">test 123</div>";
	echo ""
?>

