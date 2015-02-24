<?php

define("ERROR_LOG_PATH",'/home/content/a/x/i/axizg/html/flashcoast/newwebsite/test/my-test-errors.log');

require_once 'PasswordHash.php';
date_default_timezone_set('America/Chicago');
//ini_set('display_errors','0');			// Best practise on production sites
ini_set('log_errors','1');			// We need to log them otherwise this script will be pointless!
ini_set('error_log',ERROR_LOG_PATH);	// Full path to a writable file - include the file name
error_reporting(E_ALL ^ E_NOTICE);		// What errors to log - see: http://www.php.net/error_reporting

//Variables for connecting to your database.
//These variable values come from your hosting account.
$hostname = "mytest002.db.11793472.hostedresource.com";   //for Godaddy.com
$username = "mytest002";
$dbname = "mytest002";

//These variable values need to be changed by you before deploying
$password = "Pontiac@95563";
$usertable = "firsttable";
$yourfield = "cdTitle";

/*
 * here's a quick way to find out which drivers you have:
 */

//print_r(PDO::getAvailableDrivers());

//Variables for connecting to your database.
//These variable values come from your hosting account.
#$hostname = "flashcoastdb.db.11793472.hostedresource.com";
#$username = "flashcoastdb";
#$dbname = "flashcoastdb";

//These variable values need to be changed by you before deploying
#$password = "Pontiac@95563";
#$usertable = "users";
#$yourfield = "your_field";

// error handler function
function myErrorHandler($errno, $errstr, $errfile, $errline){
	$date = date('Y-m-d H:i:s');
	error_log("[$date]:[error_type]->$errno [error_message]->$errstr [file]->$errfile [line]->$errline".PHP_EOL, 3, ERROR_LOG_PATH);
	return false;
}

set_error_handler("myErrorHandler");

register_shutdown_function('shutdownFunction');

function shutDownFunction() {
	$error = error_get_last();
	if ($error['type'] == 1) {
		//do your stuff
		$date = date('Y-m-d H:i:s');
		$type = $error['type'];
		$message = $error['message'];
		$file = $error['file'];
		$line = $error['line'];
		error_log("*FATAL* [$date]:[error_message]->$message [file]->$file [line]->$line".PHP_EOL, 3, ERROR_LOG_PATH);
	}
	return false;
}

try {
  # MS SQL Server and Sybase with PDO_DBLIB
  #$DBH = new PDO("mssql:host=$host;dbname=$dbname, $user, $pass");
  #$DBH = new PDO("sybase:host=$host;dbname=$dbname, $user, $pass");
 
  # MySQL with PDO_MYSQL
  $dbh = new PDO("mysql:host=$hostname;dbname=$dbname;charset=utf8", $username, $password);
 
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  # SQLite Database
  #$DBH = new PDO("sqlite:my/database/path/database.db");
}
catch(PDOException $e) {
    echo "An Error occured!";
    file_put_contents('PDOErrors.txt', $e->getMessage().PHP_EOL, FILE_APPEND);
}

class user{
	public $first_name;
	public $last_name;
	public $user_name;
	public $pwd;
	public $email;
	public $create_time;
	
	function __construct($n1, $n2, $n3, $n4, $n5, $n6){
		$this->first_name = $n1;
		$this->last_name = $n2;
		$this->user_name = $n3;
		$this->pwd = $n4;
		$this->email = $n5;
		$this->create_time = $n6;		
	}
	
}


#echo getcwd();


//Using prepared statements will help protect you from SQL injection
#$date = date('Y-m-d H:i:s');
#$myinfo = new user("Jingguo", "Feng", "jimmy", "1123", "everjgfeng@gmail.com", $date);

/*
# STH means "Statement Handle"
$date = date('Y-m-d H:i:s');
$sth = $dbh->prepare("INSERT INTO users ( first_name, email, register_date ) values ( 'jimmy' , :email, :date)");
//$sth->bindParam(':email', $date);  //only for data reference
$sth->bindValue(':email','aa@gmail.com');
$sth->bindValue(':date', $date); //can use raw data
$sth->execute();

*/


#$sth = $dbh->prepare("INSERT INTO users ( first_name, last_name, user_name, pwd, email, create_time ) values ( :first_name, :last_name
#		,:user_name, :pwd, :email, :create_time)");
#$sth->execute((array) $myinfo);
