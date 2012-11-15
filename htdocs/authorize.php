<?php set_include_path( get_include_path() . PATH_SEPARATOR . getenv('INC_PATH') );

include 'config.php';

$CALLBACK_URL = urlencode( rtrim($BASE_URL,'/') . '/connected.php');

header("Location: $GH_AUTH_URL?client_id=$CLIENT_KEY&redirect_uri=$CALLBACK_URL&state=$SECRET_NONCE&scope=repo");