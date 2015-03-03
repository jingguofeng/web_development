<?php
#$my_file = 'file.txt';
#$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //implicitly creates file


#$my_file = 'file.txt';
#$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file); //open file for writing ('w','r','a')...

/*
//Read a File
$my_file = 'file.txt';
$handle = fopen($my_file, 'r');
$data = fread($handle,filesize($my_file));
echo $data;
*/

//Check End-Of-File
$my_file = 'file.txt';
$handle = fopen($my_file, 'r') or die('Cannot open file:  '.$my_file); //implicitly creates file
while(!feof($handle)) {
	echo fgets($handle) . "<br>";
}


//Write to a File
/*
$my_file = 'file.txt';
$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
$data = 'AJAX = Asynchronous JavaScript and XML'.PHP_EOL;
$data .= 'CSS = Cascading Style Sheets'.PHP_EOL;
$data .= 'HTML = Hyper Text Markup Language'.PHP_EOL;
$data .= 'PHP = PHP Hypertext Preprocessor'.PHP_EOL;
$data .= 'SQL = Structured Query Language'.PHP_EOL;
$data .= 'SVG = Scalable Vector Graphics'.PHP_EOL;
$data .= 'XML = EXtensible Markup Language'.PHP_EOL;
fwrite($handle, $data);
*/

//Append to a File
#$my_file = 'file.txt';
#$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
#$data = 'New data line 1';
#fwrite($handle, $data);
#$new_data = "\n".'New data line 2';
#fwrite($handle, $new_data);

//close a file
#$my_file = 'file.txt';
#$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
//write some data here
fclose($handle);

//Delete a File
#$my_file = 'file.txt';
#unlink($my_file);


?>

<?php 

	//echo readfile('file.txt');
?>
