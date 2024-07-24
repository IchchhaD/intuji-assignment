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

    $service = new Google_Service_Calendar($client);
    
    //function to format date according to Google Calendar Format
    function formatDateTime($inputDateTime, $timezone = 'Asia/Kathmandu')
    {
        $date = DateTime::createFromFormat('Y-m-d\TH:i', $inputDateTime);
        
        if(!$date)
        {
            throw new Exception('Invalid date-time format');
        }
        
        $date->setTimezone(new DateTimeZone($timezone));
        
        return $date->format('Y-m-d\TH:i:sP');
    }
    //function to list 25 events
    function listEvents()
    {
        global $service;
        $calendarId = 'primary';
        $optParams = array('orderBy' => 'updated', 'maxResults' => 25, 'singleEvents' => true);
        $results = $service->events->listEvents($calendarId, $optParams);
        return $results->getItems();        
    }
    //function to create new event
    function createEvent($summary, $startDateTime, $endDateTime)
    {
        global $service;
        
        $new_startDateTime = formatDateTime($startDateTime);
        $new_endDateTime = formatDateTime($endDateTime);
        
        //check if the event is timed
        $isTimedEvent = strpos($new_startDateTime, 'T') !== false && strpos($new_endDateTime, 'T') !== false;
    
        $eventArray = array(
            'summary' => $summary,
        );
        
        if($isTimedEvent)
        {
            $eventArray['start'] = array(
                'dateTime' => $new_startDateTime,
                'timeZone' => 'Asia/Kathmandu',
            );
            $eventArray['end'] = array(
                'dateTime' => $new_endDateTime,
                'timeZone' => 'Asia/Kathmandu',
            );
        }
        else
        {
            $eventArray['start'] = array(
                'date' => $new_startDateTime,
            );
            $eventArray['end'] = array(
                'date' => $new_endDateTime,
            );
        }
    
        $event = new Google_Service_Calendar_Event($eventArray);
        $calendarId = 'primary';
        //creating event
        try
        {
            $createdEvent = $service->events->insert($calendarId, $event);
            if($createdEvent)
            {
                header('Location: ../views/create.php?status=success');
            }
            else
            {
                header('Location: ../views/create.php?status=fail');
            }
        }
        catch(Google_Service_Exception $e)
        {
            $error = $e->getErrors();
            error_log('Google API Error: ' . print_r($error, true));
            echo 'Error creating event: ' . $e->getMessage();
            return null;
        }
        catch(Exception $e)
        {
            error_log('General Error: ' . $e->getMessage());
            echo 'An unexpected error occurred: ' . $e->getMessage();
            return null;
        }
    }
    
    //function to delete event
    function deleteEvent($eventId)
    {
        global $service;
        $calendarId = 'primary';
        $deletedEvent = $service->events->delete($calendarId, $eventId);
        if($deletedEvent)
            {
                header('Location: ../views/list.php?status=success');
            }
            else
            {
                header('Location: ../views/list.php?status=fail');
            }
    }

?>