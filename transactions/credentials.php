<?php
	$credential 	= 'FkJZZSkPX3cvcLguR1VAnf9/bduJpaagWSijpav/6KPB2vO4rom2KOYhtl3o9m+dIEaFMIpqi7Ra6HP4MAa42efAI2oYee0Jv9nw4yXsklkjaDawg3KR0HPHzknaG13ZnKMOU//TjuMCHJyDpk4T1NPUHBlbmCc/SBbG/rFch08Eshurj/2SdI2lfP7uVKOz1XoTBkha/9FxjUBxvw60ACY5p01p88ZlxIIuHTl0GdbTEkPW3NOQv53CotG108ct6rk61z+WbpNg9bSDCkodJfIhq56fjWv8evYs1cmqJxvYDGJqu3YxQ4qaqXlAS4YOTAFETySD1eRtrmAHP8aF6g==';
	$shortcode 	= '7290377';
	$callbackurl 	= 'https://matrick.co.ke/transactions/confirmation_url.php';
	$tyme 		= date("YmdHis");
	$passkey 	= '9b6b37ab48221b4ac73fe723635ad430093fb4456ce2ddb62d729632caae1169';
	$pass		= base64_encode($shortcode.$passkey.$tyme);
	$number 	= "254723775289";
	$b2b_confirmation_url = 'https://matrick.co.ke/transactions/b2b_confirmation_url.php';
	$calbackurl 	= "https://matrick.co.ke/transactions/confirmation_url.php";
	$validationurl	= "https://matrick.co.ke/transactions/validation_url.php";
	$CustomerKey	= "MzSE1AyGqrX9yVIQdcc4MdrI8AolAL9t";
	$ConsumerSecrate= "ukpLY9Hp55JZjKy3";
	$initiator	= "KENTO";
	$status_confirmation_url = 'https://matrick.co.ke/transactions/status_confirmation_url.php';