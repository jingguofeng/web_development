<?php 
	ob_start();
?>

<?php 
	include "zoho_salesorders.php";

	$order_id = $_GET['order_id'];
	$billing_name = $_GET['name'];
	$billing_address = urldecode($_GET['bill_address']);
	$billing_city = $_GET['bill_city'];
	$billing_state = $GET['bill_state'];
	$billing_zip = $GET['zip'];
	$billing_country = $GET['bill_country'];
	$paytime = $_GET['paytime'];
	$transaction_id = $_GET['transaction_id'];
	
$html ="

		<div class=\"receipt\">
			<div class=\"company_info\">
				<span style=\"font-weight: bolder; font-size: 30px;\">FlashWholesaler, LLC</span><br/>
				<span class=\"grey-font\">7101 N Ridgeway Ave.</span><br>
				<span class=\"grey-font\">Lincolnwood IL 60712</span><br>
				<span class=\"grey-font\">U.S.A</span>
			</div>
			<div class=\"receipt_no\">
				<span style=\"font-weight:bolder; font-size:24px;\">Order Receipt</span><br>
				<span class=\"grey-font\">Order# $order_id</span>
			</div>
			<br/><br/><br/><br/><br/>
			<div class=\"bill_to\">
				<span class=\"grey-font\">Bill To</span><br/>
				<p style=\"line-height:15px;\">
				<span>$billing_name</span><br/>
				<span>$billing_address</span><br/>
				<span>$billing_city</span><br/>
				<span>$billing_zip $billing_state</span><br/>
				<span>$billing_country</span><br/>
				</p>
			</div>
		
			<div class=\"payment_detail\">
				<table >
					<tr><td><span class=\"grey-font\" style=\"display:block; width:150px;\">Customer</span></td><td>:</td><td style=\"text-align:center;font-size:13px;color:black;\">$contact_name</td></tr>
					<tr><td><span class=\"grey-font\" style=\"display:block; width:150px;\">Paid on</span></td><td>:</td><td><span style=\"font-size:13px;color:black;\">$paytime</span></td></tr>
					<tr><td><span class=\"grey-font\" style=\"display:block; width:150px;\">Transaction number</span></td><td>:</td><td><span style=\"font-size:13px;color:black;\">$transaction_id</span></td><tr>
				</table>
			
			</div>
			<br/><br/><br><br>
			<div class=\"item_table\">
				<table class=\"invoice_table\">
					<tr class=\"table_header\"><th>#</th><th style=\"rowspan:3;\">Item & Description</th><th style=\"text-align:right;\">Qty</th><th nowrap style=\"text-align:right; rowspan:3;\">List Price</th><th style=\"text-align:right;\">Amount</th></tr>";

			    
			    for($i = 1; $i <= $products_num;$i++){
			
					$product_name = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Product Name"]');
					$product_quantity = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Quantity"]');
					$product_total = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Total"]');
					$product_listprice = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="List Price"]');
					$product_desc = $products[$i-1]->xpath('//FL[@val="Product Details"]/product[@no='.(string) ($i).']/FL[@val="Product Description"]');
		
					$html .="<tr class=\"order_product\" style=\"border-bottom:1px solid #e3e3e3;\"><td>".$i."</td>
						  <td><span>".$product_name[0]."</span><br><span style=\"font-size:12px;color: #666 !important;\">".$product_desc[0]."</span></td>
						  <td style=\"text-align:right;\">".$product_quantity[0]."</td>
						  <td style=\"text-align:right;\">".$product_listprice[0]."</td>
						  <td style=\"text-align:right;\">".$product_total[0]."</td>
						  </tr>";
				}		
			
				$html .= "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td></td>
						  <td style=\"text-align:right;\" nowrap><span style=\"font-color: red;\">Order Total</span></td>
						  <td style=\"text-align:right;\">$".$grand_total."</td>
						  </tr>";
				
				$html .= "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td></td>
						  <td style=\"text-align:right;\" nowrap><span style=\"font-color: red;\">Payment Made</span></td>
						  <td style=\"text-align:right;\">(-)$".$grand_total."</td>
						  </tr>";
				
				$html .= "<tr class=\"order_sum\"><td></td>
						  <td></td>
						  <td style=\"background:#f5f4f3 !important;\"></td>
						  <td style=\"text-align:right; background:#f5f4f3 !important;\" nowrap><span style=\"font-color: red;\">Balance Due</span></td>
						  <td style=\"text-align:right; background:#f5f4f3 !important;\">$0</td>
						  </tr>";		
										
			 	$html .= "</table>";
			
$html .= "</div>
			<br>
			<br><br/><br/>
			<div class=\"notes\">
				<h2 style=\"color:#666 !important;\">All FlashWholesaler USB Drives come with:</h2>
				<ul>
					<li>No Setup Costs!</li>
					<li>Free 3-Color Imprint!</li>
					<li>LIFETIME Warranty!</li>
					<li>24-Hour Rush Service Availability</li>
				</ul>
				<p>We thank you for your interest in our products, and hope we will have a successful relationship in the time to come.</p>
				<p>*Please note that market fluctuations may cause the price of memory to change.</p>
			</div>
		</div>";	
		
?>		
		
<?php 
	include("../mpdf60/mpdf.php");
	
	$mpdf=new mPDF();
	
	$mpdf->SetDisplayMode('fullpage');
	
	// LOAD a stylesheet
	$stylesheet = file_get_contents('receipt.css');
	$mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
	
	$mpdf->WriteHTML($html);
	
	$mpdf->Output();
?>

<?php 
	
	file_put_contents('receipt.pdf', ob_get_contents());
	//header("Location: index");
	exit();
?>