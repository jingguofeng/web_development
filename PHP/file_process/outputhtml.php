<?php 
	ob_start();
?>

<?php 
	include "zoho_salesorders.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=.5, minimum-scale=0, maximum-scale=2">
<meta name="Description" content="Order new custom usb drive. FlashWholesaler offers customized promotional USB flash drives with fast shipping, data pre-loading, and other services that help promote your logo and business services."> 
<meta name="Keywords" content="Order new custom usb drive, promotional USB drives, logo branded usb drives">
<meta name="Language" content="English">
<meta name="Distribution" content="Global">
<meta name="Robots" content="All">
<title>Promotional USB Drives - Receipt - FlashWholesaler</title>

<style>
.receipt{
	display: inline-block;
	width: 100%;
}
.grey-font{
	color: #666 !important;
	font-size: 16px;
}
.company_info{
	padding: 3px;
	display: inline-block;
	width: 50%;
	margin:0;
}


.receipt_no{
	padding:3px;
	margin-left:20%;
	width:25%;
	display: inline-block;
	vertical-align: bottom;
	text-align: right;
}

.bill_to{
	margin:0;
	padding:3px;
	width: 30%;
	display: inline-block;
}

.payment_detail{
	padding:3px;
	margin:0px;
	margin-left:26%;
	display: inline-block;
	width: 40%;
	vertical-align: top;
}

.item_table{
	width: 100%;
	display: inline-block;
}



.receipt .item_table .invoice_table{
	width: 98%;
	border-collapse:collapse;  /* separate: keep borders separate. This is default. collapse: merge borders of adjoining cells*/
	display:line-block;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
}


.receipt .item_table .invoice_table .order_product{
	border-bottom: 1px solid #e3e3e3;
	border-top: 1px solid #e3e3e3;
}

.receipt .item_table .invoice_table th{
	background: #3c3d3a !important;
	padding: 5px 10px;
	text-align: left;
	font-size: 16px;
	color: #fff !important;
}

.receipt .item_table .invoice_table td{
	font-size:14px;
	padding: 5px 10px;
}

.receipt .item_table .invoice_table .order_sum td{
	padding: 14px 10px 5px 10px;
	color: red;
}

</style>

</head>

<body>
		<div class="receipt">
			<div class="company_info">
				<span style="font-weight: bolder; font-size: 30px;">FlashWholesaler, LLC</span><br/>
				<span class="grey-font">7101 N Ridgeway Ave.</span><br>
				<span class="grey-font">Lincolnwood IL 60712</span><br>
				<span class="grey-font">U.S.A</span>
			</div>
			<div class="receipt_no">
				<span style="font-weight:bolder; font-size:24px;">Order Receipt</span><br>
				<span class="grey-font">Order# <?php echo $_GET['order_id'];?></span>
			</div>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			<div class="bill_to">
				<span class="grey-font">Bill To</span><br/>
				<p style="line-height:15px;">
				<span><?php echo $_GET['name'];?></span><br/>
				<span><?php echo urldecode($_GET['bill_address']);?></span><br/>
				<span><?php echo $_GET['bill_city'];?></span><br/>
				<span><?php echo $_GET['zip'];?> <?php echo $_GET['bill_state'];?></span><br/>
				<span><?php echo $_GET['bill_country'];?></span><br/>
				</p>
			</div>
		
			<div class="payment_detail">
				<p style="line-height:20px;"><span class="grey-font" style="display: inline-block; width:150px;">Customer</span>:<span style="float:right;text-align:right;font-size:13px;color:black;"><?php echo $contact_name;?></span><br>
				<span class="grey-font" style="display: inline-block; width:150px;">Paid on</span>: <span style="float:right;font-size:13px;color:black;"><?php echo $_GET['paytime'];?></span><br>
				<span class="grey-font" style="display: inline-block; width:150px;">Transaction number</span>:<span style="float:right;font-size:13px;color:black;"><?php echo $_GET['transaction_id'];?></span><br>
				</p>
			
			</div>
			<br/><br/><br><br>
			<div class="item_table">
			<?php 
				echo "<table class=\"invoice_table\">
					  <tr class=\"table_header\"><th>#</th><th style=\"rowspan:3;\">Item & Description</th><th style=\"text-align:right;\">Qty</th><th nowrap style=\"text-align:right; rowspan:3;\">List Price</th><th style=\"text-align:right;\">Amount</th></tr>";
			    for($i = 1; $i <= $products_num;$i++){
			
					$product_name = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Product Name"]');
					$product_quantity = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Quantity"]');
					$product_total = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Total"]');
					$product_listprice = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="List Price"]');
					$product_desc = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Product Description"]');
		
					echo "<tr class=\"order_product\"><td>".$i."</td>
						  <td><span>".$product_name[0]."</span><br><span style=\"font-size:12px;color: #666 !important;\">".$product_desc[0]."</span></td>
						  <td style=\"text-align:right;\">".$product_quantity[0]."</td>
						  <td style=\"text-align:right;\">".$product_listprice[0]."</td>
						  <td style=\"text-align:right;\">".$product_total[0]."</td>
						  </tr>";
				}		
			
				echo "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td></td>
						  <td style=\"text-align:right;\" nowrap><span style=\"font-color: red;\">Order Total</span></td>
						  <td style=\"text-align:right;\">$".$grand_total."</td>
						  </tr>";
				
				echo "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td></td>
						  <td style=\"text-align:right;\" nowrap><span style=\"font-color: red;\">Payment Made</span></td>
						  <td style=\"text-align:right;\">(-)$".$grand_total."</td>
						  </tr>";
				
				echo "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td style=\"background:#f5f4f3 !important;\"></td>
						  <td style=\"text-align:right; background:#f5f4f3 !important;\" nowrap><span style=\"font-color: red;\">Balance Due</span></td>
						  <td style=\"text-align:right; background:#f5f4f3 !important;\">$0</td>
						  </tr>";		
										
			 	echo "</table>";
			?>
			
			</div>
			<br>
			<br><br/><br/>
			<div class="notes">
				<h2 style="color:#666 !important;">All FlashWholesaler USB Drives come with:</h2>
				<ul>
					<li>No Setup Costs!</li>
					<li>Free 3-Color Imprint!</li>
					<li>LIFETIME Warranty!</li>
					<li>24-Hour Rush Service Availability</li>
				</ul>
				<p>We thank you for your interest in our products, and hope we will have a successful relationship in the time to come.</p>
				<p>*Please note that market fluctuations may cause the price of memory to change.</p>
			</div>
		</div>	

	</body>	
		
</html>		
		
<?php 
	file_put_contents('receipt.pdf', ob_get_contents());
	header("Location: index");
	exit();
?>