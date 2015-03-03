<?php include "db_process.php";?>

<?php 
	//Create Select Query
	$query = "SELECT * FROM php_project_shouts ORDER BY id DESC";
	//Query
	$database->query($query);
	//Execute
	$rows = $database->resultset();
	$count = count($rows);
	/*
	for($i=0; $i < $count; $i++){
		echo "User: ".$rows[$i]['user'].". Message: ".$rows[$i]['message'].". TIME: ".$rows[$i]['time'].". <br/>";
	}
	*/
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SHOUT IT!</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
	</head>
	
	<body>
		<div id="container">
			<header>
				<h1>SHOUT IT! Shoutbox</h1>
			</header>
			<div id="shouts">
				<ul>
					<?php for($i=0; $i < $count; $i++): ?>
						<li class="shout"><span><?php echo $rows[$i]['time'];?> - </span><?php echo $rows[$i]['user'];?>: <?php echo $rows[$i]['message'];?></li>
					<?php endfor;?>
				</ul>
			</div>
			
			<div id="input">
				<?php if(isset($_GET['error'])):?>
					<div class="error">
						<span><?php echo $_GET['error'];?></span>
					</div>
				<?php endif;?>
				<form method="post" action="process">
					<input type="text" name="user" placeholder="Enter Your Name" />
					<input type="text" name="message" placeholder="Enter A Message" />
					<br/>
					<input class="shout-btn" type="submit" name="submit" value="Shout It Out"/>
				</form>
			</div>
		</div>
	</body>

</html>
