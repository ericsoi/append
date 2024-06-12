<?php
	echo 'starting';
    	$clientId = '62E0rB5Q6D1mk2QINvKVPd6uAjldWETVsaLrYAAwaW1OTofK';
    	$clientSecret = 's1FyBoSOadeA7BFnzKqAS4pMFIdfxRZqFa0Bk3LWBQTeiq72daoYKU85AeygDVCC';

        $credentials = base64_encode($clientId . ':' . $clientSecret);

        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
	curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Basic ' . $credentials]);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
	$response = curl_exec($ch);
	if (curl_errno($ch)) {
	     echo 'cURL Error: ' . curl_error($ch);
	} else {
	     echo $response;
	}
         curl_close($ch);
?>

