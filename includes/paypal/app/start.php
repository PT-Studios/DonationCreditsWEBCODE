<?php

require 'vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/includes/app_config.php';



if ($GLOBALS['cfg']['environment'] == 'sandbox') {

	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			$GLOBALS['cfg']['sandboxClientId'],
			$GLOBALS['cfg']['sandboxAPIKey']
		)
	);

} elseif ($GLOBALS['cfg']['environment'] == 'live'){

	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			$GLOBALS['cfg']['liveClientId'],
			$GLOBALS['cfg']['liveAPIKey']
		)
	);

	// Step 2.1 : Between Step 2 and Step 3
	$paypal->setConfig(
		array(
			'mode' => 'live',
			'log.LogEnabled' => true,
			'log.FileName' => 'PayPal.log',
			'log.LogLevel' => 'FINE'
		)
	);

} else {
	echo "Invalid Global config environment parameter.";
}