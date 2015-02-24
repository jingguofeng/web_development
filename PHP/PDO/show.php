<?php

include "connect.php";

define("TIME_PERIOD", 30);
define("ATTEMPTS_NUMBER", 3);

$user_name = trim($_POST['user_name']);
$pwd = trim($_POST['pwd']);


if($user_name == "" || $user_name == null){
	header('Location: login?error=User Name cannot be empty');
}else if($pwd == "" || $pwd == null){
	header('Location: login?error=Password cannot be empty');
}



$sth = $dbh->prepare("SELECT pwd FROM users WHERE user_name = :user_name LIMIT 1");
$sth->bindParam(':user_name', $user_name);
$sth->execute();

/*
 * Data is obtained via the ->fetch(), a method of your statement handle. Before calling 
 * fetch, it's best to tell PDO how you'd like the data to be fetched. You have the following options:
 */
#1.PDO::FETCH_ASSOC: returns an array indexed by column name
#2.PDO::FETCH_CLASS: Assigns the values of your columns to properties of the named class. It will create the properties if matching properties do not exist
#3.PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names
#4.PDO::FETCH_NUM: returns an array indexed by column number

# setting the fetch mode
$sth->setFetchMode(PDO::FETCH_ASSOC);
$user_pwd_db = $sth->fetch();

$user_pwd = PBKDF2_HASH_ALGORITHM . ":" . PBKDF2_ITERATIONS . ":".$user_pwd_db['pwd'];

$user_ip = $_SERVER['REMOTE_ADDR'];

if(validate_password($pwd, $user_pwd)){
	echo "Welcome back, $user_name";
}else{
	
	confirmIPAddress($user_ip);
	//header('Location: login.php?error=Invalid username or password');
}


echo "<br>";
echo "Remote address: ".$_SERVER['REMOTE_ADDR']."<br>";
echo "Remote port: ".$_SERVER['REMOTE_PORT']."<br>";
echo "Server address: ".$_SERVER['SERVER_ADDR']."<br>";
echo "Server name: ".$_SERVER['SERVER_NAME']."<br>";
echo "Server protocol: ".$_SERVER['SERVER_PROTOCOL']."<br>";
echo "Server admin: ".$_SERVER['SERVER_ADMIN']."<br>";

/*
 * Other useful commands
 */

#$DBH->lastInsertId();
#$rows_affected = $STH->rowCount();

#UPDATE users SET create_time = NOW( ) + INTERVAL 1 HOUR ;
?>

<?php
function confirmIPAddress($ip) { 

  $q = "SELECT attempts, (CASE when lastLogin is not NULL and DATE_ADD(lastLogin, INTERVAL ".TIME_PERIOD.
  " MINUTE) > DATE_ADD(NOW(), INTERVAL 1 HOUR) then 1 else 0 END) as Denied FROM LoginAttempts WHERE ip = :ip"; 

  $sth = $dbh->prepare($q);
  $sth->bindParam(':ip', $ip);
  $sth->execute();
  
  $login = $sth->fetch();

  echo $login;
  //Verify that at least one login attempt is in database 

  if (!$login) { 
  	$sth = $dbh->prepare("INSERT INTO LoginAttempts ( ip, attempts, lastLogin ) values ( :ip, 1, DATE_ADD(NOW() + INTERVAL 1 HOUR))");
    $sth->bindParam(":ip", $ip);
    $sth->execute();
  	return 0; 
  } 

  
} 


function addLoginAttempt($value) {

   //Increase number of attempts. Set last login attempt if required.

   $q = "SELECT * FROM ".TBL_ATTEMPTS." WHERE ip = '$value'"; 
   $result = mysql_query($q, $this->connection);
   $data = mysql_fetch_array($result);
   
   if($data)
   {
     $attempts = $data["attempts"]+1;         

     if($attempts==3) {
       $q = "UPDATE ".TBL_ATTEMPTS." SET attempts=".$attempts.", lastlogin=NOW() WHERE ip = '$value'";
       $result = mysql_query($q, $this->connection);
     }
     else {
       $q = "UPDATE ".TBL_ATTEMPTS." SET attempts=".$attempts." WHERE ip = '$value'";
       $result = mysql_query($q, $this->connection);
     }
   }
   else {
     $q = "INSERT INTO ".TBL_ATTEMPTS." (attempts,IP,lastlogin) values (1, '$value', NOW())";
     $result = mysql_query($q, $this->connection);
   }
}

?>

<?php 

function checkIpAttemp($ip){
	$sth = $dbh->prepare("SELECT * FROM LoginAttempts WHERE ip = :ip LIMIT 1");
	$sth->bindParam(':ip', $ip);
	$sth->execute();
	
	$login = $sth->fetch();
	
	if(!$login){
		addLoginAttempt($ip);
		return 1;
	}else if($login['attempts'] < 3 ){
		addLoginAttempt($ip);
		return 1;
	}else{
		if($login){
			
		}
	}

}


function clearLoginAttempts($ip){
	$sth = $dbh->prepare("DELETE FROM LoginAttempts WHERE ip = :ip LIMIT 1");
	$sth->bindParam(':ip', $ip);
	$sth->execute();
}
?>

