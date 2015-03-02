<?php
include "config.php";
include "database.php";

//Instantiate Database object
$database = new Database();

/*
 * Get Total Questions
 */

$query = "SELECT * FROM `php_project2_questions` ";
$database->query($query);
$rows = $database->resultset();
$total = count($rows);