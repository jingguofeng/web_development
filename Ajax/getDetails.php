<?php 

	$product = $_GET['ImageID'];
	
	switch($product){
		case '1':
			echo "Paris";
			break;
		case '2':
			echo "Cleveland";
			break;
		case '3':
			echo "Wichita";
			break;
		case '4':
			echo "Boston";
			break;
		case '5';
			echo "Baltimore";
			break;
		default:
			echo "Nothing";
			break;			
	}
	
	
?>