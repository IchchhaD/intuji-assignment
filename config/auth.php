<?php

require '../vendor/autoload.php';
require 'config.php';

//trigger signing in to google process to link calendar

    session_start();

    $client = new Google_Client();
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URI);
    $client->addScope(Google_Service_Calendar::CALENDAR);

    if(isset($_GET['code']))
    {
        $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
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