<?php

require 'core/calendar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_event'])) {
        $summary = $_POST['summary'];
        $startDateTime = $_POST['start_datetime'];
        $endDateTime = $_POST['end_datetime'];
        createEvent($summary, $startDateTime, $endDateTime);
    }

    if (isset($_POST['delete_event'])) {
        $eventId = $_POST['event_id'];
        deleteEvent($eventId);
    }
}

$events = listEvents();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Google Calendar Integration</title>
</head>
<body>

    <h1>Google Calendar Events</h1>

    <form method="post">
        <h2>Create Event</h2>
        <input type="text" name="summary" placeholder="Event Summary" required>
        <input type="datetime-local" name="start_datetime" required>
        <input type="datetime-local" name="end_datetime" required>
        <button type="submit" name="create_event">Create Event</button>
    </form>

    <h2>List Events</h2>

    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <?php echo $event->getSummary(); ?> - <?php echo $event->getStart()->getDateTime(); ?>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="event_id" value="<?php echo $event->getId(); ?>">
                    <button type="submit" name="delete_event">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="disconnect.php" method="post">
        <button type="submit">Disconnect</button>
    </form>

</body>
</html>