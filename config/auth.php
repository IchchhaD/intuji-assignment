<?php

//google client OAuth flow

require '../vendor/autoload.php';
require 'config.php';
require 'dbconnect.php';

session_start();

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->addScope(Google_Service_Calendar::CALENDAR);

if(isset($_GET['code']))
{
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $user_id = $_SESSION['user_id'];
    
    $connect = dbConnect();
    $stmt = $connect->prepare("REPLACE INTO user_tokens (user_id, access_token, refresh_token, token_expires) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, json_encode($token), $token['refresh_token'], $token['expires_in'] + time()]);
    
    $_SESSION['access_token'] = $token;
    header('Location: ../index.php');
    exit();
}

if(!isset($_SESSION['access_token']))
{
    $auth_url = $client->createAuthUrl();
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    exit();
}

?>