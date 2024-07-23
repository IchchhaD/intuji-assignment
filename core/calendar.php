<?php

require 'vendor/autoload.php';
require 'config/config.php';
require 'config/dbconnect.php';

session_start();

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->addScope(Google_Service_Calendar::CALENDAR);

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
    $pdo = dbConnect();
    
    $stmt = $pdo->prepare("SELECT access_token, refresh_token, token_expires FROM user_tokens WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $tokenData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($tokenData)
    {
        $accessToken = json_decode($tokenData['access_token'], true);
        
        if ($tokenData['token_expires'] < time())
        {
            $client->fetchAccessTokenWithRefreshToken($tokenData['refresh_token']);
            $accessToken = $client->getAccessToken();
            $stmt = $pdo->prepare("UPDATE user_tokens SET access_token = ?, token_expires = ? WHERE user_id = ?");
            $stmt->execute([json_encode($accessToken), $accessToken['expires_in'] + time(), $user_id]);
        }
        
        $client->setAccessToken($accessToken);
    }
    else
    {
        header('Location: config/auth.php');
        exit();
    }
}
else
{
    header('Location: config/auth.php');
    exit();
}

$service = new Google_Service_Calendar($client);

function listEvents()
{
    global $service;
    $calendarId = 'primary';
    $optParams = array('maxResults' => 10, 'orderBy' => 'startTime', 'singleEvents' => true);
    $results = $service->events->listEvents($calendarId, $optParams);
    return $results->getItems();
}

function createEvent($summary, $startDateTime, $endDateTime)
{
    global $service;
    $event = new Google_Service_Calendar_Event(array(
        'summary' => $summary,
        'start' => array('dateTime' => $startDateTime),
        'end' => array('dateTime' => $endDateTime)
    ));
    $calendarId = 'primary';
    return $service->events->insert($calendarId, $event);
}

function deleteEvent($eventId)
{
    global $service;
    $calendarId = 'primary';
    return $service->events->delete($calendarId, $eventId);
}

?>