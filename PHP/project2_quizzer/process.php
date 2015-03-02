<?php

include "db_process.php";

session_start();

//Check to see if score is set_error_handler

if(!isset($_SESSION['score'])){
	$_SESSION['score'] = 0;
}

if(isset($_POST['submit'])){
	$number = $_POST['number'];
	$selected_choice =  $_POST['choice'];
	
	$next = $number + 1;
	
	/*
	 *  Get correct choice
	 */
	
	$query = "SELECT * FROM `php_project2_choices` WHERE question_number = :number AND is_correct = 1 LIMIT 1";
	$database->query($query);
	$database->bind(":number", $number);
	$result = $database->single();
	
	$correct_choice = $result['id'];
	
	//Compare
	if($correct_choice == $selected_choice){
		//Answer is correct
		$_SESSION['score']++;
	}
	
	if($number == $total){
		header("Location: final");
		exit();
	}else{
		header("Location: question?n=$next");
	}
	
	
}
