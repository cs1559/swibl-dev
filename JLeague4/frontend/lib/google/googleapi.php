<?php

class fsGoogleApi {
	
	function __construct() {	
	}
	
	function sendRequest($url) {
	
		$ch = curl_init();
	
		curl_setopt($ch, CURLOPT_URL, "$url");
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch,CURLOPT_POST,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode(array("longUrl"=>$url)));
		curl_setopt($ch,CURLOPT_HTTPHEADER,array("Content-Type: application/json"));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			
		$result= curl_exec($ch);
	
		curl_close($ch);
	
		return json_decode($result,true);
	
	}
	
} 

?>