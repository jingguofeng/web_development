<?php

$id = $_GET['cd'];

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
mysql_select_db($dbname) OR die ("Page error 4287: sorry there seems to be a problem.");

$cddeletequery="DELETE FROM `firsttable` WHERE `cdReference`=$id LIMIT 1";

mysql_query($cddeletequery);


//Close the connection
mysql_close();

header('Location: connect.php');