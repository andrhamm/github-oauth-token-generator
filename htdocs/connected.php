<?php set_include_path( get_include_path() . PATH_SEPARATOR . getenv('INC_PATH') );

// Pear request package: http://pear.php.net/package/HTTP_Request2
require_once 'HTTP/Request2.php';

include 'config.php';

if ( !isset($_GET['code']) )
{
	die("Parameter not found [code].");
}
else
{
	$code = $_GET['code'];
	
	$request = new HTTP_Request2($GH_TOKEN_URL);
	$request->setMethod(HTTP_Request2::METHOD_POST)
		->setHeader('Accept: application/json')
		->addPostParameter( 'client_id', $CLIENT_KEY )
		->addPostParameter( 'client_secret', $CLIENT_SEC )
		->addPostParameter( 'code', $code )
		->addPostParameter( 'state', $SECRET_NONCE );
	
	$responseBody = $request->send()->getBody();
	
	$objFromJSON = json_decode($responseBody,true);
	
	if ( json_last_error() !== JSON_ERROR_NONE )
	{
		die("Invalid response from GitHub");
	}
	else
	{
		if ( !isset($_GET['state']) || $_GET['state'] !== $SECRET_NONCE )
			die("Warning! Invalid response from GitHub [state]. Potential phishing attempt!");
		
		$auth_tokens = isset($_COOKIE['authtokens']) ? json_decode($_COOKIE['authtokens'],true) : array();
		$auth_tokens = array_filter( $auth_tokens, function ($tokenArr) {
			return !isset($tokenArr['error']);
		} );
		
		$previous_tokens = $auth_tokens;
		
		$objFromJSON['dt_created'] = time();
		
		if ( !isset($objFromJSON['error']) )
			array_unshift($auth_tokens, $objFromJSON);
		
		setcookie('authtokens', json_encode($auth_tokens), (time()+60*60*24*30) );
		
		echo "<pre>New key: ". print_r($objFromJSON, true);
		
		echo "\n\nPrevious keys: ". print_r($auth_tokens, true);
	}
}