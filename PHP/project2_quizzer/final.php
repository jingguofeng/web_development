<?php 
	include "db_process.php";
	session_start();
	date_default_timezone_set('America/Chicago');
	$order_id = "1234567";
	$contact_name = "Jingguo Feng";
	$account_name = "Jimmy_mumu";
		    		/*
		    		 * Send Notification to sale person
		    		 */
		    		$pay_time = date('Y-m-d H:i:s');
		    		$to = "everjgfeng@gmail.com";
		    		$subject = "Payment Received Notification";
		    		
		    		$message = "<html><head><style>a{border-radius:5px; text-decoration: none;margin-top: 20px;display: inline-block;color:#666;background: #f4f4f4;border: 1px dotted #ccc;padding: 13px;cursor: pointer;} strong{width:150px; display:inline-block;} td{display: inline-block;} li{ font-size: 18px;list-style: none; margin: 5px; padding: 5px; width:60%;border-radius: 5px; border: 1px #ccc solid;} </style></head><body>";
		    		$message .= "<h2>Hi, Jake. Payment status has been updated:</h2>";
		    		$message .= "<ul>";
		    		$message .= "<li><strong>Sale order ID</strong>: ".$order_id."</li>";
		    		$message .= "<li><strong>Account Name</strong>: ".$contact_name."</li>";
		    		$message .= "<li><strong>Contact Name</strong>: ".$account_name."</li>";
		    		$message .= "<li><strong>Pay Time</strong>: ".$pay_time."</li>";
		    		$message .= "<li><strong>Comment</strong>: This customer chooses a different billing address"."</li>";
		    		$message .= "</ul><br/>";
		    		$message .= "<a href=\"https://crm.zoho.com/crm/EntityInfo.do?module=SalesOrders&id=493609000012255457\">Go to the sale order</a>";
		    		$message .= "<h3>Keep fighting. Nothing is impossible! Everyday is a new day!</h3>";
		    		$message .= "</body></html>";
		    		
		    		$headers = "From: jingguo@promodealer.com \r\n";
		    		$headers .= "Reply-To: jingguo@promodealer.com \r\n";
		    		$headers .= "MIME-Version: 1.0\r\n";
		    		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		    		mail ($to,$subject,$message,$headers);
		    		
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
				<h2>You're Done!</h2>
				<p>Congrats! You have complete the test</p>
				<p>Final Score: <?php echo $_SESSION['score'];?></p>
				<a href="question.php?n=1" class="start">Take Again</a>
			</div>
		</main>
		
		<footer>
			<div class="container">
				Copyright &copy;2015, PHP Quizzer
			</div>
		</footer>
	</body>

</html>

<?php 
	session_destroy();
?>