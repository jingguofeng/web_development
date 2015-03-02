<?php 
	include "zohocrm.php";
	//echo $_GET['order_id'];
	$zoho_handler = new zohocrm("7cc2b781a595585bd242ec1a366b0aa7");
	
	$item = "SO No.: ".$_GET['order_id'];
	//echo $item;
	$kk = $zoho_handler->searchRecords_xml("Sales Orders", $item);
	//var_dump($kk);

	
	if($kk){
		
		$saleorder_zohoid_xml = $kk->xpath('//FL[@val="Id"]');  //Get sale order ID
		$saleorder_zohoid = $saleorder_zohoid_xml[0];
		
		$contact_names = $kk->xpath('//FL[@val="Contact Name"]');   //Get corresponding contact name
		$contact_name = $contact_names[0];
		
		$account_names = $kk->xpath('//FL[@val="Account Name"]');   //Get corresponding account name
		$account_name = $account_names[0];
		
		$products = $kk->xpath('//FL[@val="Product Details"]/product');   //Get all products under the sale order
		$products_num = count($products);                                 //products counts
		
		$paymentOK_xml = $kk->xpath('//FL[@val="Payment Received Online"]');           //Get corresponding contact ID
		$paymentOK = $paymentOK_xml[0];
		
		$contact_id_xml = $kk->xpath('//FL[@val="CONTACTID"]');           //Get corresponding contact ID
		$contact_id = $contact_id_xml[0];
					
		$order_grand_total = $kk->xpath('//FL[@val="Grand Total"]'); //always return an array.
		$grand_total = $order_grand_total[0];
		$mysale_id = $zoho_handler->find_record_id($kk, "Sales Orders");
		
		$getcontact = $zoho_handler->getRecordById("Contacts", $contact_id);//Get all the information under that contact ID
		
		$returnCustomer_xml = $getcontact->xpath('//FL[@val="Return Customer"]');  //Check whether is a new customer
		$returnCustomer = $returnCustomer_xml[0];
		
		$customer_first_xml = $getcontact->xpath('//FL[@val="First Name"]');
		$customer_first = $customer_first_xml[0];
		
		$customer_last_xml = $getcontact->xpath('//FL[@val="Last Name"]');
		$customer_last = $customer_last_xml[0];
		
		if($returnCustomer == "true"){
			//Get all the shipping and billing address:
			//Shipping address
			$shipping_name_xml = $getcontact->xpath('//FL[@val="Mailing Name"]');
			$shipping_name = $shipping_name_xml[0];
				
			$parts = explode(" ", $shipping_name);
			$shipping_last_name = array_pop($parts);
			$shipping_first_name = implode(" ", $parts);
				
			$shipping_street_xml = $getcontact->xpath('//FL[@val="Mailing Street"]');
			$shipping_street = $shipping_street_xml[0];
				
			$shipping_city_xml = $getcontact->xpath('//FL[@val="Mailing City"]');
			$shipping_city = $shipping_city_xml[0];
				
			$shipping_state_xml = $getcontact->xpath('//FL[@val="Mailing State"]');
			$shipping_state = $shipping_state_xml[0];
				
			$shipping_zip_xml = $getcontact->xpath('//FL[@val="Mailing Zip"]');
			$shipping_zip = $shipping_zip_xml[0];
				
			$shipping_country_xml = $getcontact->xpath('//FL[@val="Mailing Country"]');
			$shipping_country = $shipping_country_xml[0];
				
			$shipping_phone_xml = $getcontact->xpath('//FL[@val="Mailing Phone"]');
			$shipping_phone = $shipping_phone_xml[0];
				
			$shipping_email_xml = $getcontact->xpath('//FL[@val="Mailing Email"]');
			$shipping_email = $shipping_email_xml[0];
				
			//Billing address
			$billing_name_xml = $getcontact->xpath('//FL[@val="Billing Name"]');
			$billing_name = $billing_name_xml[0];
				
			$parts1 = explode(" ", $billing_name);
			$billing_last_name = array_pop($parts1);
			$billing_first_name = implode(" ", $parts1);
				
			$billing_street_xml = $getcontact->xpath('//FL[@val="Billing Street"]');
			$billing_street = $billing_street_xml[0];
		
			$billing_city_xml = $getcontact->xpath('//FL[@val="Billing City"]');
			$billing_city = $billing_city_xml[0];
		
			$billing_state_xml = $getcontact->xpath('//FL[@val="Billing State"]');
			$billing_state = $billing_state_xml[0];
		
			$billing_zip_xml = $getcontact->xpath('//FL[@val="Billing Zip"]');
			$billing_zip = $billing_zip_xml[0];
		
			$billing_country_xml = $getcontact->xpath('//FL[@val="Billing Country"]');
			$billing_country = $billing_country_xml[0];
		
			$billing_phone_xml = $getcontact->xpath('//FL[@val="Billing Phone"]');
			$billing_phone = $billing_phone_xml[0];
		
			$billing_email_xml = $getcontact->xpath('//FL[@val="Billing Email"]');
			$billing_email = $billing_email_xml[0];
				
				
			//cc info
			$cc_xml = $getcontact->xpath('//FL[@val="CC"]');
			$cc_all = $cc_xml[0];
				
			$regexcc = "/([0-9]{4})$/";
				
			preg_match($regexcc, $cc_all,$cc_out);
				
			$cc = $cc_out[1];
				
			$cct_xml = $getcontact->xpath('//FL[@val="CC Type"]');
			$cct = $cct_xml[0];
				
			$ccv_xml = $getcontact->xpath('//FL[@val="CCV"]');
			$ccv = $ccv_xml[0];
				
			$cce_xml = $getcontact->xpath('//FL[@val="CCE"]');
			$cce = $cce_xml[0];
				
			$regexcce = "/^([0-9]{2})[\S]{1}([0-9]{2})$/";
		
			preg_match($regexcce, $cce, $cce_out);
		
			$ccm = $cce_out[1];
			$ccy = $cce_out[2];
		}
		
	}
	
	
?>