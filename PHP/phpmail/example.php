<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->From = 'jingguo@promodealer.com';
$mail->FromName = 'Jingguo';
$mail->addAddress('everjgfeng@gmail.com', 'Jingguo Feng');     // Add a recipient
$mail->addReplyTo('jingguo@promodealer.com', 'Jingguo Feng');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

$mail->Body = "<html><head><style>a{border-radius:5px; text-decoration: none;margin-top: 20px;display: inline-block;color:#666;background: #f4f4f4;border: 1px dotted #ccc;padding: 13px;cursor: pointer;} strong{width:150px; display:inline-block;} td{display: inline-block;} li{ font-size: 18px;list-style: none; margin: 5px; padding: 5px; width:60%;border-radius: 5px; border: 1px #ccc solid;} </style></head><body>";
$mail->Body .= "<h2>Hi, Jake. Payment status has been updated:</h2>";
$mail->Body .= "<ul>";
$mail->Body .= "<li><strong>Sale order ID</strong>: ".$_GET['order_id']."</li>";
$mail->Body .= "<li><strong>Account Name</strong>: ".$contact_name."</li>";
$mail->Body .= "<li><strong>Contact Name</strong>: ".$account_name."</li>";
$mail->Body .= "<li><strong>Pay Time</strong>: ".$pay_time."</li>";
$mail->Body .= "<li><strong>Comment</strong>: New customer"."</li>";
$mail->Body .= "</ul>";
$message .= "<a href=\"https://crm.zoho.com/crm/EntityInfo.do?module=SalesOrders&id=$saleorder_zohoid\">Go to the sale order</a>";
$message .= "<h3>Keep fighting. Nothing is impossible! Everyday is a new day!</h3>";
$message .= "</body></html>";


$mail->addAttachment('ch04.pdf');

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}