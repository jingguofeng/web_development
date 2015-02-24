<?php
include "db_process.php";

//Check if form submitted
if($_POST['submit']){
	$user = trim($_POST['user']);
	$message = trim($_POST['message']);
	
	
	//Set timezone
	date_default_timezone_set('America/Chicago');
	$time = date('h:i:s a', time());
	
	//Validate input
	if(!isset($user) || $user == '' || !isset($message) || $message == ''){
		$error = "Please fill in your name and message";
		header("Location: index?error=".urlencode($error));
		exit();
	}else{
		//Create Select Query
		try{
			$query = "INSERT INTO php_project_shouts (user, message, time) VALUES (:user, :message, :time)";
			//Query
			$database->query($query);
			
			$database->bind(':user',$user);
			$database->bind(':message',$message);
			$database->bind(':time',$time);
			//Execute
			$database->execute();
			header("Location: index");
			exit();
		}catch(PDOException $e){
            $emsg = $e->getMessage();
            header("Location: index?error=$emsg");
            exit();
        }

	}
	

	
	
}
