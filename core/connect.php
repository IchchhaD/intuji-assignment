<?php

    require '../vendor/autoload.php';
    require '../config/config.php';

    session_start();

    $client = new Google_Client();
    $client->setClientId(CLIENT_ID);
    $client->setClientSecret(CLIENT_SECRET);
    $client->setRedirectUri(REDIRECT_URI);
    $client->addScope(Google_Service_Calendar::CALENDAR);
    $client->addScope(Google_Service_Calendar::CALENDAR_EVENTS);

    if(isset($_SESSION['access_token']))
    {
        $client->setAccessToken($_SESSION['access_token']);
    }
    else
    {
        header('Location: ../config/auth.php');
        exit();
    }
?>