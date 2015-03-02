<?php 

class creatHTML{
	
	private $style;
	private $body;
	
	public function __construct($style, $body){
		$this->style = $style;
		$this->body = $body;
	}
	
	public function creat(){
		$html = "<html><head>";
		
		$html .= "</head><body>";
		
		$html .= "</body></html>";
	}
}

?>