<?php
	$url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	//$credentials = base64_encode('fwuKVdHGbRvJLiNmrM3Mhs8dtobr8jmW:E0Bql4QVvSauA25k');
	$credentials = base64_encode('uyONyJjzHsajSA6GmcfUfZ9PN0CBLwX2:9jEl4JAzkoIsolOr');
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$curl_response = curl_exec($curl);
	
	// $starting = strpos($curl_response, "access_token") + 16;
	// $tocken=substr($curl_response ,$starting, 28);
	$curl_response= json_decode($curl_response);
	$tocken = $curl_response->access_token;
?>