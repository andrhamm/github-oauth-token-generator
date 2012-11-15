<?php

$auth_tokens = isset($_COOKIE['authtokens']) ? json_decode($_COOKIE['authtokens'],true) : array();

echo "<pre>Previous keys: ". print_r($auth_tokens, true) . "</pre><a href=\"\authorize.php\">Generate New Key</a>";