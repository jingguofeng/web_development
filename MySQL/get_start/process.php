<?php

$cdArtist=htmlspecialchars($_POST["cdArtist"]);   //prevent cross-site scripting
$cdTitle=$_POST["cdTitle"];
$cdPrice=$_POST["cdPrice"];
$cdLabel=$_POST["cdLabel"];

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


$insertcdquery="INSERT INTO firsttable (cdArtist, cdTitle, cdPrice, cdLabel) VALUES ('$cdArtist', '$cdTitle', '$cdPrice', '$cdLabel')";
mysql_query($insertcdquery) or die("Query to insert new record to firsttable failed with this error: ".mysql_error()); 

echo $insertcdquery;