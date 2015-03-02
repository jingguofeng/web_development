<?php include "db_process.php"?>

<?php 
	$number = (int) $_GET['n'];
	/*
	 * Get Question
	 */
	$query = "SELECT * FROM php_project2_questions WHERE question_number = :number LIMIT 1";
	$database->query($query);
	$database->bind(":number", $number);
	
	$result_question = $database->single();
	
	$query = "SELECT * FROM  `php_project2_choices` WHERE question_number = :number";
	$database->query($query);
	$database->bind(":number", $number);
	
	$result_choices = $database->resultset();
	$count = count($result_choices);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>PHP Quizzer</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
	</head>
	
	<body>
		<header>
			<div class="container">
				<h1>PHP Quizzer</h1>
			</div>
		</header>
		<main>
			<div class="container">
				<div class="current">Question <?php echo $number;?> of <?php echo $total;?></div>
				<p class="question">
					<?php echo $result_question['text']?>
				</p>
				<form method="post" action="process">
					<ul class="choices">
						<?php for($i = 0; $i < $count; $i++):?>
							<li><input name="choice" type="radio" value="<?php echo $result_choices[$i]['id'];?>" /><?php echo $result_choices[$i]['text']; ?></li>
						<?php endfor;?>
					</ul>
					<input type="submit" name="submit" value="Submit"/>			
					
					<input type="hidden" name="number" value="<?php echo $number;?>" />
				</form>
			</div>
		</main>
		
		<footer>
			<div class="container">
				Copyright &copy;2015, PHP Quizzer
			</div>
		</footer>
	</body>

</html>
