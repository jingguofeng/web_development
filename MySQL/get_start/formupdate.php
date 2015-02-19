<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<?php

$cdPrice=trim($_POST["cdPrice"]);
$cdReference = trim($_POST['cdReference']);


$hostname = "mytest002.db.11793472.hostedresource.com";   //for Godaddy.com
$username = "mytest002";
$dbname = "mytest002";

//These variable values need to be changed by you before deploying
$password = "Pontiac@95563";
$usertable = "firsttable";


//Connecting to your database
mysql_connect($hostname, $username, $password) OR DIE ("Unable to
connect to database! Please try again later.");
mysql_select_db($dbname) OR die ("Page error 4287: sorry there seems to be a problem.");


if($cdPrice && $cdReference){

	$cdupdatequery="UPDATE firsttable SET cdPrice='$cdPrice' WHERE cdReference='$cdReference';";
	mysql_query($cdupdatequery) or die("Query to update record in firsttable failed with this error: ".mysql_error());
	
}


?>


<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
	<lable>update CD price</lable>
	<input type="text" name="cdReference" size=10>
	<input type="number" step="0.01" name="cdPrice" size=50 value="">
	<input type="submit" value="Update">
</form>


