<?php 


$client = new Google\Client();
$client->setAuthConfig('C:\xampp\htdocs\lupisvulpes-website-credentials\client_secret_815407217485-gikaj4fom6d5mu7mi5s8tvt1ujlrmuf7.apps.googleusercontent.com.json');
$client->setApplicationName("LupisVulpes website");

//Set the scopes required for the API
$client->addScope(Google\Service\Drive::DRIVE);

//Set application's redirect URI
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client->setRedirectUri($redirect_uri);

