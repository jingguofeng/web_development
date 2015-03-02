<?php


class zohocrm{
	
	private $token;
	
	public function __construct($Token){
		$this->token = $Token;
	}
	
	public function searchRecords_xml($module,$condition){   //return the simple xml object of zoho crm result
		
		
		//$condition = "( (cond1) AND (cond2) OR (cond3))"
		/*
		 * cond1: SO No.: 1234567
		 */
		
		switch($module){
	
				case "Leads":
					$moduleIn = "Leads";
					break;
				case "Sales Orders":
					$moduleIn = "SalesOrders";
					break;
				case "Accounts":
					$moduleIn = "Accounts";
					break;
				case "Contacts":
					$moduleIn = "Contacts";
					break;
				case "Potentials":
					$moduleIn = "Potentials";
					break;
				case "Campaings":
					$moduleIn = "Campaings";
					break;
				case "Cases":
					$moduleIn = "Cases";
					break;
				case "Solutions":
					$moduleIn = "Solutions";
					break;
				case "Quotes":
					$moduleIn = "Quotes";
					break;
				case "Purchase Orders":
					$moduleIn = "PurchaseOrders";
					break;
				default:
					return 0;
					echo "Error: Can't find module.";
		}
		
		$url = "https://crm.zoho.com/crm/private/xml/".$moduleIn."/searchRecords";
		$param= "authtoken=".$this->token."&scope=crmapi"."&criteria=(".$condition.")";
	
		//use php curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
	
		$response1 = simplexml_load_string($result,'SimpleXMLElement',LIBXML_NOCDATA);
		
		//var_dump($response1);
		if($response1->children()->getName() == "result"){				
			//Get all the row value		
			switch($module){
			
				case "Leads":
					$result_xml = $response1->result->Leads->row;
					break;
				case "Sales Orders":
					$result_xml = $response1->result->SalesOrders->row;
					break;
				case "Accounts":
					$result_xml = $response1->result->Accounts->row;
					break;
				case "Contacts":
					$result_xml = $response1->result->Contacts->row;
					break;
				case "Potentials":
					$result_xml = $response1->result->Potentials->row;
					break;
				case "Campaings":
					$result_xml = $response1->result->Campaigns->row;
					break;
				case "Cases":
					$result_xml = $response1->result->Cases->row;
					break;
				case "Solutions":
					$result_xml = $response1->result->Solutions->row;
					break;
				case "Quotes":
					$result_xml = $response1->result->Quotes->row;
					break;
				case "Purchase Orders":
					$result_xml = $response1->result->PurchaseOrders->row;
					break;
				default:
					return 0;
					echo "Error: Can't find module.";
			}
			
			return $result_xml;    //return simple xml object
	
		}elseif($response1->children()->getName() == "nodata"){
			return 0;
		}else{
			return 0;
			
		}
	
	}//End of Function:searchRecords_xml
	
	
	public function getRecordById($module,$id){
		
		switch($module){
		
			case "Leads":
				$moduleIn = "Leads";
				break;
			case "Sales Orders":
				$moduleIn = "SalesOrders";
				break;
			case "Accounts":
				$moduleIn = "Accounts";
				break;
			case "Contacts":
				$moduleIn = "Contacts";
				break;
			case "Potentials":
				$moduleIn = "Potentials";
				break;
			case "Campaings":
				$moduleIn = "Campaings";
				break;
			case "Cases":
				$moduleIn = "Cases";
				break;
			case "Solutions":
				$moduleIn = "Solutions";
				break;
			case "Quotes":
				$moduleIn = "Quotes";
				break;
			case "Purchase Orders":
				$moduleIn = "PurchaseOrders";
				break;
			default:
				return 0;
				echo "Error: Can't find module.";
		}
		
		$url = "https://crm.zoho.com/crm/private/xml/".$moduleIn."/getRecordById";
		$param= "authtoken=".$this->token."&scope=crmapi&id=".$id;
		
		//use php curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
		
		$response1 = simplexml_load_string($result,'SimpleXMLElement',LIBXML_NOCDATA);
		
		//var_dump($response1);
		if($response1->children()->getName() == "result"){
			//Get all the row value
			switch($module){
					
				case "Leads":
					$result_xml = $response1->result->Leads->row;
					break;
				case "Sales Orders":
					$result_xml = $response1->result->SalesOrders->row;
					break;
				case "Accounts":
					$result_xml = $response1->result->Accounts->row;
					break;
				case "Contacts":
					$result_xml = $response1->result->Contacts->row;
					break;
				case "Potentials":
					$result_xml = $response1->result->Potentials->row;
					break;
				case "Campaings":
					$result_xml = $response1->result->Campaigns->row;
					break;
				case "Cases":
					$result_xml = $response1->result->Cases->row;
					break;
				case "Solutions":
					$result_xml = $response1->result->Solutions->row;
					break;
				case "Quotes":
					$result_xml = $response1->result->Quotes->row;
					break;
				case "Purchase Orders":
					$result_xml = $response1->result->PurchaseOrders->row;
					break;
				default:
					return 0;
					echo "Error: Can't find module.";
			}
				
			return $result_xml;    //return simple xml object
		
		}elseif($response1->children()->getName() == "nodata"){
			return 0;
		}else{
			return 0;
				
		}		
		
	}
	
	
	public function updateRecordsByID($module, $record_id, $xml_data){
	
		switch($module){
		
			case "Leads":
				$moduleIn = "Leads";
				break;
			case "Sales Orders":
				$moduleIn = "SalesOrders";
				break;
			case "Accounts":
				$moduleIn = "Accounts";
				break;
			case "Contacts":
				$moduleIn = "Contacts";
				break;
			case "Potentials":
				$moduleIn = "Potentials";
				break;
			case "Campaings":
				$moduleIn = "Campaings";
				break;
			case "Cases":
				$moduleIn = "Cases";
				break;
			case "Solutions":
				$moduleIn = "Solutions";
				break;
			case "Quotes":
				$moduleIn = "Quotes";
				break;
			case "Purchase Orders":
				$moduleIn = "PurchaseOrders";
				break;
			default:
				return 0;
				echo "Error: Can't find module.";
		}
		
		
		$url = "https://crm.zoho.com/crm/private/xml/".$moduleIn."/updateRecords";
		$param= "newFormat=1&authtoken=".$this->token."&scope=crmapi"."&id=".$record_id."&xmlData=".$xml_data;
	
		//use php curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	
	}
	
	/*
	 * Serve for function undateRecordsByID
	 */
	public function convertToxml($module,$fields,$values){
		
		switch($module){
		
			case "Leads":
				$moduleIn = "Leads";
				break;
			case "Sales Orders":
				$moduleIn = "SalesOrders";
				break;
			case "Accounts":
				$moduleIn = "Accounts";
				break;
			case "Contacts":
				$moduleIn = "Contacts";
				break;
			case "Potentials":
				$moduleIn = "Potentials";
				break;
			case "Campaings":
				$moduleIn = "Campaings";
				break;
			case "Cases":
				$moduleIn = "Cases";
				break;
			case "Solutions":
				$moduleIn = "Solutions";
				break;
			case "Quotes":
				$moduleIn = "Quotes";
				break;
			case "Purchase Orders":
				$moduleIn = "PurchaseOrders";
				break;
			default:
				return 0;
				echo "Error: Can't find module.";
		}
		
		$xml_data_head = "<".$module."><row no=\"1\">";
		$xml_data_end = "</row></".$module.">";
		$xml_data = "";
		if(count($fields) != count($values)){
			echo "Fields size and Values size are different.";
			return 0;
		}else{
			for($i = 0; $i < count($fields); $i++){
				$xml_data += "<FL val=\"".$fields[$i]."\">".$values[$i]."</FL>";
			}
		}
		
		return $xml_data_head.$xml_data.$xml_data_end;
	}
	
	/*
	 * $result_xml must come from function searchRecords_xml
	 * 
	 */
	public function find_record_id($result_xml, $module){
		
		switch($module){
			
			case "Accounts":
				$target = "ACCOUNTID";
				break;
			case "Contacts":
				$target = "CONTACTID";
				break;
			case "Potentials":
				$target = "POTENTIALID";
				break;
			case "Quotes":
				$target = "QUOTEID";
				break;
			case "Sales Orders":
				$target = "SALESORDERID";
				break;
			default:
				echo "Can't find module.";
				return 0;		
		}
		
		$_id = $result_xml->xpath('//FL[@val="'.$target.'"]'); //xpath('//FL[@val="Product Details"]/product')
		if($_id){
			return $_id[0];
		}else{
			return 0;
		}
	
	}//End Of find_record_id()	
	
	
	//convert a xmlobject to an array 
	function _xml2array ( $xmlObject, $out = array () ){
		foreach ( (array) $xmlObject as $index => $node )
			$out[$index] = ( is_object ( $node ) ) ? _xml2array ( $node ) : $node;
	
		return $out;
	}
	
	
}//End Of Class